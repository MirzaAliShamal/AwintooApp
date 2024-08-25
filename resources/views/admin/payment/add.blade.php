@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.payment.index') }}" class="btn btn-outline-dark">Back</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="message"></div>
    <div class="container-fluid">
        <form class="saveForm" data-storeURL="{{ route('admin.payment.store') }}">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-body">                             
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="client_id">Client ID</label>
                                         <select class="form-control" name="client_id" id="client_id">
                                            <option value="">Select Client</option>
                                            @forelse($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->unique_id_number }} - {{ $client->full_name }}</option>
                                            @empty
                                            <option>No Record Found</option>
                                            @endforelse
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="client_name">Client Name</label>
                                        <input type="text" name="client_name" id="client_name" class="form-control" placeholder="Client Name">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="passport_number">Passport Number</label>
                                        <input type="text" name="passport_number" id="passport_number" class="form-control" placeholder="Passport Number">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="payment">Payment</label>
                                        <input type="number" name="payment" id="payment" class="form-control" placeholder="Payment">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="job_name">Job</label>
                                        <input type="text" id="job_name" disabled class="form-control" placeholder="Job">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price">Price</label>
                                        <input type="number" id="price" disabled class="form-control" placeholder="Price">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="after_deduction">After Deduction</label>
                                        <input type="number" name="after_deduction" id="after_deduction" class="form-control" placeholder="After Deduction">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 row">
                                        <div class="col-md-6">
                                        <label for="proof_of_payment">Proof of Payment</label>
                                        <input type="file" name="proof_of_payment" id="proof_of_payment" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 text-center">
                                        <img id="proof_of_payment_photo" class="img-fluid img-thumbnail" src="#" alt="Image preview" style="display:none; max-width: 50%; height: auto;">
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                                                        
                    </div>
                </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-dark">Save</button>
            </div>
        </form>
    </div>
</section>
@endsection

@push('script')
<script>
$(document).ready(function() {
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
    handleFilePreview('#proof_of_payment', '#proof_of_payment_photo');
});
</script>
@endpush