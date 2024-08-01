<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Protech Training Center</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add your custom styles here */
        .email-body {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }
    </style>
</head>
<body>
    <div class="email-body">
        <h2>Welcome to Protech Training Center</h2>
        
        <p>Dear {{ $client->full_name }},</p>
        
        <p>Welcome to the Protech Training Center family! We're excited to have you join our upcoming training program.</p>
        
        <p>To help you stay informed and connected throughout the application process, we've created a personalized client portal just for you.</p>
        
        <h3>Your Client Portal Credentials:</h3>
        <ul>
            <li><strong>Username:</strong> {{ $client->email }}</li>
            <li><strong>Password:</strong> {{ $pass }}</li>
        </ul>
        
        <h3>What You'll Find in Your Client Portal:</h3>
        <ul>
            <li><strong>Application Status:</strong> Easily track the progress of your application.</li>
            <li><strong>Appointments:</strong> View and manage all your scheduled appointments (interviews, assessments, etc.).</li>
            <li><strong>Important Updates:</strong> Receive notifications about important program updates or changes.</li>
            <li><strong>Resources:</strong> Access helpful resources and information about your chosen program.</li>
        </ul>
        
        <h3>How to Get Started:</h3>
        <ol>
            <li><a href="{{ route('login') }}" class="btn btn-small btn-info">Visit our client portal</a></li>
            <li>Log in using your provided username and password.</li>
            <li>Explore the portal and familiarize yourself with its features.</li>
        </ol>
        
        <p>If you have any questions or need assistance, please don't hesitate to contact us at [Contact Email/Phone Number].</p>
        
        <p>We look forward to supporting you on your journey towards a successful career in {{ $client->job->job_name }}!</p>
        
        <p>Sincerely,<br>The Protech Training Center Team</p>
    </div>
</body>
</html>
