@extends('admin.layouts.app')
@section('panel')
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.agency.index') }}" class="btn btn-outline-dark">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.agency.update', $agency->id) }}">
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="agency_name">Agency Name</label>
                                        <input type="text" name="agency_name" id="agency_name" placeholder="Agency Name" class="form-control" value="{{ old('agency_name', $agency->agency_name) }}" required>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_name">Company Name</label>
                                        <input type="text" name="company_name" id="company_name" placeholder="Company Name" class="form-control" value="{{ old('company_name', $agency->company_name) }}" required>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="company_address">Company Address</label>
                                        <textarea name="company_address" id="company_address" class="form-control" rows="3" required>{{ old('company_address', $agency->company_address) }}</textarea>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number', $agency->phone_number) }}" id="phone_number" placeholder="Phone Number" class="form-control">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ old('email', $agency->email) }}" class="form-control" placeholder="Email">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="director_name">Director Name</label>
                                        <input type="text" name="director_name" id="director_name" class="form-control" value="{{ old('director_name', $agency->director_name) }}" placeholder="Director Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_registration_number">Company Registration Number</label>
                                        <input type="text" name="company_registration_number" id="company_registration_number" class="form-control" value="{{ old('company_registration_number', $agency->company_registration_number) }}" placeholder="Company Registration Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_tax_number">Company Tax Number</label>
                                        <input type="text" name="company_tax_number" id="company_tax_number" class="form-control" value="{{ old('company_tax_number', $agency->company_tax_number) }}" placeholder="Company Tax Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="company_bank_account">Company Bank Account</label>
                                        <input type="text" name="company_bank_account" id="company_bank_account" class="form-control" value="{{ old('company_bank_account', $agency->company_bank_account) }}" placeholder="Company Bank Account">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bank_name">Bank Name</label>
                                        <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ old('bank_name', $agency->bank_name) }}" placeholder="Bank Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contract_name">Contact Person Name</label>
                                        <input type="text" name="contract_name" id="contract_name" class="form-control" value="{{ old('contract_name', $agency->contract_name) }}" placeholder="Contact Person Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quota">Quota (Number of Clients per Job)</label>
                                        <input type="number" name="quota" id="quota" class="form-control" value="{{ old('quota', $agency->quota) }}" min="0" placeholder="Quota">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="agency_logo">Agency Logo</label>
                                            <input type="file" name="agency_logo" id="agency_logo" class="form-control">
                                            <p></p>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <img id="photo_preview" src="{{ getImage(getFilePath('agencyLogo') . '/' . $agency->agency_logo) }}" class="img-fluid img-thumbnail" alt="agency logo preview" style="max-width: 50%; height: auto;">
                                        </div>
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
function handleFilePreview(input, previewId) {
    $(input).on('change', function(event) {
        var file = event.target.files[0];
        var previewElement = $(previewId);
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var fileType = file.type;
                if (fileType.startsWith('image/')) {
                    previewElement.attr('src', e.target.result).show();
                } else {
                    previewElement.hide();
                }
            };
            reader.readAsDataURL(file);
        } else {
            previewElement.hide();
        }
    });
}
handleFilePreview('#agency_logo', '#photo_preview');
</script>
@endpush
