<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application for Employment</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('/fonts/DejaVuSans.ttf') format('truetype');
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px; /* Smaller font size for a more compact PDF */
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }
        .container {
            padding: 15px; /* Reduced padding for a more compact layout */
            max-width: 700px; /* Adjusted max width for better fit */
            margin: auto;
            position: relative;
        }
        .header {
            margin-bottom: 20px;
            text-align: center;
        }
        .header h1 {
            font-size: 16px; /* Slightly smaller heading size */
            margin: 0;
        }
        .header p {
            font-size: 12px; /* Reduced font size */
            margin: 5px 0;
        }
        .confidential-container {
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
        }
        .confidential-box {
            border: 1px solid #000;
            width: 80px; /* Reduced width */
            height: 80px; /* Reduced height */
            display: inline-block;
        }
        .confidential-text {
            font-size: 10px; /* Reduced font size */
            font-weight: bold;
            color: #000;
            margin-bottom: 5px;
        }
        .form-row {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            flex-wrap: wrap; /* Allows fields to wrap if needed */
        }
        .form-row label {
            font-weight: bold;
        }
        .form-row input[type="text"] {
            flex: 1;
            padding: 3px; /* Reduced padding */
            border: none;
            border-bottom: 1px dotted #000; /* Adjusted border size */
            border-radius: 0;
            outline: none;
        }
        .form-row input[type="checkbox"] {
            margin-right: 5px;
        }
        .form-row span {
            display: block;
            margin-top: 5px;
            font-style: italic;
        }
        .fields {
            margin-top: 80px;
        }
        .personal-info {
            margin-top: 10px;
        }
        .personal-info h2 {
            margin-top: 20px;
        }
        .form-row.multi-field {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }
        .form-row.multi-field label {
            font-weight: bold;
        }
        .form-row.multi-field input {
            flex: 1;
            margin-right: 10px;
        }
        .form-row.multi-field .input-group {
            flex: 1;
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .form-row.multi-field .input-group input {
            margin-right: 10px;
        }
        .additional-info {
            margin-top: 20px;
        }
        .additional-info h2 {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>APPLICATION FOR EMPLOYMENT</h1>
            <p>(Please provide the required information below)</p>
        </div>
        
        <div class="confidential-container">
            <div class="confidential-text">CONFIDENTIAL</div>
            <div class="confidential-box"></div>
        </div>
        
        <div class="fields">
            <div class="form-row">
                <label for="applied-position">Applied Position:</label>
                <input type="text" id="applied-position" name="applied_position" />
                <label for="salary">Salary:</label>
                <input type="text" id="salary" name="salary" />
                <span>USD / Month</span>
            </div>
            <div class="form-row">
                <label for="country">What country would you like to work in:</label>
                <input type="text" id="country" name="country" />
            </div>
        </div>
        
        <div class="personal-info">
            <h2>Personal Information</h2>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first_name" />
                </div>
                <div class="input-group">
                    <label for="middle-name">Middle Name:</label>
                    <input type="text" id="middle-name" name="middle_name" />
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last_name" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="title">Title:</label>
                    <div class="checkbox-group">
                        <input type="checkbox" id="title-mr" name="title" value="mr" />
                        <label for="title-mr">Mr.</label>
                        <input type="checkbox" id="title-mrs" name="title" value="mrs" />
                        <label for="title-mrs">Mrs.</label>
                        <input type="checkbox" id="title-ms" name="title" value="ms" />
                        <label for="title-ms">Ms.</label>
                        <input type="checkbox" id="title-others" name="title" value="others" />
                        <label for="title-others">Others</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="additional-info">
            <h2>Additional Information</h2>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="nationality">Nationality:</label>
                    <input type="text" id="nationality" name="nationality" />
                </div>
                <div class="input-group">
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" id="citizenship" name="citizenship" />
                </div>
                <div class="input-group">
                    <label for="religion">Religion:</label>
                    <input type="text" id="religion" name="religion" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="dob">Date Of Birth:</label>
                    <input type="text" id="dob" name="dob" />
                </div>
                <div class="input-group">
                    <label for="birth-place">Birth Place:</label>
                    <input type="text" id="birth-place" name="birth_place" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="id-card">Identity Card Number (I.D. Card):</label>
                    <input type="text" id="id-card" name="id_card" />
                </div>
                <div class="input-group">
                    <label for="id-expiration">Expiration Date:</label>
                    <input type="text" id="id-expiration" name="id_expiration" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="passport-number">Passport Number:</label>
                    <input type="text" id="passport-number" name="passport_number" />
                </div>
                <div class="input-group">
                    <label for="issued-at">Issued at:</label>
                    <input type="text" id="issued-at" name="issued_at" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="date-of-issue">Date of Issue:</label>
                    <input type="text" id="date-of-issue" name="date_of_issue" />
                </div>
                <div class="input-group">
                    <label for="expiry-date">Expiry Date:</label>
                    <input type="text" id="expiry-date" name="expiry_date" />
                </div>
            </div>
            <div class="form-row">
                <label for="current-address">Current Present Address:</label>
                <input type="text" id="current-address" name="current_address" />
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="mobile">Mobile:</label>
                    <input type="text" id="mobile" name="mobile" />
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="facebook">Social Media: Facebook:</label>
                    <input type="text" id="facebook" name="facebook" />
                </div>
                <div class="input-group">
                    <label for="instagram">Instagram:</label>
                    <input type="text" id="instagram" name="instagram" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="height">Height:</label>
                    <input type="text" id="height" name="height" />
                </div>
                <div class="input-group">
                    <label for="weight">Weight:</label>
                    <input type="text" id="weight" name="weight" />
                </div>
                <div class="input-group">
                    <label for="hair-color">Hair Color:</label>
                    <input type="text" id="hair-color" name="hair_color" />
                </div>
            </div>
            <div class="form-row multi-field">
                <div class="input-group">
                    <label for="body-marks">Body Marks:</label>
                    <input type="text" id="body-marks" name="body_marks" />
                </div>
                <div class="input-group">
                    <label for="tattoos">Tattoos:</label>
                    <input type="text" id="tattoos" name="tattoos" />
                </div>
            </div>
        </div>
        
        <!-- Additional form content will go here -->
    </div>
</body>
</html>
