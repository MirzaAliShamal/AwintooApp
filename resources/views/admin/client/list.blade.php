@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.client.create') }}" class="btn btn-outline-dark">Add Client</a>
               <form class="saveForm ml-2" data-storeURL="{{ route('admin.client.import') }}" enctype="multipart/form-data">
                    <input type="file" name="file" class="form-control" />
                    <p></p>
                    <button type="submit" class="btn btn-outline-dark">Import</button>
                </form>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
    <div class="message"></div>
    @include('admin.response.message')
        <div class="card">
            {{-- <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group" style="width: 250px;">
                        <input type="text" name="keyword" id="keyword" class="form-control float-right" placeholder="Search">
                    </div>
                </div>
            </div> --}}
        <div class="card-body table-responsive">                                 
            <table id="datatable" class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>
                        <th>Client Id</th>
                        <th>Full Name</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Job</th>
                        @if(auth()->user()->role == 1)
                            <th>Agent</th>
                            <th>Status</th>
                        @endif
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody id="client-data">
                    @forelse($data as $row)
                    <tr>
                        <td>{{ $row->unique_id_number }}</td>
                        <td>{{ $row->full_name }}</td>
                        <td>{{ $row->phone_number }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->job->job_name }}</td>
                        @if(auth()->user()->role == 1)
                            <td>{{ $row->agent->name }}</td>
                            <td>
                                @if($row->validation_status === 'Not Validate')
                                    <span class="badge badge-danger">{{ $row->validation_status }}</span>
                                @else
                                    <span class="badge badge-success">{{ $row->validation_status }}</span>
                                @endif
                            </td>
                        @endif
                        @if((auth()->user()->role == 2))
                        @php
                            $jobNameContainsDriver = preg_match('/\bdriver\b/i', $row->job->job_name);
                        @endphp
                        @if(empty($row->photo) || empty($row->id_front) || empty($row->id_back) || empty($row->job_application_sign) || empty($row->passport_copy) || empty($row->police_certificate) || empty($row->school_certificate) || empty($row->bank_certificate) || ($jobNameContainsDriver && (empty($row->license_front) || empty($row->license_back))))
                            <td>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.client.edit', $row->id) }}">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" data-destroy="{{ route('admin.client.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        @endif
                        @else
                            <td>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.client.edit', $row->id) }}">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" data-destroy="{{ route('admin.client.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $row->status ?? 'Status' }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-scrollable">
                                        @foreach([
                                            'Document Collection',
                                            'Documents Processing',
                                            'Documents Complete',
                                            'Waiting Visa Interview',
                                            'Waiting Visa Announcement',
                                            'Traveled',
                                            'In Training Program',
                                            'Graduate',
                                            'Working'
                                        ] as $status)
                                            <a class="dropdown-item update-status" data-status="{{ route('admin.client.updateStatus', ['id' => $row->id, 'status' => $status]) }}" href="#">
                                                {{ $status }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">Record not found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>                                
            <div class="mt-2">
                {{ $data->links('admin.pagination.page_limits') }}
            </div> 
        </div>
    </div>
</div>
</section>
@endsection

@push('script')
<script>
      $(document).ready(function() {
        $('#keyword').on('keyup', function() {
            var query = $(this).val();

            $.ajax({
                url: '{{ route('admin.client.search') }}',
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
                            if (row.agent.role == 2) {
                                rows += '<td>' + row.agent.name + '</td>';
                            }
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