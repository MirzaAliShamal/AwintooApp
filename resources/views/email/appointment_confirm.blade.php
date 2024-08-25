<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointment Confirmation</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
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
            margin: 0 0 10px;
            padding-left: 20px;
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
            <h1>Your Appointment Confirmation</h1>
        </div>
        <div class="content">
            <p>Dear <strong>{{ $appointment->full_name }}</strong>,</p>
            <p>You have received the following appointment, and we look forward to assisting you!</p>
            <p><strong>Appointment Details:</strong></p>
            <ul>
                <li><b>Date:</b> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}</li>
                <li><b>Time:</b> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</li>
                <li><b>Purpose:</b> {{ $appointment->type_of_appointment }}</li>
                <li><b>Location:</b> {{ $appointment->location }}</li>
            </ul>
            @if($appointment->type_of_appointment == 'Others')
                <p><strong>Additional Information:</strong></p>
                <p>{{ $appointment->other_details }}</p><br>
            @endif
            <p>If you need to reschedule or cancel, please let us know as soon as possible.</p>
            <p>We're excited to meet you!</p>
            <p>Best regards,</p>
            <p>The Protech Training Center Team</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Protech Training Center. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
