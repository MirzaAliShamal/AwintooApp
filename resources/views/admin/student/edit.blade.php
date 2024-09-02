@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.student.index') }}" class="btn btn-outline-dark">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm studentForm" data-storeURL="{{ route('admin.student.update', $student->id) }}">
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                           <!-- client ID -->
                           <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Select ID</h4>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="client_id">Select Student ID</label>
                                    <select class="form-control" name="client_id" id="client_id">
                                            <option value="">Select Student</option>
                                            @forelse($clients as $client)
                                            <option value="{{ $client->id }}" {{ ($student->client_id == $client->id) ? 'selected' : '' }}>{{ $client->unique_id_number }} - {{ $client->full_name }}</option>
                                            @empty
                                            <option>No Record Found</option>
                                            @endforelse
                                        </select>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                        <!-- Personal Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Personal Information</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="full_name">Full Name</label>
                                    <input value="{{ $student->full_name }}" type="text" name="full_name" id="full_name" readonly class="form-control" placeholder="Full Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="sure_name">Sure Name</label>
                                    <input value="{{ $student->sure_name }}" type="text" name="sure_name" id="sure_name" class="form-control" placeholder="Sure Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="given_name">Given Name</label>
                                    <input value="{{ $student->given_name }}" type="text" name="given_name" id="given_name" class="form-control" placeholder="Given Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="dob">Date of Birth</label>
                                    <input value="{{ $student->dob }}" type="date" name="dob" id="dob" readonly class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="age">Age</label>
                                    <input value="{{ $student->age }}" type="number" name="age" id="age" readonly class="form-control" placeholder="Age">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="place_of_birth">Place of Birth</label>
                                    <input value="{{ $student->place_of_birth }}" type="text" name="place_of_birth" id="place_of_birth" readonly class="form-control" placeholder="Place of Birth">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Parent Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Parent Information</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="father_name">Father's Name</label>
                                    <input value="{{ $student->father_name }}" type="text" name="father_name" id="father_name" readonly class="form-control" placeholder="Father's Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="mother_name">Mother's Name</label>
                                    <input value="{{ $student->mother_name }}" type="text" name="mother_name" id="mother_name" readonly class="form-control" placeholder="Mother's Name">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Visa Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Visa Information</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="visa_number">Visa Number</label>
                                    <input value="{{ $student->visa_number }}" type="text" name="visa_number" id="visa_number" readonly class="form-control" placeholder="Visa Number">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="visa_issue_date">Visa Issue Date</label>
                                    <input value="{{ $student->visa_issue_date }}" type="date" name="visa_issue_date" id="visa_issue_date" readonly class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="visa_expiry_date">Visa Expiry Date</label>
                                    <input value="{{ $student->visa_expiry_date }}" type="date" name="visa_expiry_date" id="visa_expiry_date" readonly class="form-control">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Agency Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Agency Information</h4>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="agency_name">Agency Name</label>
                                    <input value="{{ $student->agency_name }}" type="text" name="agency_name" id="agency_name" readonly class="form-control" placeholder="Agency Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="agent_name">Agent Name</label>
                                    <input value="{{ $student->agent_name }}" type="text" name="agent_name" id="agent_name" readonly class="form-control" placeholder="Agent Name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="country_code">Country Code</label>
                                    <input value="{{ $student->country_code }}" type="text" name="country_code" id="country_code" class="form-control" placeholder="Country Code">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Training Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Training Information</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="training_program">Training Program</label>
                                    <input value="{{ $student->training_program }}" type="text" name="training_program" id="training_program" readonly class="form-control" placeholder="Training Program">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="class_hours">Class Hours</label>
                                    <input value="{{ $student->class_hours }}" type="number" name="class_hours" id="class_hours" class="form-control" placeholder="Class Hours">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="practice_hours">Practice Hours</label>
                                    <input value="{{ $student->practice_hours }}" type="number" name="practice_hours" id="practice_hours" class="form-control" placeholder="Practice Hours">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information (RO) -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Address Information (RO)</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="address_in_ro">Address in RO</label>
                                    <input value="{{ $student->address_in_ro }}" type="text" name="address_in_ro" id="address_in_ro" class="form-control" placeholder="Address in RO">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="working_place_ro">Working Place in RO</label>
                                    <input value="{{ $student->working_place_ro }}" type="text" name="working_place_ro" id="working_place_ro" class="form-control" placeholder="Working Place in RO">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="training_place_ro">Training Place in RO</label>
                                    <input value="{{ $student->training_place_ro }}" type="text" name="training_place_ro" id="training_place_ro" class="form-control" placeholder="Training Place in RO">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone_number_ro">Phone Number in RO</label>
                                    <input value="{{ $student->phone_number_ro }}" type="text" name="phone_number_ro" id="phone_number_ro" class="form-control" placeholder="Phone Number in RO">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="bank_account_ro">Bank Account in RO</label>
                                    <input value="{{ $student->bank_account_ro }}" type="text" name="bank_account_ro" id="bank_account_ro" class="form-control" placeholder="Bank Account in RO">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="arrival_date_ro">Arrival Date in RO</label>
                                    <input value="{{ $student->arrival_date_ro }}" type="date" name="arrival_date_ro" id="arrival_date_ro" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Address Information (Abroad) -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Address Information (Abroad)</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="address_abroad">Address Abroad</label>
                                    <input value="{{ $student->address_abroad }}" type="text" name="address_abroad" id="address_abroad" readonly class="form-control" placeholder="Address Abroad">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="working_place_abroad">Working Place Abroad</label>
                                    <input value="{{ $student->working_place_abroad }}" type="text" name="working_place_abroad" id="working_place_abroad" readonly class="form-control" placeholder="Working Place Abroad">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="training_place_abroad">Training Place Abroad</label>
                                    <input value="{{ $student->training_place_abroad }}" type="text" name="training_place_abroad" id="training_place_abroad" class="form-control" placeholder="Training Place Abroad">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="phone_abroad">Phone Abroad</label>
                                    <input value="{{ $student->phone_abroad }}" type="text" name="phone_abroad" id="phone_abroad" class="form-control" readonly placeholder="Phone Abroad">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Residence Permit Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Residence Permit Information</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="residence_permit_number">Residence Permit Number</label>
                                    <input value="{{ $student->residence_permit_number }}" type="text" name="residence_permit_number" readonly id="residence_permit_number" class="form-control" placeholder="Residence Permit Number">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="residence_permit_issue_date">Residence Permit Issue Date</label>
                                    <input value="{{ $student->residence_permit_issue_date }}" type="date" name="residence_permit_issue_date" readonly id="residence_permit_issue_date" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="residence_permit_expiry_date">Residence Permit Expiry Date</label>
                                    <input value="{{ $student->residence_permit_expiry_date }}" type="date" name="residence_permit_expiry_date" readonly id="residence_permit_expiry_date" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Work and Training Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Work and Training Information</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="training_start_date">Training Start Date</label>
                                    <input value="{{ $student->training_start_date }}" type="date" name="training_start_date" id="training_start_date" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="remain_hours_training_class">Remaining Class Hours</label>
                                    <input value="{{ $student->remain_hours_training_class }}" type="number" name="remain_hours_training_class" id="remain_hours_training_class" class="form-control" placeholder="Remaining Class Hours">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="remain_hours_practice">Remaining Practice Hours</label>
                                    <input value="{{ $student->remain_hours_practice }}" type="number" name="remain_hours_practice" id="remain_hours_practice" class="form-control" placeholder="Remaining Practice Hours">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="work_start_date">Work Start Date</label>
                                    <input value="{{ $student->work_start_date }}" type="date" name="work_start_date" id="work_start_date" class="form-control">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="salary">Salary</label>
                                    <input value="{{ $student->salary }}" type="number" name="salary" id="salary" class="form-control" placeholder="Salary">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="monthly_rate">Monthly Rate</label>
                                    <input value="{{ $student->monthly_rate }}" type="number" name="monthly_rate" id="monthly_rate" class="form-control" placeholder="Monthly Rate">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="daily_rate">Daily Rate</label>
                                    <input value="{{ $student->daily_rate }}" type="number" name="daily_rate" id="daily_rate" class="form-control" placeholder="Daily Rate">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="employer">Employer</label>
                                    <input value="{{ $student->employer }}" type="text" name="employer" id="employer" class="form-control" placeholder="Employer">
                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- Time Sheet Information -->
                        <div class="row">
                            <div class="text-center mt-2">
                                <h4 class="text-decoration-underline">Time Sheet Information</h4>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="monthly_time_sheet">Monthly Time Sheet</label>
                                    <input type="file" name="monthly_time_sheet" id="monthly_time_sheet" class="form-control">
                                    @if (isset($student->monthly_time_sheet) && !empty($student->monthly_time_sheet))
                                        <p>File: {{ $student->monthly_time_sheet }}</p>
                                    @else
                                        <p>No file uploaded</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="month">Month</label>
                                    <select name="month" id="month" class="form-control">
                                        <option value="">Select Month</option>
                                        <option value="1 - January" {{ $student->month == '1 - January' ? 'selected' : '' }}>1 - January</option>
                                        <option value="2 - February" {{ $student->month == '2 - February' ? 'selected' : '' }}>2 - February</option>
                                        <option value="3 - March" {{ $student->month == '3 - March' ? 'selected' : '' }}>3 - March</option>
                                        <option value="4 - April" {{ $student->month == '4 - April' ? 'selected' : '' }}>4 - April</option>
                                        <option value="5 - May" {{ $student->month == '5 - May' ? 'selected' : '' }}>5 - May</option>
                                        <option value="6 - June" {{ $student->month == '6 - June' ? 'selected' : '' }}>6 - June</option>
                                        <option value="7 - July" {{ $student->month == '7 - July' ? 'selected' : '' }}>7 - July</option>
                                        <option value="8 - August" {{ $student->month == '8 - August' ? 'selected' : '' }}>8 - August</option>
                                        <option value="9 - September" {{ $student->month == '9 - September' ? 'selected' : '' }}>9 - September</option>
                                        <option value="10 - October" {{ $student->month == '10 - October' ? 'selected' : '' }}>10 - October</option>
                                        <option value="11 - November" {{ $student->month == '11 - November' ? 'selected' : '' }}>11 - November</option>
                                        <option value="12 - December" {{ $student->month == '12 - December' ? 'selected' : '' }}>12 - December</option>
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="total_work_hours">Total Work Hours</label>
                                    <input value="{{ $student->total_work_hours }}" type="number" name="total_work_hours" id="total_work_hours" class="form-control" placeholder="Total Work Hours">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="total_training_class_hours">Total Training Class Hours</label>
                                    <input value="{{ $student->total_training_class_hours }}" type="number" name="total_training_class_hours" id="total_training_class_hours" class="form-control" placeholder="Total Training Class Hours">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="total_practice_hours">Total Practice Hours</label>
                                    <input value="{{ $student->total_practice_hours }}" type="number" name="total_practice_hours" id="total_practice_hours" class="form-control" placeholder="Total Practice Hours">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button type="submit" class="btn btn-dark">Update</button>
        </div>
        </form>
    </div>
</section>
@endsection
@push('script')
<script>
    $(document).ready(function(){
        $('.studentForm #client_id').change(function() {
            var clientId = $(this).val();
            if (clientId) {
                $.ajax({
                    url: '{{ route('admin.student.info', '') }}/' + clientId,
                    type: 'GET',
                    success: function(response) {
                        if (response.status) {
                            $('#full_name').val(response.client.full_name);
                            $('#dob').val(response.client.dob);
                            const dob = new Date(response.client.dob);
                            const age = calculateAge(dob);
                            $('#age').val(age);
                            $('#place_of_birth').val(response.restInfo.place_of_birth);
                            $('#father_name').val(response.client.father_name);
                            $('#mother_name').val(response.client.mother_name);
                            $('#visa_number').val(response.restInfo.visa_number);
                            $('#visa_issue_date').val(response.restInfo.visa_issue_date);
                            $('#visa_expiry_date').val(response.restInfo.visa_expiry_date);
                            $('#agent_name').val(response.agent.name);
                            $('#agency_name').val(response.agency.agency_name);
                            $('#training_program').val(response.training.practice_and_work_fields);
                            $('#address_abroad').val(response.restInfo.address_abroad);
                            $('#working_place_abroad').val(response.restInfo.working_place);
                            $('#phone_abroad').val(response.restInfo.phone_abroad);
                            $('#residence_permit_number').val(response.restInfo.residence_permit_number);
                            $('#residence_permit_issue_date').val(response.restInfo.residence_permit_issue_date);
                            $('#residence_permit_expiry_date').val(response.restInfo.residence_permit_expiry_date);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert('Error fetching client information.');
                    }
                });
            } else {
                $('#full_name').val('');
            }
        });
        function calculateAge(dob) {
            const diffMs = Date.now() - dob.getTime();
            const ageDate = new Date(diffMs); 
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }
    });
</script>
@endpush