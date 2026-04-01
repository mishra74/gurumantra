@php
    $price = $checkout->price;
@endphp

@include('admin.layouts.header')

<div class="wrapper">

    @include('admin.layouts.topbar')
    @include('admin.layouts.sidebar')

    <div class="container py-5">
        <h2 class="text-center mb-4">Checkout</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow">
                    <div class="card-body text-center">

                        <p><b>MRP:</b> ₹{{ $checkout->mrp }}</p>
                        <p><b>Price:</b> ₹{{ $price }}</p>

                        <!-- Hidden total -->
                        <input type="hidden" id="totalAmount" value="{{ $price }}">

                        <h4 class="mt-3">
                            Total Pay: ₹<span id="finalText">{{ $price }}</span>
                        </h4>

                        <button class="btn btn-primary w-100 mt-3" id="purchase">
                            Purchase Now
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>



<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

/* ================= PURCHASE ================= */

$("#purchase").click(async function () {

    let amount = parseFloat($("#totalAmount").val());

    if (amount <= 0) {
        amount = 1; // minimum payment safeguard
    }

    try {

        /* STEP 1: CREATE ORDER */
        const orderRes = await fetch("{{ route('manual.create.order') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ amount })
        });

    } catch (error) {
        console.error(error);
        alert("Something went wrong!");
    }

});

</script>