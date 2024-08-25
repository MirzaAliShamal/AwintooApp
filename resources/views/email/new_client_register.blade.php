<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client Registration</title>
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
        .content ul {
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            margin: 0 0 5px;
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
            <h1>New Client Registered</h1>
        </div>
        <div class="content">
            <p>Dear Admin,</p>
            <p>A new client has been registered in the system. Please find the details below:</p>
            <ul>
                <li><strong>Client ID:</strong> {{ $client->unique_id_number }}</li>
                <li><strong>Name:</strong> {{ $client->full_name }}</li>
                <li><strong>Registration Date/Time:</strong> {{ \Carbon\Carbon::parse($client->created_at)->format('F j, Y, g:i a') }}</li>
            </ul>
            <p>Please review the client's profile and initiate the onboarding process.</p>
            <p>Sincerely,</p>
            <p>The Protech Training Center System</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Protech Training Center. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
