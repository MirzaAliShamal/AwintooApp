@extends('admin.layouts.app')
@section('panel')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.practice.index') }}" class="btn btn-outline-dark">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.practice.update', $practice->id) }}">
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" placeholder="Company Name" value="{{ old('company_name', $practice->company_name) }}" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_address">Company Address</label>
                                        <input type="text" name="company_address" id="company_address" placeholder="Company Address" value="{{ old('company_address', $practice->company_address) }}" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_tax_number">Company Tax Number</label>
                                        <input type="text" name="company_tax_number" id="company_tax_number" placeholder="Company Tax Number" value="{{ old('company_tax_number', $practice->company_tax_number) }}" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_email">Company Email</label>
                                        <input type="email" name="company_email" id="company_email" class="form-control" placeholder="Company Email" value="{{ old('company_email', $practice->company_email) }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_phone_number">Company Phone Number</label>
                                        <input type="text" name="company_phone_number" id="company_phone_number" placeholder="Company Phone Number" value="{{ old('company_phone_number', $practice->company_phone_number) }}" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="legal_representative_name">Legal Representative Name</label>
                                        <input type="text" name="legal_representative_name" id="legal_representative_name" class="form-control" placeholder="Legal Representative Name" value="{{ old('legal_representative_name', $practice->legal_representative_name) }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="legal_representative_email">Legal Representative Email</label>
                                        <input type="email" name="legal_representative_email" id="legal_representative_email" class="form-control" placeholder="Legal Representative Email" value="{{ old('legal_representative_email', $practice->legal_representative_email) }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_person_name">Contact Person Name</label>
                                        <input type="text" name="contact_person_name" id="contact_person_name" class="form-control" placeholder="Contact Person Name" value="{{ old('contact_person_name', $practice->contact_person_name) }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contact_person_email">Contact Person Email</label>
                                        <input type="text" name="contact_person_email" id="contact_person_email" class="form-control" placeholder="Contact Person Email" value="{{ old('contact_person_email', $practice->contact_person_email) }}">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="practice_and_work_fields">Practice & Work Fields</label>
                                        <select name="practice_and_work_fields" id="practice_and_work_fields" class="form-control">
                                            <option value="" disabled>Select Practice & Work Field</option>
                                            <option value="Welder" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Welder' ? 'selected' : '' }}>Welder</option>
                                            <option value="Locksmiths" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Locksmiths' ? 'selected' : '' }}>Locksmiths</option>
                                            <option value="Driver" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Driver' ? 'selected' : '' }}>Driver</option>
                                            <option value="Electrician" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Electrician' ? 'selected' : '' }}>Electrician</option>
                                            <option value="Regular Job Not Skilled" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Regular Job Not Skilled' ? 'selected' : '' }}>Regular Job Not Skilled</option>
                                            <option value="Baker" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Baker' ? 'selected' : '' }}>Baker</option>
                                            <option value="Teacher" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Teacher' ? 'selected' : '' }}>Teacher</option>
                                            <option value="HR" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'HR' ? 'selected' : '' }}>HR</option>
                                            <option value="Secretary" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Secretary' ? 'selected' : '' }}>Secretary</option>
                                            <option value="Manager" {{ old('practice_and_work_fields', $practice->practice_and_work_fields) == 'Manager' ? 'selected' : '' }}>Manager</option>
                                        </select>
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