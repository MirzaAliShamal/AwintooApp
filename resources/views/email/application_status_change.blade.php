<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Status has Changed</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #343a40;
        }
        .content {
            padding: 20px 0;
            line-height: 1.6;
        }
        .content p {
            margin: 0 0 10px;
            color: #495057;
        }
        .footer {
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            text-align: center;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Your Application Status has Changed</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ $client->full_name }}</strong>,</p>
            <p>Your visa application status has been updated to "<strong>{{ $client->status }}</strong>".</p>
            <p>Please log in to your client dashboard for further details. If you have any questions, please feel free to contact us.</p>
            <p>Sincerely,</p>
            <p>The Protech Training Center Team</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Protech Training Center. All rights reserved.</p>
        </div>
    </div>
</body>
</html>