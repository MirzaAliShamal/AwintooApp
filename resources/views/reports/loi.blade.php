<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOI Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 25px;
            max-width: 800px;
            margin: auto;
        }
        .footer {
            width: 100%;
            text-align: left;
        }
        .content {
            margin-top: 30px;
            text-align: justify;
        }
        .content p {
            margin: 10px 0;
        }
        .footer {
            display: flex;
            justify-content: space-between;
        }
        .footer p {
            color: #254dba;
        }

         .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-table td {
            vertical-align: top;
            padding: 5px;
        }
        .footer-table .left {
            width: 50%;
        }
        .footer-table .right {
            width: 50%;
            text-align: right;
        }
        hr.black-line {
            height: 1px;
            background-color: black;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-table td {
            vertical-align: top;
            padding: 5px;
        }
        .footer-table .left {
            width: 50%;
        }
        .footer-table .right {
            width: 50%;
            text-align: right;
        }
        .btn {
            background: royalblue;
            color: #fff;
            padding: 10px;
            width: 30px;
            height: 20px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="footer-table">
                <tr>
                    <td class="left"></td>
                    <td class="right">
                        @php
                            $isPdf = $isPdf ?? false;
                        @endphp
                        @if (!$isPdf)
                            <form action="{{ route('admin.report.loi.print') }}" method="POST" style="display: none;" id="printForm">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                            </form>
                            <a href="#" class="btn" onclick="document.getElementById('printForm').submit();">Print</a>
                        @endif
                    </td>
                </tr>
            </table>
        <div class="content">
            <p>
                <strong>To: Romanian Embassy iVietnam,</strong><br><br>
                <strong>Consular Section HANOI,</strong><br><br>
            </p>
            <p>
                I am writing to express my intent to apply for a visa to Romania for following training program:
                <b>“Romania: A Gateway to Professional Development for Vietnamese</b> provided by <b>PROTECHTRAINING CENTER S.R.L.</b> I have been working in this field for more years and have a strong trackrecord of success. I am confident that I have the skills and knowledge necessary to complete the training
                program successfully.<br><br>
                
                The training program in Romania is a unique opportunity for me to learn from some of the leading
                experts in the field. It will also give me the chance to network with other professionals from around the
                Europe. I am confident that this training program will help me to advance my career and contribute to
                the development of my skills and in future to get a better job.<br><br>

                I am applying for a visa for a period of at least 6 months for the whole length of the course. I will be
                staying in Romania during the duration of the training program. I have already booked my
                accommodation and have made arrangements for my travel with the training center. <br><br>

                I am a law-abiding citizen and have no criminal record. I am also financially stable and have enough
                funds to support myself during my stay in Romania. I also paid for the qualification course in full and
                attached to my application the proof issued by the qualification center.<br><br>

                I would be grateful for the opportunity to study in Romania. I believe that this training program will be
                a valuable asset to my career and to my country.
            </p><br><br>
            <p>Thank you for your time and consideration.</p><br>
            <p>Sincerely, {{ $client->full_name }}</p><br>
            <p><b>Date</b> {{ \Carbon\Carbon::now()->format('d-M-y') }}</p>
        </div>
    </div>
</body>
</html>
