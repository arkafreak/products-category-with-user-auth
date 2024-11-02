<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayPal Checkout</title>
    <script src="https://www.paypal.com/sdk/js?client-id=Acwul7cJu4m2PiwDoyqnxBQ6Gz5l1Kv13jbfk6m0GKWT13fgMS9yvXjTjs-ds82ppHT5DQ9dYY0ObVHj&currency=USD"></script>
    <style>
        /* Basic reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Body styling for full-page scroll */
        body {
            min-height: 100vh;
            padding: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f4;
        }

        /* Container styling */
        .checkout-container {
            text-align: center;
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: auto;
        }

        /* Title styling */
        h2 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* PayPal button container */
        #paypal-button-container {
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="checkout-container">
        <h2>Complete Your Purchase</h2>
        <div id="paypal-button-container"></div>
    </div>

    <script>
        paypal.Buttons({
            createOrder: function (data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '20.00' // Replace with dynamic amount
                        }
                    }]
                });
            },
            onApprove: function (data, actions) {
                return actions.order.capture().then(function (details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);

                    // Send transaction data to server for further processing
                    fetch('/app/services/capture_payment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Server response:', data);
                    })
                    .catch(error => console.error('Error:', error))
                    .finally(() => {
                        // Redirect to Products/index on success
                        window.location.href = "<?php echo URLROOT; ?>/Products/index";
                    });
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>

</html>
