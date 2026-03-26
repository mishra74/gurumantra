@extends('layouts.master')

@section('content')

@php
$mrp_price = $checkout->mrp;
$mrp = $checkout->price;
$discountPercent = $checkout->discount ?? 0;
    $mrp = $checkout->price;
    $discountPercent = $checkout->discount ?? 0;

    $discountAmount = ($mrp * $discountPercent) / 100;
    $price = $mrp - $discountAmount;

    if($price < 1){
        $price = 1; // minimum ₹1 for Razorpay
    }
@endphp

<div class="container py-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-3">{{ $checkout->title }}</h4>
                         <p>
                        <b>MRP:</b> 
                        <span style="text-decoration: line-through; color: gray;">
                            ₹{{ $mrp_price }}
                        </span>
                    </p>
                    
                    <!-- MRP -->
                    <p>
                        <b>price:</b> 
                        <span style="text-decoration: line-through; color: gray;">
                            ₹{{ $mrp }}
                        </span>
                    </p>

                    <!-- Discount -->
                    <p>
                        <b>Extra Discount:</b> 
                        <span class="text-success">
                            {{ $discountPercent }}% OFF (- ₹{{ number_format($discountAmount, 2) }})
                        </span>
                    </p>

                    <!-- Final Price -->
                    <p><b>NetPrice:</b> ₹{{ number_format($price, 2) }}</p>

                    <hr>

                    <!-- Total -->
                    <h5>
                        Total Payable: ₹
                        <span id="finalText">{{ number_format($price, 2) }}</span>
                    </h5>

                    <input type="hidden" id="finalAmount" value="{{ $price }}">

                    <button class="btn btn-primary w-100 mt-3" id="purchase">
                        Purchase Now
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')

<!-- JS LIBRARIES -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

$("#purchase").click(async function () {

    console.log("Purchase button clicked");

    let btn = $(this);
    btn.prop('disabled', true).text('Processing...');

    let amount = parseFloat($("#finalAmount").val());

    if (!amount || amount <= 0) {
        amount = 1;
    }

    try {

        /* ================= CREATE ORDER ================= */
        const orderRes = await fetch("{{ route('create.order') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                amount: amount // ✅ convert to paise
            })
        });

        const order = await orderRes.json();

        if (!order.order_id) {
            throw new Error("Order creation failed");
        }

        /* ================= RAZORPAY ================= */
        var options = {
            key: order.key,
            amount: order.amount,
            currency: "INR",
            name: "GM Selection Hub",
            description: "Package Purchase",
            order_id: order.order_id,

            prefill: {
                name: "{{ auth()->user()->name ?? 'Customer' }}",
                email: "{{ auth()->user()->email ?? 'test@test.com' }}",
            },

            theme: {
                color: "#3399cc"
            },

            handler: async function (response) {

                try {

                    const verify = await fetch("{{ route('verify.payment') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            razorpay_payment_id: response.razorpay_payment_id,
                            razorpay_order_id: response.razorpay_order_id,
                            razorpay_signature: response.razorpay_signature,
                            amount: amount
                        })
                    });

                    const result = await verify.json();

                    if (result.status === "success") {

                        Swal.fire({
                            icon: 'success',
                            title: 'Payment Successful',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        window.location.href = "/student/success";

                    } else {

                        Swal.fire({
                            icon: 'error',
                            title: 'Payment Verification Failed'
                        });

                        btn.prop('disabled', false).text('Purchase Now');
                    }

                } catch (err) {
                    console.error(err);
                    Swal.fire("Verification error");
                    btn.prop('disabled', false).text('Purchase Now');
                }
            },

            modal: {
                ondismiss: function () {
                    btn.prop('disabled', false).text('Purchase Now');
                }
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();

    } catch (error) {

        console.error(error);

        Swal.fire({
            icon: 'error',
            title: 'Payment initialization failed'
        });

        btn.prop('disabled', false).text('Purchase Now');
    }

});

</script>

@endsection