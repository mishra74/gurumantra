<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Razorpay Payment</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h2>Pay ₹500 using Razorpay</h2>
    <button id="payBtn">Pay Now</button>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        document.getElementById('payBtn').onclick = async function () {
            const response = await fetch("{{ route('create.order') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ amount: 500 }) // amount in INR
            });

            const order = await response.json();

            var options = {
                "key": order.key,
                "amount": order.amount,
                "currency": "INR",
                "name": "Thinkwise",
                "description": "Test Transaction",
                "order_id": order.order_id,
                "handler": async function (response) {
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
                        alert("✅ Payment Successful! Payment ID: " + verifyData.payment_id);
                    } else {
                        alert("❌ Payment Failed!");
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
</body>
</html>
