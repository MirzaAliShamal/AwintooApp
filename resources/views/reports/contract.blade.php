<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contract Report</title>
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

        .contract-section ul {
            list-style-type: none;
            padding: 0;
        }
        .contract-section ul li {
            margin-bottom: 10px;
        }
        hr.black-line {
            height: 1px;
            background-color: #000;
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
                            <form action="{{ route('admin.report.contract.print') }}" method="POST" style="display: none;" id="printForm">
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
            <p style="text-align: center;">
                <strong>CONTRACT de formare profesională</strong>
            </p>
            <p> Nr. M {{ $client->unique_id_number }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Date: <b>{{ \Carbon\Carbon::now()->format('d-M-y') }}</b>
            </p>
            <div class="contract-section" style="margin-top: 40px;">
                <h4>1. Părțile contractante:</h4>
                <ul>
                    <li>
                        <b>A. PROTECH TRAINING CENTER S.R.L.</b>, în calitate de furnizor de formare profesională,
                        denumit în continuare furnizor, reprezentată prin Stefan Octavian Angheluta, având
                        funcția de administrator, CUI 49125716, JUD. NEAMŢ, MUN. PIATRA NEAMŢ, STR. OBOR,
                        NR.2B, INCINTA COMPLEXULUI OLIMP, ET.2+3, posesor al autorizației de furnizor de formare profesională pentru ocupația <b>Limba română MECANIC AUTO,</b> înmatriculat
                        în Registrul național al furnizorilor de formare profesională a adulților cu nr. 778
                        /12.02.2024
                    </li>
                    <li>
                        <b>B. Mr/Mrs {{ $client->full_name }}</b>, în calitate de beneficiar de formare profesională, denumit în
                        continuare beneficiar, cu domiciliul temporar ales în JUD. NEAMŢ, MUN. PIATRA NEAMŢ,
                        STR. OBOR, NR.2B, INCINTA COMPLEXULUI OLIMP, Et:2 Cetățean Vietnamez cu domiciliul în
                    </li>
                </ul>
            </div>

            <div class="contract-section">
                <h4>2. Obiectul contractului:</h4>
                <p>
                    Obiectul contractului îl constituie prestarea de către furnizor a <b>Limba română – MECANIC AUTO.</b>
                </p>
            </div>

            <div class="contract-section">
                <h4>3. Durata contractului:</h4>
                <p>
                    Durata contractului este de 6 luni, reprezentând 240 ore de pregătire teoretică și 480 ore
                    de pregătire practică; derularea contractului începe la data de obținere a permisului de
                    ședere în România.
                </p>
            </div>

            <div class="contract-section">
                <h4>4. Valoarea contractului:</h4>
                <p>
                    Valoarea totală a contractului este de 5500 lei. Beneficiarul va achita această sumă
                    reprezentând contravaloarea serviciilor prestate de către furnizor în contul firmei în avans
                    și se va emite factura. Valoarea contractului, precum și modalitățile de plată pot fi
                    modificate ulterior, cu acordul părților, prin acte adiționale la prezentul contract.
                </p>
                <p>
                    Nu sunt incluse cheltuielile de transport, viză, cazare și masă, acestea fiind suportate de
                    Awintoo Vietnam. De asemenea, nu sunt incluse cheltuielile de legalizare, traducere și
                    certificare documente.
                </p>
            </div>

            <div class="contract-section">
                <h4>5. Obligațiile părților:</h4>
                <ul>
                    <li>
                        <b>A. Furnizorul se obligă:</b>
                        <ul>
                            <li>a) să presteze serviciile de formare profesională, cu respectarea normelor legale și a metodologiilor în materie, punând accent pe calitatea formării profesionale;</li>
                            <li>b) să asigure resursele umane, materiale, tehnice sau altele asemenea, necesare desfășurării activității de formare profesională;</li>
                            <li>c) să asigure finalizarea procesului de formare profesională și susținerea examenelor de absolvire la terminarea stagiilor de pregătire teoretică și practică;</li>
                            <li>d) să asigure instructajul privind protecția muncii;</li>
                            <li>e) să nu impună beneficiarului să participe la alte activități decât cele prevăzute în programul de formare profesională.</li>
                        </ul>
                    </li>
                    <li>
                        <b>B. Beneficiarul se obligă:</b>
                        <ul>
                            <li>a) să frecventeze programul de formare profesională pe întreaga perioadă. Înregistrarea a mai mult de 10% absențe nemotivate sau 25% absențe motivate din durata totală a programului conduce la pierderea dreptului beneficiarului de a susține examenul de absolvire;</li>
                            <li>b) să utilizeze resursele materiale, tehnice și altele asemenea potrivit scopului și destinației acestora și numai în cadrul procesului de formare profesională, evitând degradarea, deteriorarea sau distrugerea acestora;</li>
                            <li>c) să păstreze ordinea, curățenia și disciplina pe parcursul frecventării cursurilor de formare profesională;</li>
                            <li>d) să respecte normele privind protecția muncii;</li>
                            <li>e) să furnizeze toate documentele solicitate și mandatorii înscrierii la curs până la 5 zile.</li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="contract-section">
                <h4>6. Răspunderea contractuală:</h4>
                <p>
                    În cazul în care beneficiarul nu poate începe cursul din motive de forță majoră, acesta nu
                    va suporta cheltuielile efectuate de furnizor în executarea contractului.
                </p>
                <p>
                    În cazul în care beneficiarul nu poate continua sau finaliza cursul din motive de forță
                    majoră, acesta va suporta doar cheltuielile efectuate de furnizor în executarea
                    contractului, dar nu mai puțin de 10%.
                </p>
                <p>
                    În cazul în care beneficiarul urmează un program de formare profesională organizat de
                    agenția pentru ocuparea forței de muncă sau de un angajator, responsabilitatea
                    financiară pentru programul de formare profesională îi revine organizatorului.
                </p>
            </div>

            <div class="contract-section">
                <h4>7. Forța majoră:</h4>
                <p>
                    Partea care, din cauză de forță majoră, nu își poate respecta obligațiile contractuale va
                    înștiința în scris cealaltă parte contractantă, în termen de cel mult 5 zile de la data
                    încetării.
                </p>
            </div>

            <div class="contract-section">
                <h4>8. Soluționarea litigiilor:</h4>
                <p>
                    Părțile contractante vor depune toate diligențele pentru rezolvarea pe cale amiabilă a
                    neînțelegerilor ce se pot ivi între ele cu ocazia executării contractului.
                </p>
                <p>
                    Dacă rezolvarea pe cale amiabilă nu este posibilă, părțile se pot adresa instanței de
                    judecată competente, potrivit legii.
                </p>
            </div>

            <div class="contract-section">
                <h4>9. Modificarea, suspendarea și încetarea contractului:</h4>
                <p>
                    Contractul poate fi modificat numai prin acordul de voință al părților, exprimat prin act
                    adițional la prezentul contract.
                </p>
                <p>
                    Părțile pot stabili de comun acord suspendarea pe o durată limitată a contractului.
                </p>
                <p>
                    Prezentul contract poate înceta în următoarele condiții:
                </p>
                <ul>
                    <li>a) prin expirarea termenului și realizarea obiectului contractului;</li>
                    <li>b) prin acordul de voință al părților;</li>
                    <li>c) prin reziliere.</li>
                </ul>
                <p>
                    În cazul în care una dintre părți nu își respectă obligațiile asumate prin contract, partea
                    lezată poate cere rezilierea contractului.
                </p>
            </div>

            <div class="contract-section">
                <h4>10. Clauze speciale:</h4>
                <p>
                    ProTech Training Center este împuternicit să semneze subcontracte cu furnizori terți de
                    servicii de formare în numele clientului și pentru folosul acestuia. ProTech Training
                    Center va acționa în calitate de reprezentant al clientului în ceea ce privește negocierea
                    și semnarea subcontractelor, în conformitate cu termenii și condițiile stabilite în contract.
                </p>
            </div>

            <div class="contract-section">
                <h4>11. Dispoziții finale:</h4>
                <p>
                    Prezentul contract reprezintă acordul de voință al părților și a fost încheiat astăzi,
                    12.05.2024, în 3(trei) exemplare, din care unul pentru furnizor și unul pentru beneficiar.
                </p>
            </div>

            <div class="contract-section">
             <table class="footer-table">
                <tr>
                    <td class="left">
                        <p>Furnizor, </p>
                        <p>ANGHELUTA STEFAN OCTAVIAN </p>
                    </td>
                    <td class="right">
                        <p>Beneficiar, </p>
                        <p>{{ $client->full_name }}</p>
                    </td>
                </tr>
            </table>
        </div>
        
        <hr class="black-line">
        
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

<script src="{{ asset('assets/global/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/action.js') }}"></script>
</body>
</html>
