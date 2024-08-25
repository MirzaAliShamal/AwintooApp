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
                <a class="btn btn-outline-success" data-label="List the specific documents needed clearly" data-route="{{ route('admin.eavaluation.clientDocsRequiredMail') }}" data-title="Client Additional Documents Required" data-toggle="modal" data-target="#mailModal">Additonal Document Request</a>
                <a class="btn btn-outline-danger" data-label="Optional" data-route="{{ route('admin.eavaluation.clientRejectMail') }}" data-title="Reject Client" data-toggle="modal" data-target="#mailModal">Reject Client</a>
                <a class="btn btn-outline-warning" data-label="Optional" data-route="{{ route('admin.eavaluation.clientApplicationCompleteMail') }}" data-title="Client Application Complete" data-toggle="modal" data-target="#mailModal">Application Complete</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="message"></div>
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
                        {{ $clients->links() }}
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
                            <input name="message" class="form-control" />
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

                if (label.trim().toLowerCase() === "optional") {
                    modal.find('input[name="message"]').closest('.form-group').hide();
                } else {
                    modal.find('input[name="message"]').closest('.form-group').show();
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