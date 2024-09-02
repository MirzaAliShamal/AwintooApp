<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Update Notification</title>
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
     <h1>Monthly Time Sheet for Selected Students</h1>

    <ul>
        @foreach ($students as $student)
            <li>
                <strong>{{ $student->full_name }}</strong> (ID: {{ $student->std_unique_id }})<br>
                Arrival Date RO: {{ \Carbon\Carbon::parse($student->arrival_date_ro)->format('d-m-Y') }}<br>
                Employer: {{ $student->employer }}<br>
                Working Place RO: {{ $student->working_place_ro }}<br>
                <!-- Add more details as needed -->
            </li>
            <br>
        @endforeach
    </ul>
</body>
</html>
