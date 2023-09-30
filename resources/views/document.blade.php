<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .receipt-container {
            margin: 20px auto;
            max-width: 500px;
            border: 2px solid #333;
            padding: 20px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .store-info {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .receipt-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .receipt-details {
            margin-top: 10px;
        }

        .receipt-details p {
            margin: 5px 0;
        }

        .receipt-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .receipt-table th,
        .receipt-table td {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
        }

        .receipt-table th {
            background-color: #333;
            color: #fff;
        }

        .receipt-total {
            margin-top: 20px;
            text-align: right;
        }

        .receipt-total p {
            margin: 5px 0;
            font-weight: bold;
        }
        .store-info p{
            margin: 1px;
        }
    </style>
</head>

<body>
    <!-- Receipt Content -->
    <div class="receipt-container">
        <div class="receipt-header">
            <div class="store-info">
                <p>Castillet Dental Clinic</p>
                <p > Victoria, Oriental Mindoro</p>
            </div>
            <h1 class="receipt-title">Receipt</h1>
        </div>

        <!-- Receipt Details -->
        <div class="receipt-details">
            <!-- Replace these placeholders with actual receipt data -->
            <p><strong>Date:</strong> {{$payment['receipt_date'] }}</p>
            <p><strong>Receipt Number:</strong> {{$payment['receipt_number']}}</p>
            <!-- Add more receipt details as needed -->
        </div>

        <!-- Receipt Table -->
        <table class="receipt-table">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Payment Method</th>
                    <th>Service</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$payment['amount'] }}</td>
                    <td>{{$payment['payment_method'] }}</td>
                    <td>{{$payment['service_name'] }}</td>
                    <td>{{$payment['payment_status'] }}</td>
                </tr>
                <!-- Add more rows for additional items -->
            </tbody>
        </table>

        <!-- Receipt Total -->
        <div class="receipt-total">
            <p><strong>Total Amount:</strong> {{$payment['amount'] }}</p>
        </div>
    </div>
    <!-- End of Receipt Content -->

</body>

</html>
