<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
            border: 0px solid #ddd;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 40px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .client-info {
            margin-top: 20px;
        }
        .client-info, .invoice-info, .total-info {
            margin-bottom: 20px;
        }
        .client-info table, .invoice-info table, .total-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .client-info table td, .invoice-info table td, .total-info table td {
            border: 0px solid #ddd;
            padding: 8px;
        }
        .client-info table td label, .invoice-info table td label {
            font-weight: bold;
        }
        .total {
            text-align: right;
            font-size: 18px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 18px;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/images/logo/awinto.png'))) }}" height="130" width="150">
        </div>
        
        <div class="client-info">
            <table>
                <tr>
                    <td><label>Issue To:</label> {{ $payment->client_name }}</td>
                </tr>
                <tr>
                    <td><label>Client ID:</label> {{ $payment->id }}</td>
                    <td align="right">
                       <small> <b>{{ \Carbon\Carbon::now()->format('l, d F Y') }}<br>
                        {{ \Carbon\Carbon::now()->format('h:i:s A') }}</b></small>
                    </td>
                </tr>
            </table>
        </div>
        <hr color='black'>

        <div class="invoice-info">
            <table>
                <tr>
                    <td><label>Job:</label> {{ $payment->job->job_name }}</td>
                    <td><label>Price:</label> ${{ $payment->price }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td><label>Received Payment:</label> ${{ $payment->payment }}</td>
                </tr>
            </table>
        </div>
        <hr color='black'>

        <div class="invoice-info">
            <table>
                <tr>
                    <td></td>
                    <td align="right"><strong><span style="color: red;">Current dept After Deduction:</span> ${{ $payment->after_deduction }}</strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <h2>Thank you</h2>
        </div>
    </div>
</body>
</html>
