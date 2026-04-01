@include('admin.layouts.header')

<div class="wrapper">

    @include('admin.layouts.topbar')
    @include('admin.layouts.sidebar')

    @php
    $TotalPrice = $checkout->price_one;
    @endphp

    <div class="container-fluid">
        <div class="container-fluid">

            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h1 class="display-5 mb-4">Checkout</h1>
            </div>

            <div class="row g-2">
                <div class="col-3 col-md-3 col-lg-3">
                </div>
                <div class="col-9 col-md-9 col-lg-9">
                <div class="row g-4">

                    <!-- 30 DAYS -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="text-center text-white p-4 rounded-top"
                                style="background: linear-gradient(135deg, #0d47a1, #1976d2);">
                                <i class="fa fa-clock fa-2x mb-2"></i>
                                <h4 style="color:yellow">30 Days</h4>
                            </div>
                            <div class="p-3">
                                <p><b>MRP:</b> ₹{{$checkout->mrp_one}}</p>
                                <p><b>DISCOUNT:</b> {{$checkout->discount_one}}%</p>
                                <p><b>PRICE:</b> ₹{{$checkout->price_one}}</p>
                                <button class="btn btn-primary w-100"
                                    onclick="getprice({{$checkout->mrp_one}},{{$checkout->discount_one}},{{$checkout->price_one}})">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 90 DAYS -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="text-center text-white p-4 rounded-top"
                                style="background: linear-gradient(135deg, #0d47a1, #1976d2);">
                                <i class="fa fa-clock fa-2x mb-2"></i>
                                <h4 style="color:yellow">90 Days</h4>
                            </div>
                            <div class="p-3">
                                <p><b>MRP:</b> ₹{{$checkout->mrp_two}}</p>
                                <p><b>DISCOUNT:</b> {{$checkout->discount_two}}%</p>
                                <p><b>PRICE:</b> ₹{{$checkout->price_two}}</p>
                                <button class="btn btn-primary w-100"
                                    onclick="getprice({{$checkout->mrp_two}},{{$checkout->discount_two}},{{$checkout->price_two}})">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 180 DAYS -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="text-center text-white p-4 rounded-top"
                                style="background: linear-gradient(135deg, #0d47a1, #1976d2);">
                                <i class="fa fa-clock fa-2x mb-2"></i>
                                <h4 style="color:yellow">180 Days</h4>
                            </div>
                            <div class="p-3">
                                <p><b>MRP:</b> ₹{{$checkout->mrp_three}}</p>
                                <p><b>DISCOUNT:</b> {{$checkout->discount_three}}%</p>
                                <p><b>PRICE:</b> ₹{{$checkout->price_three}}</p>
                                <button class="btn btn-primary w-100"
                                    onclick="getprice({{$checkout->mrp_three}},{{$checkout->discount_three}},{{$checkout->price_three}})">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- 270 DAYS -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="text-center text-white p-4 rounded-top"
                                style="background: linear-gradient(135deg, #0d47a1, #1976d2);">
                                <i class="fa fa-clock fa-2x mb-2"></i>
                                <h4 style="color:yellow">270 Days</h4>
                            </div>
                            <div class="p-3">
                                <p><b>MRP:</b> ₹{{$checkout->mrp_four}}</p>
                                <p><b>DISCOUNT:</b> {{$checkout->discount_four}}%</p>
                                <p><b>PRICE:</b> ₹{{$checkout->price_four}}</p>
                                <button class="btn btn-primary w-100"
                                    onclick="getprice({{$checkout->mrp_four}},{{$checkout->discount_four}},{{$checkout->price_four}})">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- 360 DAYS -->
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
                            <div class="text-center text-white p-4 rounded-top"
                                style="background: linear-gradient(135deg, #0d47a1, #1976d2);">
                                <i class="fa fa-clock fa-2x mb-2"></i>
                                <h4 style="color:yellow">360 Days</h4>
                            </div>
                            <div class="p-3">
                                <p><b>MRP:</b> ₹{{$checkout->mrp_five}}</p>
                                <p><b>DISCOUNT:</b> {{$checkout->discount_five}}%</p>
                                <p><b>PRICE:</b> ₹{{$checkout->price_five}}</p>
                                <button class="btn btn-primary w-100"
                                    onclick="getprice({{$checkout->mrp_five}},{{$checkout->discount_five}},{{$checkout->price_five}})">
                                    Book Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- PURCHASE CARD -->
                    <div class="col-12 col-md-4 col-lg-3">
                        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">

                            <div class="text-center text-white p-4 rounded-top"
                                style="background: linear-gradient(135deg, #0d47a1, #1976d2);">
                                <i class="fa fa-shopping-cart fa-2x mb-2"></i>
                                <h4 style="color:yellow">Purchase</h4>
                            </div>

                            <div class="p-3">
                                <p><b>MRP:</b> ₹<span id="mrp">{{$checkout->mrp_one}}</span></p>
                                <p><b>DISCOUNT:</b> <span id="discount">{{$checkout->discount_one}}</span>%</p>
                                <p><b>PRICE:</b> ₹<span id="price">{{$checkout->price_one}}</span></p>
                                <p><b>Total Pay:</b> ₹<span id="total_text">{{$TotalPrice}}</span></p>

                                <input type="hidden" id="total" value="{{$TotalPrice}}">

                                <button class="btn btn-success w-100" id="purchase">
                                    Purchase Now
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>
    /* SELECT PACKAGE */
    function getprice(mrp, discount, price) {

        $("#mrp").text(mrp);
        $("#discount").text(discount);
        $("#price").text(price);

        $("#total").val(price);
        $("#total_text").text(price.toFixed(2));

        alert("Package Selected");
    }

    /* PURCHASE */
    $("#purchase").click(function() {

        let total = parseFloat($("#total").val());

        if (total <= 0) total = 1;

        $.post("{{ route('manual.create.order') }}", {
            amount: total,
            _token: "{{ csrf_token() }}"
        }, function(order) {
            alert("success")


        });
    });
    </script>