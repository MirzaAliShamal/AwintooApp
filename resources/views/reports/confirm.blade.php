<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 25px;
            max-width: 800px;
            margin: auto;
        }
        .header, .footer {
            width: 100%;
            text-align: left;
        }
        .header img {
            width: 150px;
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
        <div class="header">
            <table class="footer-table">
                <tr>
                    <td class="left">
                        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/images/logo/protech.png'))) }}" alt="Logo">
                    </td>
                    <td class="right">
                        @php
                            $isPdf = $isPdf ?? false;
                        @endphp
                        @if (!$isPdf)
                            <form action="{{ route('admin.report.confirm.print') }}" method="POST" style="display: none;" id="printForm">
                                @csrf
                                <input type="hidden" name="client_id" value="{{ $client->unique_id_number }}">
                            </form>
                            <a href="#" class="btn" onclick="document.getElementById('printForm').submit();">Print</a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="content">
            <p>
                <strong>Confirmation of Training Participation</strong><br><br>
                Date: <b>{{ \Carbon\Carbon::now()->format('d-M-y') }}</b>
            </p>
            <p>
                Dear {{ $client->full_name }},<br><br>
                This letter serves to confirm your enrollment in the <b>"Romania: A Gateway to Professional Development for Vietnamese People."</b> program scheduled for 6 months after your arrival at our training center in Piatra Neamt Romania.<br><br>
                We have received from you full payment for both training fees and accommodation fees.<br><br>
                We look forward to welcoming you to the program and providing you with a valuable learning experience.<br><br>
                If you have any questions regarding the program or your registration, please do not hesitate to contact us at school@awintoo.com or +40 750452735.<br><br>
                Sincerely,<br>
                Angheluta Stefan Octavian
            </p>
        </div>
        
        <hr class="black-line">
        
        <div class="content">
            <p>
                <strong>Confirmarea Participării la Programul de Training</strong>
            </p><br>
            <p>Stimate Domnule/Doamnă {{ $client->full_name }}</p>
            <p>
                Prin prezenta scrisoare confirmăm înscrierea dumneavoastră la programul de training <b>"Romania: A Gateway to Professional Development for Vietnamese People."</b> programat pentru o perioada de 6 luni de la data sosirii voastre la Centrul nostru de pregatire din Piatra Neamt, Romania.<br><br>
                Am primit plata integrală atât pentru taxele de training, cât și pentru serviciile de cazare.<br><br>
                Ne bucurăm să vă avem ca participant la program și să vă oferim o calificare profesionala valoroasă pentru viitorul vostru.<br><br>
                Dacă aveți întrebări cu privire la program sau la înscrierea dumneavoastră, nu ezitați să ne contactați la school@awintoo.com sau +40 750452735.<br><br>
                Cu stimă,<br>
                Angheluta Stefan Octavian
            </p>
        </div>
        <div class="footer">
          <table class="footer-table">
            <tr>
                <td class="left">
                    <p>
                        <b>PROTECH TRAINING CENTER S.R.L.</b><br>
                        STR. OBOR NR. 2B, ET. 2+3, COMPLEX<br>
                        OLIMP, PIATRA NEAMȚ, JUD. NEAMȚ ROMANIA<br>
                        Email: protech@awintoo.com
                    </p>
                </td>
                <td class="right">
                    <p>
                        CIF: 49125716<br>
                        EUID: ROONRC.J27/1134/2023<br>
                        Nr. înmatriculare: J27/1134/2023<br>
                        Tel: +40333228003
                    </p>
                </td>
            </tr>
        </table>
        </div>
        <hr style="border: none; height: 1px; background-color: orange;">
        <hr style="border: none; height: 3px; background-color: #254dba;">
    </div>
</body>
</html>
