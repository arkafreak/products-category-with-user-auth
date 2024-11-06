<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script> <!-- Stripe.js -->
    <style>
        /* Simple styles for the form */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 50px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #6772e5;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        h2 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Stripe Payment</h2>

        <!-- Display the Order ID and Total Amount dynamically -->
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($orderId); ?></p>
        <p><strong>Total Amount:</strong> Rs. <?php echo number_format($totalAmount, 2); ?></p>

        <!-- Stripe Payment Form -->
        <form id="payment-form">
            <input type="hidden" name="orderId" value="<?php echo htmlspecialchars($orderId); ?>">
            <input type="hidden" name="totalAmount" value="<?php echo htmlspecialchars($totalAmount); ?>">

            <!-- Card details field (Stripe Elements will mount here) -->
            <div id="card-element" class="form-input">
                <!-- A Stripe Element will be inserted here. -->
            </div>

            <!-- Error message for invalid card details -->
            <div id="card-errors" role="alert"></div>

            <!-- Payment button -->
            <button id="submit" class="btn">Pay Now</button>
        </form>
    </div>

    <script>
        // Initialize Stripe
        const stripe = Stripe('pk_test_51QI0l6EJzWqJA7Rbz3ITg86DFrtjciz01KpRCQ4dTZOVnb3X51VXWvIvE3hxJlkMEOhtXTfWwzG3jsixSfed2SmU00aa6dp11R'); // Replace with your Stripe publishable key
        const elements = stripe.elements();

        // Create an instance of the card Element.
        const card = elements.create('card');

        // Mount the card element to the DOM
        card.mount('#card-element');

        // Handle form submission
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Disable the button to prevent multiple submissions
            document.getElementById('submit').disabled = true;

            // Create a token using the card details entered by the user
            const {
                token,
                error
            } = await stripe.createToken(card);

            if (error) {
                // If there's an error, display it to the user
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                document.getElementById('submit').disabled = false;
            } else {
                // If no error, send the token to the server for processing
                const orderId = document.querySelector('input[name="orderId"]').value;
                const totalAmount = document.querySelector('input[name="totalAmount"]').value;

                // Send the token and other order details to your backend
                const response =  fetch('<?php echo URLROOT; ?>/services/create_payment_intent.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                });

                const data = response.json();

                if (data.status === 'success') {
                    // If the payment is successful, redirect to the checkout page
                    window.location.href = "<?php echo URLROOT; ?>/OrderController/checkout";
                } else {
                    // If there is an error, show it to the user
                    const errorElement = document.getElementById('card-errors');
                    errorElement.textContent = data.error || 'Payment failed!';
                    document.getElementById('submit').disabled = false;
                }
            }
        });
    </script>

</body>

</html>