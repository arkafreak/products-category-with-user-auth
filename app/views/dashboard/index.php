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

            .chart-container {
                flex-direction: column;
                /* Stack charts vertically on small screens */
            }

            canvas {
                width: 100%;
                height: auto;
                /* Ensure the charts are responsive */
            }
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin: 20px auto;
            max-width: 700px;
            /* Limit max width */
            align-items: center;
            margin-top: 10px;
            /* Ensure both items are aligned centrally along the cross axis */
        }

        /* Uniform canvas sizing for both chart and graph */
        canvas {
            flex: 1;
            /* Makes each canvas take equal available space */
            height: 300px;
            /* Set fixed height for both charts */
            max-width: 48%;
            /* Ensure both charts take up equal space, avoid stretching */
        }
    </style>
</head>

<body>
    <h1>Admin Dashboard</h1>
    <h2>Purchased Products Grouped by Date & Time</h2>
    <a href="<?php echo URLROOT; ?>/Products/index">
        <button>Go back</button>
    </a>
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
    <h2>Sales by Payment Method, and Total revenue on the basis of Date</h2>

    <div class="chart-container">
        <!-- Pie chart for sales by payment method -->
        <canvas id="paymentMethodChart"></canvas>

        <!-- Line chart for revenue over time -->
        <canvas id="revenueChart"></canvas>
    </div>

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

        // Prepare the data for the line chart
        var revenueData = <?php echo json_encode($data['revenueData']); ?>;
        var labels2 = [];
        var data2 = [];

        revenueData.forEach(function(item) {
            labels2.push(item.date); // X-axis: Date
            data2.push(parseFloat(item.revenue)); // Y-axis: Revenue, convert to number
        });

        // Create the line chart
        var ctx2 = document.getElementById('revenueChart').getContext('2d');
        var revenueChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: labels2, // Dates on the X-axis
                datasets: [{
                    label: 'Total Revenue',
                    data: data2, // Revenue data (now as numbers)
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