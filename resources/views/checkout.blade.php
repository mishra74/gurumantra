@include('layouts.header')

@php
$price = 0;

    $type = session('type');
    $price = $checkout->price;


$coinPercent = $checkout->coin_percentage;
$maxCoinUse  = ($price * $coinPercent) / 100;
@endphp

<div class="container py-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <p><b>MRP:</b> ₹{{ $checkout->mrp }}</p>
                    <p><b>Price:</b> ₹{{ $price }}</p>

                    <p><b>Available Coins:</b> ₹
                        <span id="availableCoins">{{ Auth::user()->coins }}</span>
                    </p>

                    <p class="text-danger">
                        Max coins usable ({{ $coinPercent }}%):
                        ₹{{ number_format($maxCoinUse,2) }}
                    </p>

                   

                    {{-- COINS --}}
                    <input type="number"
                           id="coins"
                           class="form-control mb-3"
                           placeholder="Enter coins"
                           max="{{ $maxCoinUse }}" value="{{$maxCoinUse}}">

                    <button class="btn btn-success w-100 mb-3" id="applyDiscount">
                        Apply Coins
                    </button>
 {{-- COUPON --}}
                    @if($coupons)
                    <select class="form-control mb-2" id="coupon">
                        <option value="">Select Coupon</option>
                        @foreach($coupons as $coupon)
                            <option
                                value="{{ $coupon->id }}"
                                data-value="{{ $coupon->value }}"
                                data-type="{{ $coupon->discount_type }}"
                                data-min="{{ $coupon->minimum_price }}">
                                {{ $coupon->coupon_code }}
                                ({{ $coupon->value }}
                                {{ $coupon->discount_type === 'percentage' ? '%' : '₹' }})
                            </option>
                        @endforeach
                    </select>
                    @endif
                    <div id="buttonContainer"></div>

                    <hr>

                    <p><b>Total Payable:</b> ₹
                        <span id="finalText">{{ $price }}</span>
                    </p>

                    <input type="hidden" id="basePrice" value="{{ $price }}">
                    <input type="hidden" id="finalAmount" value="{{ $price }}">
                    <input type="hidden" id="totalCoinsUse" value="0">

                    <button class="btn btn-primary w-100" id="purchase">
                        Purchase Now
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

let basePrice      = parseFloat($("#basePrice").val());
let userCoins      = {{ Auth::user()->coins }};
let maxCoins       = {{ $maxCoinUse }};
let coinPercent    = {{ $coinPercent }};
let types          = "{{ session('type') }}";

let appliedCoins   = 0;
let couponDiscount = 0;


/* ================= APPLY COINS ================= */

$("#applyDiscount").click(function () {

    let coins = parseFloat($("#coins").val()) || 0;

    coins = Math.min(coins, userCoins, maxCoins);

    if (coins <= 0) {
        Swal.fire("Invalid coin amount");
        return;
    }

    appliedCoins = coins;

    $.ajax({
        url: "{{ route('save.coins') }}",
        type: "POST",
        data: {
            coins: coins,
            type: types,
            _token: "{{ csrf_token() }}"
        },
        success: function (data) {

            $("#totalCoinsUse").val(coins);
            $("#availableCoins").text(userCoins - coins);

            $("#buttonContainer").html(`
                <button id="cancelCoinBtn"
                    class="btn btn-danger w-100 mb-2"
                    onclick="reStore(${data.usecoins.id})">
                    Cancel Applied Coins
                </button>
            `);

            calculateFinalAmount();
            $("#applyDiscount").hide();

            Swal.fire({
                toast:true,
                position:'top-end',
                icon:'success',
                title:'Coins Applied Successfully',
                showConfirmButton:false,
                timer:2000
            });
        }
    });
});


/* ================= COUPON CHANGE ================= */

$("#coupon").change(function () {
    calculateFinalAmount();
});


/* ================= CALCULATE FINAL ================= */

function calculateFinalAmount() {

    let totalAfterCoins = basePrice - appliedCoins;
    if (totalAfterCoins < 0) totalAfterCoins = 0;

    let option = $("#coupon option:selected");
    couponDiscount = 0;

    if (option.val()) {

        let minPrice = parseFloat(option.data("min"));
        if (totalAfterCoins < minPrice) {
            Swal.fire("Minimum price should be ₹" + minPrice);
            return;
        }

        let value = parseFloat(option.data("value"));
        let type  = option.data("type");

        couponDiscount = (type === 'percentage')
            ? (totalAfterCoins * value) / 100
            : value;

        if (couponDiscount > totalAfterCoins)
            couponDiscount = totalAfterCoins;
    }

    let finalAmount = totalAfterCoins - couponDiscount;
    if (finalAmount < 0) finalAmount = 0;

    /* PLATFORM FEE */
    if (finalAmount == 0) {
        finalAmount = 1;
    }

    $("#finalAmount").val(finalAmount);
    $("#finalText").text(finalAmount.toFixed(2));
}


/* ================= RESTORE COINS ================= */

function reStore(id) {

    $.ajax({
        url: "{{ route('resotore.coins') }}",
        type: "POST",
        data: {
            id: id,
            _token: "{{ csrf_token() }}"
        },
        success: function () {
            location.reload();
        }
    });
}


/* ================= PURCHASE ================= */

$("#purchase").click(async function () {

    let amount = parseFloat($("#finalAmount").val());
    if (amount <= 0) amount = 1;

    const orderRes = await fetch("{{ route('create.order') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ amount })
    });

    const order = await orderRes.json();
    console.log(order);

    new Razorpay({
        key: order.key,
        amount: order.amount,
        currency: "INR",
        name: "GM Selection Hub",
        description: "Package Purchase",
        order_id: order.order_id,

        handler: async function (response) {

            response.amount = amount;

            const verify = await fetch("{{ route('verify.payment') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(response)
            });

            const result = await verify.json();

            if (result.status === "success") {
                Swal.fire({
                    icon:'success',
                    title:'Payment Successful',
                    timer:2000,
                    showConfirmButton:false
                });

                window.location.href = "/student/success";
            } else {
                Swal.fire("Payment Failed");
            }
        }

    }).open();

});

</script>
