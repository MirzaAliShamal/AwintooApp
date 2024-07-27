<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application for Employment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        label {
            font-weight: 500;
        }
        .confidential {
            position: absolute;
            top: 20px;
            right: 20px;
            text-align: center;
        }
        .confidential p {
            font-size: 18px;
            color: red;
            font-weight: bold;
        }
        .confidential .box {
            border: 1px solid black;
            height: 100px;
            width: 100px;
            margin-top: 10px;
        }
        .form-section {
            margin-top: 30px;
        }
        .form-section h6 {
            font-weight: bold;
            font-size: 17px;
        }
        .form-section p {
            margin-bottom: 0;
        }
        .dotted-input {
            border: none;
            border-bottom: 1px dotted #000;
            width: calc(100% - 20px);
            outline: none;
        }
        .dotted-input.short {
            width: 150px;
        }
        .dotted-input.medium {
            width: 260px;
        }
        .dotted-input.long {
            width: 600px;
        }

        .dotted-input {
        border: none;
        border-bottom: 1px dotted black;
        width: 100%;
        display: inline-block;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-section {
        margin-bottom: 2rem;
    }
    .table-bordered td,
    .table-bordered th {
        border: 1px solid black;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="confidential">
            <p>CONFIDENTIAL</p>
            <div class="box"></div>
        </div>
        <div class="text-center mt-5">
            <h5>APPLICATION FOR EMPLOYMENT</h5>
            <p style="color: red;">(Please provide the required information below)</p>
        </div>
        <div class="mt-5 pt-5">
        <div class="form-section">
            <div class="row">
                <div class="col-md-6">
                    <label for="position"><b>Applied Position</b></label>
                    <input type="text" id="position" class="dotted-input medium">
                </div>
                <div class="col-md-5">
                    <label for="salary"><b>Salary</b></label>
                    <input type="text" id="salary" class="dotted-input medium">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="country"><b>What country would you like to work:</b></label>
                    <input type="text" id="country" class="dotted-input long">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h6>Personal Information</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="mr" value="Mr.">
                <label class="form-check-label" for="mr">Mr.</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="mrs" value="Mrs.">
                <label class="form-check-label" for="mrs">Mrs.</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="ms" value="Ms.">
                <label class="form-check-label" for="ms">Ms.</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="others" value="Others">
                <label class="form-check-label" for="others">Others</label>
            </div>

            <div class="form-group row">
                <div class="col-md-4">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" class="dotted-input medium">
                </div>
                <div class="col-md-4">
                    <label for="middle_name">Middle Name:</label>
                    <input type="text" id="middle_name" class="dotted-input short">
                </div>
                <div class="col-md-4">
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" class="dotted-input medium">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4">
                    <label for="nationality">Nationality:</label>
                    <input type="text" id="nationality" class="dotted-input medium">
                </div>
                <div class="col-md-4">
                    <label for="citizenship">Citizenship:</label>
                    <input type="text" id="citizenship" class="dotted-input medium">
                </div>
                <div class="col-md-4">
                    <label for="religion">Religion:</label>
                    <input type="text" id="religion" class="dotted-input medium">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6">
                    <label for="date_of_birth">Date Of Birth:</label>
                    <input type="text" id="date_of_birth" class="dotted-input medium">
                </div>
                <div class="col-md-6">
                    <label for="birth_place">Birth Place:</label>
                    <input type="text" id="birth_place" class="dotted-input medium">
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="id_card">Identity Card Number (I.D. Card):</label>
                    <input type="text" id="id_card" class="dotted-input medium">
                </div>
                <div class="col-md-6">
                    <label for="exp_date">Expiration Date:</label>
                    <input type="text" id="exp_date" class="dotted-input short">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="passport_number">Passport Number:</label>
                    <input type="text" id="passport_number" class="dotted-input medium">
                </div>
                <div class="col-md-6">
                    <label for="issued_at">Issued at:</label>
                    <input type="text" id="issued_at" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="date_of_issue">Date of Issue:</label>
                    <input type="text" id="date_of_issue" class="dotted-input medium">
                </div>
                <div class="col-md-6">
                    <label for="expiry_date">Expiry Date:</label>
                    <input type="text" id="expiry_date" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group">
                <label for="address">Current Present Address:</label>
                <input type="text" id="address" class="dotted-input long">
                <input type="text" id="address2" class="dotted-input">
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="mobile">Mobile:</label>
                    <input type="text" id="mobile" class="dotted-input medium">
                </div>
                <div class="col-md-6">
                    <label for="email">E-mail:</label>
                    <input type="text" id="email" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="facebook">Social Media: Facebook</label>
                    <input type="text" id="facebook" class="dotted-input medium">
                </div>
                <div class="col-md-4">
                    <label for="instagram">Instagram:</label>
                    <input type="text" id="instagram" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label for="height">Height:</label>
                    <input type="text" id="height" class="dotted-input short">
                </div>
                <div class="col-md-4">
                    <label for="weight">Weight:</label>
                    <input type="text" id="weight" class="dotted-input short">
                </div>
                <div class="col-md-4">
                    <label for="hair_color">Hair Color:</label>
                    <input type="text" id="hair_color" class="dotted-input short">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for="body_marks">Body Marks:</label>
                    <input type="text" id="body_marks" class="dotted-input medium">
                </div>
                <div class="col-md-6">
                    <label for="tattoo">Tattoo:</label>
                    <input type="text" id="tattoo" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group">
                <label>Marital Status:</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="single" value="Single">
                    <label class="form-check-label" for="single">Single</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="married" value="Married">
                    <label class="form-check-label" for="married">Married</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="widowed" value="Widowed">
                    <label class="form-check-label" for="widowed">Widowed</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="separated" value="Separated">
                    <label class="form-check-label" for="separated">Separated</label>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h6>Family Information</h6>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="father_name">Father's Name:</label>
                    <input type="text" id="father_name" class="dotted-input medium">
                </div>
                <div class="col-md-3">
                    <label for="father_age">Age:</label>
                    <input type="text" id="father_age" class="dotted-input short">
                </div>
                <div class="col-md-4">
                    <label for="father_occupation">Occupation:</label>
                    <input type="text" id="father_occupation" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group">
                <label for="father_contact">Contact Number:</label>
                <input type="text" id="father_contact" class="dotted-input long">
            </div>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="mother_name">Mother's Name:</label>
                    <input type="text" id="mother_name" class="dotted-input medium">
                </div>
                <div class="col-md-3">
                    <label for="mother_age">Age:</label>
                    <input type="text" id="mother_age" class="dotted-input short">
                </div>
                <div class="col-md-4">
                    <label for="mother_occupation">Occupation:</label>
                    <input type="text" id="mother_occupation" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group">
                <label for="mother_contact">Contact Number:</label>
                <input type="text" id="mother_contact" class="dotted-input long">
            </div>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="spouse_name">Name of Wife/Husband:</label>
                    <input type="text" id="spouse_name" class="dotted-input medium">
                </div>
                <div class="col-md-3">
                    <label for="spouse_age">Age:</label>
                    <input type="text" id="spouse_age" class="dotted-input short">
                </div>
                <div class="col-md-4">
                    <label for="spouse_occupation">Occupation:</label>
                    <input type="text" id="spouse_occupation" class="dotted-input medium">
                </div>
            </div>
            <div class="form-group">
                <label for="spouse_contact">Contact Number:</label>
                <input type="text" id="spouse_contact" class="dotted-input long">
            </div>
        </div>
        <div class="form-section">
    <div class="form-group row">
        <div class="col-md-5">
            <h6>Person to be notified in case of emergency:</h6>
        </div>
        <div class="col-md-6">
            <label for="emergency_name">Name-Surname:</label>
            <input type="text" id="emergency_name" class="dotted-input medium">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-md-6">
            <label for="emergency_relation">Related to the applicant as:</label>
            <input type="text" id="emergency_relation" class="dotted-input medium">
        </div>
        <div class="col-md-6">
            <label for="emergency_mobile">Mobile:</label>
            <input type="text" id="emergency_mobile" class="dotted-input medium">
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <label for="emergency_email">Email:</label>
            <input type="text" id="emergency_email" class="dotted-input medium">
        </div>
    </div>
    <div class="form-group">
        <label for="emergency_address">Address:</label>
        <input type="text" id="emergency_address" class="dotted-input long">
    </div>
</div>



<div class="form-section">
    <h6>Education</h6>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Educational Level</th>
                <th>Name of Institution</th>
                <th>Major</th>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>High School</td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <td>Vocational</td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <td>Diploma</td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <td>Bachelor Degree</td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <td>Other</td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
        </tbody>
    </table>
</div>
<div class="form-section">
    <h4>Working Experience</h4>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>Company</th>
                <th colspan="2">Time</th>
                <th>Position</th>
                <th>Job Description</th>
                <th>Salary</th>
                <th>Reason of resignation</th>
            </tr>
            <tr>
                <th></th>
                <th>From</th>
                <th>To</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
                <td><input type="text" class="dotted-input"></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="form-section row">
    <h5>Language Ability</h5>
    <div class="form-group">
        <input type="text" id="language_ability" class="dotted-input long">
    </div>
</div>

<div class="form-section">
    <h4>Special Ability</h4>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Computer</th>
                <td><input type="checkbox"> No <input type="checkbox"> Yes</td>
            </tr>
            <tr>
                <th>Driving</th>
                <td><input type="checkbox"> No <input type="checkbox"> Yes</td>
            </tr>
            <tr>
                <th>Driving Licence No :</th>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <th>Machine</th>
                <td><input type="checkbox"> No <input type="checkbox"> Yes</td>
            </tr>
            <tr>
                <th>Type of Machine :</th>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <th>Job Description :</th>
                <td><input type="text" class="dotted-input"></td>
            </tr>
            <tr>
                <th>Special knowledge Please Mention</th>
                <td><input type="text" class="dotted-input" style="width: 100%;"></td>
            </tr>
            <tr>
                <th>Others Please Mention</th>
                <td><input type="text" class="dotted-input" style="width: 100%;"></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="form-section">
    <p>I certify all statements given in this application form are true. If any information is found to be untrue after engagement, the Company has the right to terminate my employment without any compensation or severance pay whatsoever.</p>
    <div style="text-align: center; margin-top: 50px;">
        <p>.............................................</p>
        <p><b>( Application Signature )</b></p>
    </div>
</div>


         </div>
    </div>
</body>
</html>
