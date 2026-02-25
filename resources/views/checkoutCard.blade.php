@include('layouts.header')

@php

$AfterDiscount = 0;
                            

                            $Totacoinsuse = 0;
                            $TotalPrice = 0;

                            $price = $checkout->price_one;
                            $discount = $checkout->discount_one;
                            $AfterDiscount = ($price * $discount) / 100;

                           $TotalPrice = $checkout->price_one;
                          
                           $LimitPer = $checkout->coin_percentage;
                           $afterLimit = ($TotalPrice * $LimitPer) / 100;
                           $useCoinsOnly =  $TotalPrice - $afterLimit;
                           
                       if(session('type')==="Notes"){
                       $type=session('type');
$coinscheck = DB::table('coins_use')
                           ->where('user_id',Auth::user()->id)
                           ->where('notes_id',session('volumeId'))
                           ->where('status',1)
                           ->first();
                         
                           $Totacoinsuse = isset($coinscheck) && $coinscheck->coinsuse !='' ? $coinscheck->coinsuse : '0';
                           }
                            if(session('type')==="Tests"){
                            $type=session('type');
$coinscheck = DB::table('coins_use')
                           ->where('user_id',Auth::user()->id)
                           ->where('testid',session('volumeId'))
                           ->where('status',1)
                           ->first();
                         
                           $Totacoinsuse = isset($coinscheck) && $coinscheck->coinsuse !='' ? $coinscheck->coinsuse : '0';
                           }
                            if(session('type')==="Batch"){
                            $type=session('type');
$coinscheck = DB::table('coins_use')
                           ->where('user_id',Auth::user()->id)
                           ->where('batch_id',session('volumeId'))
                           ->where('status',1)
                           ->first();
                         
                           $Totacoinsuse = isset($coinscheck) && $coinscheck->coinsuse !='' ? $coinscheck->coinsuse : '0';
                           }
@endphp

        <!-- Offer Start -->
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h1 class="display-5 mb-4">Checkout</h1>  
                </div>
                <div class="row g-4">
    <div class="col-6 col-md-4 col-lg-3">
        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" 
                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">
                <i class="fa fa-clock fa-2x mb-2"></i>
                <h4 class="mb-0" style="color:yellow">30 Days</h4>
            </div>
            
            <div class="rounded-bottom p-3">
                <p><b>MRP:</b> ₹{{$checkout->mrp_one}}</p>
                <p><b>DISCOUNT:</b> {{$checkout->discount_one}}%</p>
                 <p><b>PRICE:</b> ₹{{$checkout->price_one}}</p>
                <a class="btn btn-primary btn-sm w-100" href="#purchasedCard" onClick="getprice({{$checkout->mrp_one}},{{$checkout->discount_one}},{{$checkout->price_one}})">Book Now</a>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-4 col-lg-3">
        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" 
                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">
                <i class="fa fa-clock fa-2x mb-2"></i>
                <h4 class="mb-0" style="color:yellow">90 Days</h4>
            </div>
            <div class="rounded-bottom p-3">
                <p><b>MRP:</b> ₹{{$checkout->mrp_two}}</p>
                <p><b>DISCOUNT:</b> {{$checkout->discount_two}}%</p>
                 <p><b>PRICE:</b> ₹{{$checkout->price_two}}</p>
                <a class="btn btn-primary btn-sm w-100" href="#purchasedCard" onClick="getprice({{$checkout->mrp_two}},{{$checkout->discount_two}},{{$checkout->price_two}})">Book Now</a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" 
                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">
                <i class="fa fa-clock fa-2x mb-2"></i>
                <h4 class="mb-0" style="color:yellow">180 Days</h4>
            </div>
            <div class="rounded-bottom p-3">
                <p><b>MRP:</b> ₹{{$checkout->mrp_three}}</p>
                <p><b>DISCOUNT:</b> {{$checkout->discount_three}}%</p>
                 <p><b>PRICE:</b> ₹{{$checkout->price_three}}</p>
                <a class="btn btn-primary btn-sm w-100" href="#purchasedCard" onClick="getprice({{$checkout->mrp_three}},{{$checkout->discount_three}},{{$checkout->price_three}})">Book Now</a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" 
                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">
                <i class="fa fa-clock fa-2x mb-2"></i>
                <h4 class="mb-0" style="color:yellow">270 Days</h4>
            </div>
            <div class="rounded-bottom p-3">
               <p><b>MRP:</b> ₹{{$checkout->mrp_four}}</p>
                <p><b>DISCOUNT:</b> {{$checkout->discount_four}}%</p>
                 <p><b>PRICE:</b> ₹{{$checkout->price_four}}</p>
                <a class="btn btn-primary btn-sm w-100" href="#purchasedCard" onClick="getprice({{$checkout->mrp_four}},{{$checkout->discount_four}},{{$checkout->price_four}})">Book Now</a>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4 col-lg-3">
        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" 
                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">
                <i class="fa fa-clock fa-2x mb-2"></i>
                <h4 class="mb-0" style="color:yellow">360 Days</h4>
            </div>
            <div class="rounded-bottom p-3">
               <p><b>MRP:</b> ₹{{$checkout->mrp_five}}</p>
                <p><b>DISCOUNT:</b> {{$checkout->discount_five}}%</p>
                 <p><b>PRICE:</b> ₹{{$checkout->price_five}}</p>
                <a class="btn btn-primary btn-sm w-100" href="#purchasedCard" onClick="getprice({{$checkout->mrp_five}},{{$checkout->discount_five}},{{$checkout->price_five}})">Book Now</a>
            </div>
        </div>
    </div>
    
    
    
<!--     <div class="col-6 col-md-4 col-lg-3">-->
<!--        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">-->
<!--             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" -->
<!--                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">-->
<!--                <i class="fas fa-coins fa-2x mb-2"></i>-->
<!--                <h4 class="mb-0" style="color:yellow">Coins Card</h4>-->
<!--            </div>-->
<!--            <div class="rounded-bottom p-3">-->
               <!--<p><b>Total Coins Use:</b> <i class="fa fa-rupee"></i><span id="total_coinsuse">{{isset($coinscheck) && $coinscheck->coinsuse !='' ? $coinscheck->coinsuse : '0'}}</span></p>-->
                
                
<!--                @if(isset($coinscheck))-->
<!--                      <span class="text-danger">You have already applied coin in this test series</span>-->

<!--                     @else-->
<!--                     <span class="text-danger">Use coins only <i class="fa fa-rupee"></i>{{$afterLimit}} from the <i class="fa fa-rupee"></i>{{Auth::user()->coins}}</span>-->

<!--                     @endif -->
<!--                     <input class="form-control" name="coins" placeholder="Enter Coins" value="{{isset($coinscheck) && $coinscheck->coinsuse !='' ? 0 : $afterLimit}}" readonly id="coins"><br>-->
<!--                      <input type="hidden" name="total" id="total" value={{$TotalPrice - $Totacoinsuse}}>-->

<!--                      @if(isset($coinscheck))-->
<!--                      <button class="btn btn-warning btn-sm w-100" type="button" onClick="reStore({{$coinscheck->id}},{{$coinscheck->coinsuse}})">Restore Coin</button>-->
                     

<!--@else-->
<!--<button class="btn btn-primary btn-sm w-100" type="button" id="apply">Apply</button>-->

<!--@endif-->
<!--<br><br>-->
                
                
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    
    
      <div class="col-12 col-md-4 col-lg-3" id="purchasedCard">
        <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" 
                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">
                <i class="fa fa-shopping-cart fa-2x mb-2"></i>
                <h4 class="mb-0" style="color:yellow">Purchased Card</h4>
            </div>
            
            
            <div class="rounded-bottom p-3">
             <input type="hidden" name="total" id="total" value={{$TotalPrice - $Totacoinsuse}}>
                                   <input type="hidden" name="totalCoinsuse" id="totalCoinsuse" value="0">


               <p><b>MRP:</b> ₹<span id="mrp">{{$checkout->mrp_one}}</span></p>
                <p><b>DISCOUNT:</b> <span id="discount">{{$checkout->discount_one}}</span>%</p>
                 <p><b>PRICE:</b> ₹<span id="price">{{$checkout->price_one}}</span></p>
                   <p><b>Total Coins Use:</b> <i class="fa fa-rupee"></i><span id="total_coinsuse">{{isset($coinscheck) && $coinscheck->coinsuse !='' ? $coinscheck->coinsuse : '0'}}</span></p>
                   
                                            <p><b>Total Pay Amount:</b> <i class="fa fa-rupee"></i><span id="total_text">{{$TotalPrice - $Totacoinsuse}}</span></p>
<p><b>Platform Fee:</b> <i class="fa fa-rupee"></i><span id="platformFee">0</span></p>
               
                
               @if(isset($coinscheck))
                      <span class="text-danger">You have already applied coin in this Notes</span>

                     @else
                     <span class="text-danger">You can use {{$checkout->coin_percentage}}% Coins of the price</span>

                     @endif 
                     <input class="form-control" name="coins" placeholder="Enter Coins" value="{{isset($coinscheck) && $coinscheck->coinsuse !='' ? 0 : $afterLimit}}"  id="coins"><span class="text-danger">Available Coins:</span> <i class="fa fa-rupee"></i><span id="availaCoins">{{Auth::user()->coins}}</span><br>
                      
                      @if(isset($coinscheck))
                      <button class="btn btn-primary btn-sm w-100 " type="button" id="applycoin" disabled>Apply Coins</button><br>
                     

@else
<!--<button  class="btn btn-info btn-sm w-100" type="button" id="apply">Apply Coupon</button>-->
<button class="btn btn-primary btn-sm w-100" type="button" id="applycoin">Apply Coins</button><br>
@endif
<div id="buttonContainer"></div>

@if($coupons)
<select class="form-control" name="coupon" id="coupon" style="margin-top:10px">
    <option value="">Select Coupon</option>
    @foreach($coupons as $coupon)
        <option 
            value="{{ $coupon->id }}"
            data-value="{{ $coupon->value }}"
            data-type="{{ $coupon->discount_type }}"
            data-minimum_price="{{$coupon->minimum_price}}">
            {{ $coupon->coupon_code }} - {{ $coupon->value }}{{ $coupon->discount_type === 'percentage' ? '%' : '' }}
        </option>
    @endforeach
</select>

<button class="btn btn-info btn-sm w-100 mt-2" type="button" id="applyCoupon">
    Apply Coupon
</button>


@endif

                                 

                
<br><br>
               
                <button class="btn btn-primary btn-sm w-100" id="purchase">Purchased Now</button>
            </div>
        </div>
    </div>
    
</div>
            </div>
        </div>
        <!-- Offer End -->

        @include('layouts.footer')
                <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
/* ================= PURCHASE ================= */

$("#purchase").on("click", function () {

    let total = parseFloat($("#total").val());

    if (total <= 0) {
       total=1;
    }

    /* STEP 1: CREATE ORDER */
    $.ajax({
        url: "{{ route('create.order') }}",   // route -> PaymentController@createOrder
        type: "POST",
        data: {
            amount: total,
            _token: "{{ csrf_token() }}"
        },
        success: function (order) {

            /* STEP 2: OPEN RAZORPAY */
            var options = {
                key: order.key,
                amount: order.amount,
                currency: "INR",
                name: "GM Selection Hub",
                description: "Package Purchase",
                order_id: order.order_id,

                handler: function (response) {

                    /* STEP 3: VERIFY PAYMENT */
                    response.amount = total;

                    $.ajax({
                        url: "{{ route('verify.payment') }}", // PaymentController@verifyPayment
                        type: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        data: response,
                        success: function (res) {
                            if (res.status === "success") {
                                Swal.fire({
                                    toast: true,
                                    position: "top-end",
                                    icon: "success",
                                    title: "Package Purchased Successfully",
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                window.location.href = "/student/success";
                            } else {
                                Swal.fire("Payment Failed", res.error, "error");
                            }
                        }
                    });
                },

                theme: {
                    color: "#3399cc"
                }
            };

            new Razorpay(options).open();
        }
    });
});


/* ================= APPLY COINS ================= */
$("#applycoin").on("click", function () {
let types="{{$type}}";
console.log("type when apply Coin",types);

    let coins = parseFloat($("#coins").val());
    let userCoins = parseFloat("{{ Auth::user()->coins }}");
    let total = parseFloat($("#total").val());

    if (coins <= 0) {
        Swal.fire({
            toast:true,
            position:'top-end',
            icon:'error',
            title:"Invalid coins amount",
            showConfirmButton:false,
            timer:3000
        });
        return;
    }

    let coinsToUse = Math.min(coins, userCoins);
    let finalTotal = total - coinsToUse;
    if (finalTotal < 0) finalTotal = 0;

    $("#total").val(finalTotal);
    $("#total_text").text(finalTotal.toFixed(2));
    $("#total_coinsuse").text(coinsToUse);
    $("#totalCoinsuse").val(coinsToUse);
    $("#availaCoins").text(userCoins - coinsToUse);
    $("#coins").val(0);
   $.ajax({
    url: "{{ route('save.coins') }}",
    type: "POST",
    data: {
        coins: coinsToUse,
        type: types,
        _token: "{{ csrf_token() }}"
    },
    success: function (data) {

        console.log("after apply coin =", data);

        // Remove old cancel button if already exists
        $("#cancelCoinBtn").remove();

        // Append new cancel button with coin ID
        $("#buttonContainer").append(
            '<button id="cancelCoinBtn" class="btn btn-danger" onclick="reStore(' + data.usecoins.id + ')">Cancel Apply Coin</button>'
        );
        console.log("finalTotal",finalTotal);
        if(finalTotal==0){
            $("#platformFee").text("1");
        }
    },
    error: function (xhr) {
        console.log("Error:", xhr.responseText);
    }
});


    

    $("#applycoin").hide();

    Swal.fire({
        toast:true,
        position:'top-end',
        icon:'success',
        title:"Coins Applied Successfully",
        showConfirmButton:false,
        timer:3000
    });
});

$("#applyCoupon").click(function () {

    let option = $("#coupon option:selected");
let total = parseFloat($("#total").val());
if (option.val() === "") {
        alert("Please select a coupon");
        return;
    }
        let minimum_price = option.data("minimum_price");

 if (total < minimum_price) {
        alert("Minimum price Should be or More = "+minimum_price);
        return;
    }

    let value = parseFloat(option.data("value"));
    let type = option.data("type");
    

    let discount = 0;

    if (type === "percentage") {
        discount = (total * value) / 100;
    } else {
        discount = value;
    }

    if (discount > total) discount = total;

    let finalTotal = total - discount;

    $("#coupon_discount").val(discount);
    $("#coupon_text").text(discount);
    $("#total").val(finalTotal);
    $("#total_text").text(finalTotal.toFixed(2));

    $("#applyCoupon").prop("disabled", true);
    $("#coupon").prop("disabled", true);

    alert("Coupon applied successfully");
});
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


/* ================= PACKAGE SELECT ================= */
function getprice(mrp, discount, price) {

    let usedCoins = parseFloat($("#totalCoinsuse").val());

    $("#mrp").text(mrp);
    $("#discount").text(discount);
    $("#price").text(price);

    let total = parseFloat(price) - usedCoins;
    $("#total").val(total);
    $("#total_text").text(total.toFixed(2));

    let limitPercent = {{ $checkout->coin_percentage }};
    let maxCoins = (price * limitPercent) / 100;

    $("#coins").val(maxCoins - usedCoins);

    Swal.fire({
        toast:true,
        position:'top-end',
        icon:'success',
        title:"Package Selected Successfully",
        showConfirmButton:false,
        timer:3000
    });
}
</script>
