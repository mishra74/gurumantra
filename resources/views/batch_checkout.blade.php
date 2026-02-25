@include('layouts.header')


        <!-- Offer Start -->
        <div class="container-fluid offer-section py-5">
            <div class="container py-5">
                <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                    <h1 class="display-5 mb-4">Checkout</h1>  
                </div>
                <div class="row g-5 align-items-center">
                    <div class="col-xl-5 wow fadeInLeft" data-wow-delay="0.2s">
                    <form>
                    <div class="service-item shadow-sm p-3 mb-5 bg-body rounded">
                           
        
             <div class="service-thumbnail d-flex flex-column justify-content-center align-items-center text-white p-4 rounded-top" 
                 style="background: linear-gradient(135deg, #0d47a1, #1976d2); height: 150px;">
                <i class="fa fa-shopping-cart fa-2x mb-2"></i>
                <h4 class="mb-0" style="color:yellow">Pruchased Card</h4>
            </div>
            
       
 

                            @php

                            $AfterDiscount = 0;
                            $Totacoinsuse = 0;
                            $TotalPrice = 0;

                            $price = $checkout->price;
                            $discount = $checkout->mrp-$checkout->price;
                            $AfterDiscount = ($price * $discount) / 100;

                            if(isset($checkout->price)){
                                $TotalPrice = $checkout->price;
                            }else{
                                $TotalPrice = $checkout->price_one;
                            }
                          
                           $LimitPer = $checkout->coin_percentage;
                           $afterLimit = ($TotalPrice * $LimitPer) / 100;
                           $useCoinsOnly =  $TotalPrice - $afterLimit;
                       

                           $coinscheck = DB::table('coins_use')
                           ->where('user_id',Auth::user()->id)
                           ->where('testid',session('volumeId'))
                           ->where('status',0)
                           ->first();
                           $Totacoinsuse = isset($coinscheck) && $coinscheck->coinsuse !='' ? $coinscheck->coinsuse : '0';
                           

                            



                            @endphp
                            <div class="rounded-bottom p-4">
                                <a href="#" class="h4 d-inline-block mb-4"></a><br>
                                <p><b>Start Date:</b> {{$checkout->test_startDate}}</p>
                                
                                <p><b>Available Coins:</b> <i class="fa fa-rupee"></i><span id="availCoins">{{Auth::user()->coins}}<span></p>
                              
                                @if(isset($checkout->mrp) && $checkout->mrp!='')
                                <p><b>MRP:</b> <i class="fa fa-rupee"></i>{{$checkout->mrp}}</p>
                                @else
                                <p><b>MRP:</b> <i class="fa fa-rupee"></i>{{$checkout->mrp_one}}</p>
                                @endif
                                
                                @if(isset($checkout->price) && $checkout->price!='')
                                <p><b>Price:</b> <i class="fa fa-rupee"></i>{{$checkout->price}}</p>

                                @else
                                <p><b>Price:</b> <i class="fa fa-rupee"></i>{{$checkout->price_one}}</p>

                                @endif

                                @if(isset($checkout->discount_one))
                                <p><b>Discount:</b> {{$checkout->discount_one}}%</p>
                                @endif

                                @if(isset($checkout->discount_one))
                                <p><b>After Discount:</b> <i class="fa fa-rupee"></i>{{$checkout->price_one - $AfterDiscount}}</p>
                            @endif


                            <p><b>Total Coins Use:</b> <i class="fa fa-rupee"></i><span id="total_coinsuse">{{isset($coinscheck) && $coinscheck->coinsuse !='' ? $coinscheck->coinsuse : '0'}}</span></p>

                            <p><b>Total Pay Amount:</b> <i class="fa fa-rupee"></i><span id="total_text">{{$TotalPrice - $Totacoinsuse}}</span></p>


                               
                                <lable><b>Validity:</b> </lable>

                                @if($checkout->extend_type == 'fixed')
                      <select class="form-control" name="validy">
                        <option selected>30 Days</option>
                        <option>90 Days</option>
                        <option>180 Days</option>
                        <option>270 Days</option>
                        <option>360 Days</option>
                      </select><br>
                      @else
                      {{$checkout->validity_value}} {{$checkout->validity_type}}<br><br>

                      @endif



                      @if(isset($coinscheck))
                      <span class="text-danger">You have already applied coin in this test series</span>

                     @else
                     <span class="text-danger">You can use coins only <i class="fa fa-rupee"></i>{{$afterLimit}} from the <i class="fa fa-rupee"></i>{{Auth::user()->coins}}</span>

                     @endif 
                     <input class="form-control" name="coins" placeholder="Enter Coins" value="{{isset($coinscheck) && $coinscheck->coinsuse !='' ? 0 : $afterLimit}}"  id="coins"><br>
                      <input type="hidden" name="total" id="total" value={{$TotalPrice - $Totacoinsuse}}>
                      <input type="hidden" name="totalCoinsuse" id="totalCoinsuse" value="">

                      @if(isset($coinscheck))
                      <button class="btn sm-btn btn-warning rounded-pill py-2 px-4" type="button" onClick="reStore({{$coinscheck->id}},{{$coinscheck->coinsuse}})">Restore Coin</button>
                     

@else
<button class="btn sm- btn btn-success rounded-pill py-2 px-4" type="button" id="apply">Apply</button>

@endif
<br><br>
                                <button class="btn btn-primary rounded-pill py-2 px-4" href="" type="button" id="purchase">Purchase Now</button>
                            </div>
                            
                        </div>

                     
                    </form>    


                    </div>
                    <div class="col-xl-4 wow fadeInRight" data-wow-delay="0.4s">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Offer End -->

        @include('layouts.footer')
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

// $("#purchase").on('click',function(){
  
//     var total = $("#total").val();

//     $.ajax({
//             url: "{{ route('purchased.saved') }}",
//             type: "POST",
//             data: {
//                 total: total,
//                 _token: "{{ csrf_token() }}" // CSRF token zaroori hai Laravel me
//             },
//             success: function(res){

//                 //window.location.href = "/student/success";
              

//             },
//             error: function(xhr){
//                 console.log(xhr.responseText);
//             }
//         });



//     Swal.fire({
//         toast: true,
//         position: 'top-end',   
//         icon: 'success',
//         title: "Purchased Successfully",
//         showConfirmButton: false,
//         timer: 3000
//     });

// })

$("#apply").on('click',function(){
var coins = $("#coins").val();
var userCoins = "{{Auth::user()->coins}}";

$("#totalCoinsuse").val(parseFloat(coins) - parseFloat(userCoins));

// if(parseFloat(coins) > parseFloat(userCoins)){
   

//     Swal.fire({
//       toast: true,
//       position: 'top-end',   
//       icon: 'error',
//       title: "Sorry, you don't have enough coins",
//       showConfirmButton: false,
//       timer: 3000
//   });
//   return false;

// }



if(parseFloat(coins) <= 0){
    Swal.fire({
      toast: true,
      position: 'top-end',   
      icon: 'error',
      title: "Coins Amount Invalid",
      showConfirmButton: false,
      timer: 3000
  });
  return false;
}
         $.ajax({
            url: "{{ route('save.coins') }}",
            type: "POST",
            data: {
                coins: coins,
                _token: "{{ csrf_token() }}" // CSRF token zaroori hai Laravel me
            },
            success: function(res){
               $("#total_coinsuse").text(res.useCoims)
               $("#availCoins").val(res.avail);
               var totalAmount = $("#total").val();
               $("#total").val(parseFloat(totalAmount) - parseFloat(res.useCoims))
               $("#total_text").text(parseFloat(totalAmount) - parseFloat(res.useCoims));
               $("#coins").val(0)

               Swal.fire({
      toast: true,
      position: 'top-end',   
      icon: 'success',
      title: "Coins Apply Successfully",
      showConfirmButton: false,
      timer: 3000
  });
            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });
   



  
 

})


function reStore(id,usecoins){


    if(usecoins <= 0){
    Swal.fire({
      toast: true,
      position: 'top-end',   
      icon: 'error',
      title: "Restore Coins Amount Invalid",
      showConfirmButton: false,
      timer: 3000
  });
}
            $.ajax({
            url: "{{ route('resotore.coins') }}",
            type: "POST",
            data: {
                id: id,
                usecoins:usecoins,
                _token: "{{ csrf_token() }}" // CSRF token zaroori hai Laravel me
            },
            success: function(res){
                location.reload();

            },
            error: function(xhr){
                console.log(xhr.responseText);
            }
        });



}



    

</script>
<!-- payment function -->
<script>
        document.getElementById('purchase').onclick = async function () {
            var total = $("#total").val();
            const response = await fetch("{{ route('create.order') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ amount: total }) // amount in INR
            });

            const order = await response.json();
           
            //console.log(total);
            //return false;

            var options = {
                "key": order.key,
                "amount": total,
                "currency": "INR",
                "name": "GM Selection Hub",
                "description": "GM Selection Hub",
                "order_id": order.order_id,
                "handler": async function (response) {
                    response.amount = total;
                    const verifyRes = await fetch("{{ route('verify.payment') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify(response)
                    });
                    const verifyData = await verifyRes.json();
                    if (verifyData.status === 'success') {
                        //alert("✅ Payment Successful! Payment ID: " + verifyData.payment_id);
                        Swal.fire({
      toast: true,
      position: 'top-end',   
      icon: 'success',
      title: "Package Purchased Successfully",
      showConfirmButton: false,
      timer: 3000
  });
                         window.location.href = "/student/success";
                    } else {
                        Swal.fire({
      toast: true,
      position: 'top-end',   
      icon: 'error',
      title: "Server error check mannual",
      showConfirmButton: false,
      timer: 3000
  });
                    }
                },
                "theme": {
                    "color": "#3399cc"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
        };
    </script>