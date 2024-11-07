<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            margin: 10px 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table Header and Cells Styling */
        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
            /* Adds both column and row lines */
        }

        /* Table Header */
        table th {
            background-color: #4CAF50;
            color: white;
        }

        /* Alternating Row Colors */
        table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        /* Hover Effect for Rows */
        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styles */
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Link Styling */
        a {
            text-decoration: none;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            table {
                width: 100%;
                margin: 10px;
            }

            button {
                width: 100%;
                font-size: 18px;
            }
        }

        canvas {
            max-width: 800px;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <h1>Admin Dashboard</h1>
    <h2>Purchased Products Grouped by Date & Time</h2>

    <?php foreach ($data['groupedProducts'] as $dateTime => $products): ?>
        <h3><?php echo htmlspecialchars($dateTime); ?></h3>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Quantity Purchased</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product->id); ?></td>
                        <td><?php echo htmlspecialchars($product->productName); ?></td>
                        <td><?php echo htmlspecialchars($product->brand); ?></td>
                        <td><?php echo htmlspecialchars($product->quantity); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
    <h2>Sales by Payment Method</h2>
    <canvas id="paymentMethodChart" width="400" height="200"></canvas>

    <script>
        // Prepare the data for the pie chart
        var paymentMethods = <?php echo json_encode($data['salesData']); ?>;
        var labels = [];
        var data = [];
        paymentMethods.forEach(function(item) {
            labels.push(item.paymentMethod);
            data.push(item.total_sales);
        });

        // Create the pie chart
        var ctx = document.getElementById('paymentMethodChart').getContext('2d');
        var paymentMethodChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales by Payment Method',
                    data: data,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0'],
                    hoverOffset: 4
                }]
            }
        });
    </script>

    <h3>Revenue Over Time</h3>
    <canvas id="revenueChart" width="400" height="200"></canvas>

    <script>
        // Prepare the data for the line chart
        // Prepare the data for the line chart
        var revenueData = <?php echo json_encode($data['revenueData']); ?>;
        var labels = [];
        var data = [];

        revenueData.forEach(function(item) {
            labels.push(item.date); // X-axis: Date
            data.push(parseFloat(item.revenue)); // Y-axis: Total Revenue, convert to number
        });

        // Create the line chart
        var ctx2 = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels, // Dates on the X-axis
                datasets: [{
                    label: 'Total Revenue',
                    data: data, // Revenue data (now as numbers)
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <br>
    <a href="<?php echo URLROOT; ?>/Products/index">
        <button>Go back</button>
    </a>
</body>

</html>