@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-outline-primary" data-label="Specify the required payment method and details" data-route="{{ route('admin.eavaluation.clientValidationMail') }}" data-title="Client Validation" data-toggle="modal" data-target="#mailModal">Client Validation</a>
                <a class="btn btn-outline-success" data-label="List the specific documents needed clearly" data-route="{{ route('admin.eavaluation.clientDocsRequiredMail') }}" data-title="Additional Document Request" data-toggle="modal" data-target="#mailModal">Additonal Document Request</a>
                <a class="btn btn-outline-danger" data-label="Optional" data-route="{{ route('admin.eavaluation.clientRejectMail') }}" data-title="Reject Client" data-toggle="modal" data-target="#mailModal">Reject Client</a>
                <a class="btn btn-outline-warning" data-label="Optional" data-route="{{ route('admin.eavaluation.clientApplicationCompleteMail') }}" data-title="Client Application Complete" data-toggle="modal" data-target="#mailModal">Application Complete</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="message"></div>
        @include('admin.response.message')
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="keyword" id="keyword" class="form-control float-right" placeholder="Search by client id">
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">                                 
                <table id="datatable" class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Client Id</th>
                            <th>Full Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Job</th>
                            <th>Agent</th>
                            <th>Status</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody id="client-data">
                        @forelse($clients as $row)
                        <tr>
                            <td>{{ $row->unique_id_number }}</td>
                            <td>{{ $row->full_name }}</td>
                            <td>{{ $row->phone_number }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->job->job_name }}</td>
                            <td>{{ $row->agent->name }}</td>
                            <td>
                                @if($row->validation_status === 'Not Validate')
                                    <span class="badge badge-danger">{{ $row->validation_status }}</span>
                                @else
                                    <span class="badge badge-success">{{ $row->validation_status }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.eavaluation.showData', $row->id) }}" class="btn btn-sm btn-outline-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.eavaluation.showDocs', $row->id) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="fa fa-paperclip"></i>
                                </a>
                            </td>
                        </tr>
                            @empty
                            <tr>
                                <td colspan="7">Record not found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>                                
                    <div class="mt-2">
                        {{ $clients->links('admin.pagination.page_limits') }}
                    </div> 
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="confirmationForm" action="" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="client-id">Client ID</label>
                            <input type="text" class="form-control" id="client-id" name="client_id" required>
                        </div>
                        <div class="form-group">
                            <label class="dynamic-label"></label>
                        </div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @push('script')
    <script>
    $(document).ready(function() {
    $('#mailModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var route = button.data('route');
    var title = button.data('title');
    var label = button.data('label');

    var modal = $(this);
    modal.find('.modal-title').text(title);
    modal.find('.dynamic-label').text(label);
    modal.find('form').attr('action', route);

    var form = modal.find('form');
    form.find('.form-group').not(':first').remove();

    if (title.includes('Client Validation')) {
        var radioOptions = `
            <div class="form-group">
                <label>Client Validation Options</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="validation_option" id="option1" value="Proceed to payment according to your contract and submit confirmation through payment area" required>
                    <label class="form-check-label" for="option1">
                        Proceed to payment according to your contract and submit confirmation through "payment" area
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="validation_option" id="option2" value="Please contact the person in charge for receiving payment details" required>
                    <label class="form-check-label" for="option2">
                        Please contact the person in charge for receiving payment details
                    </label>
                </div>
            </div>
        `;
        form.append(radioOptions);
    } else if (title.includes('Additional Document Request')) {
        var checkboxes = `
            <div class="form-group">
                <label>Additional Documents Required</label><br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="Photo" id="photo">
                    <label class="form-check-label" for="photo">Photo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="ID Card Front" id="id_front">
                    <label class="form-check-label" for="id_front">ID Card Front</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="Id Card Back" id="id_back">
                    <label class="form-check-label" for="id_back">ID Card Back</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="License Front" id="license_front">
                    <label class="form-check-label" for="license_front">License Front</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="License Back" id="license_back">
                    <label class="form-check-label" for="license_back">License Back</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="Job Application Sign" id="job_application_sign">
                    <label class="form-check-label" for="job_application_sign">Job Application Sign</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="Passport Copy" id="passport_copy">
                    <label class="form-check-label" for="passport_copy">Passport Copy</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="Police Certificate" id="police_certificate">
                    <label class="form-check-label" for="police_certificate">Police Certificate</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="School Certificate" id="school_certificate">
                    <label class="form-check-label" for="school_certificate">School Certificate</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="Bank Certificate" id="bank_certificate">
                    <label class="form-check-label" for="bank_certificate">Bank Certificate</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="documents[]" value="other" id="other">
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>
            <!-- Textarea for 'Other' -->
            <div class="form-group" id="other-textarea-group" style="display: none;">
                <label for="other_text">Please specify:</label>
                <textarea class="form-control" name="other_text" id="other_text" rows="3"></textarea>
            </div>
        `;
        form.append(checkboxes);
        $('#other').change(function () {
            if ($(this).is(':checked')) {
                $('#other-textarea-group').show();
            } else {
                $('#other-textarea-group').hide();
            }
        });
    }
});

    $('#keyword').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
            url: '{{ route('admin.eavaluation.search') }}',
            method: 'GET',
            data: { search: query },
            success: function(response) {
                var rows = '';
                if (response.status) {
                    $.each(response.data, function(index, row) {
                        rows += '<tr>';
                        rows += '<td>' + row.unique_id_number + '</td>';
                        rows += '<td>' + row.full_name + '</td>';
                        rows += '<td>' + row.phone_number + '</td>';
                        rows += '<td>' + row.email + '</td>';
                        rows += '<td>' + row.job.job_name + '</td>';
                        rows += '<td>' + row.agent.name + '</td>'; 
                        rows += '<td>';
                        rows += '<a class="btn btn-sm btn-outline-primary" href="' + '{{ route('admin.client.edit', ':id') }}'.replace(':id', row.id) + '"><i class="fa fa-pen"></i></a>';
                        rows += '<a href="#" data-destroy="' + '{{ route('admin.client.destroy', ':id') }}'.replace(':id', row.id) + '" class="btn btn-sm btn-outline-danger deleteAction ml-1"><i class="fa fa-trash"></i></a>';
                        rows += '</td></tr>';
                    });
                } else {
                    rows = '<tr><td colspan="6">Record not found.</td></tr>';
                }
                $('#client-data').html(rows);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
@endpush