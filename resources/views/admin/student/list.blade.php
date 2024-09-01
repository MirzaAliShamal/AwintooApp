@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.student.create') }}" class="btn btn-outline-dark">Add Student</a>
            </div>
            <div class="row text-center mt-2">
                <div class="col-sm-4">
                    <a href="#" data-mail="{{ route('admin.student.sendArrivalNotification') }}" class="btn btn-outline-dark send-notification">Send Arrival Notification</a>
                </div>
                <div class="col-sm-4">
                    <a href="#" id="monthly-report" data-route="{{ route('admin.student.monthlyReport') }}" data-title="Send Monthly Mail" data-toggle="modal" data-target="#mailModal" class="btn btn-outline-dark">Send Monthly Time Sheet to HR</a>
                </div>
                <div class="col-sm-4">
                    <a href="#" data-mail="{{ route('admin.student.sendPaymentNotification') }}" class="btn btn-outline-dark send-notification">Send Salary Payment Notification</a>
                </div>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group" style="width: 500px;">
                            <input type="date" id="start_date" class="form-control" placeholder="Start Date">
                            <input type="date" id="end_date" class="form-control" placeholder="End Date">
                            <button id="filter" class="btn btn-primary">Filter</button>
                            <button id="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="input-group input-group float-right" style="width: 250px;">
                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">                                 
                <table id="datatable" class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Student ID</th>
                            <th>Student Name</th>
                            <th>Arrival Date RO</th>
                            <th>Employer</th>
                            <th>Working Place RO</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody id="student-data">
                        @forelse($students as $student)
                        <tr>
                            <td><input type="checkbox" class="student-checkbox" value="{{ $student->id }}"></td>
                            <td>{{ $student->std_unique_id  }}</td>
                            <td>{{ $student->full_name }}</td>
                            <td>{{ \Carbon\Carbon::parse($student->arrival_date_ro)->format('d-m-Y') }}</td>
                            <td>{{ $student->employer }}</td>
                            <td>{{ $student->working_place_ro }}</td>
                            <td>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.student.edit', $student->id) }}">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" data-destroy="{{ route('admin.student.destroy', $student->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Record not found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>  
                <div class="mt-2">
                    {{ $students->links('admin.pagination.page_limits') }}
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
                url: '{{ route('admin.student.search') }}',
                method: 'GET',
                data: { search: query },
                success: function(response) {
                    var rows = '';
                    if (response.status) {
                        $.each(response.data, function(index, row) {
                            rows += '<tr>';
                            rows += '<td><input type="checkbox" class="student-checkbox" value="'+ row.id +'"></td>';
                            rows += '<td>' + row.std_unique_id  + '</td>';
                            rows += '<td>' + row.full_name + '</td>';
                            var dateParts = row.arrival_date_ro.split('-');
                            var formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                            rows += '<td>' + formattedDate + '</td>';
                            rows += '<td>' + row.employer + '</td>';
                            rows += '<td>' + row.working_place_ro + '</td>';
                            rows += '<td>';
                            rows += '<a class="btn btn-sm btn-outline-primary" href="' + '{{ route('admin.student.edit', ':id') }}'.replace(':id', row.id) + '"><i class="fa fa-pen"></i></a>';
                            rows += '<a href="#" data-destroy="' + '{{ route('admin.student.destroy', ':id') }}'.replace(':id', row.id) + '" class="btn btn-sm btn-outline-danger deleteAction ml-1"><i class="fa fa-trash"></i></a>';
                            rows += '</td></tr>';
                        });
                    } else {
                        rows = '<tr><td colspan="6">Record not found.</td></tr>';
                    }
                    $('#student-data').html(rows);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });

        function renderTableRows(data) {
            var rows = '';
            if (data.length > 0) {
                $.each(data, function(index, row) {
                    rows += '<tr>';
                    rows += '<td><input type="checkbox" class="student-checkbox" value="'+ row.id +'"></td>';
                    rows += '<td>' + row.std_unique_id + '</td>';
                    rows += '<td>' + row.full_name + '</td>';
                    var dateParts = row.arrival_date_ro.split('-');
                    var formattedDate = dateParts[2] + '-' + dateParts[1] + '-' + dateParts[0];
                    rows += '<td>' + formattedDate + '</td>';
                    rows += '<td>' + row.employer + '</td>';
                    rows += '<td>' + row.working_place_ro + '</td>';
                    rows += '<td>';
                    rows += '<a class="btn btn-sm btn-outline-primary" href="' + '{{ route('admin.student.edit', ':id') }}'.replace(':id', row.id) + '"><i class="fa fa-pen"></i></a>';
                    rows += '<a href="#" data-destroy="' + '{{ route('admin.student.destroy', ':id') }}'.replace(':id', row.id) + '" class="btn btn-sm btn-outline-danger deleteAction ml-1"><i class="fa fa-trash"></i></a>';
                    rows += '</td>';
                    rows += '</tr>';
                });
            } else {
                rows = '<tr><td colspan="6">No records found</td></tr>';
            }
            $('#student-data').html(rows);
        }

        function fetchAndRenderData(filters) {
            $.ajax({
                url: '{{ route("admin.student.filter") }}',
                method: 'GET',
                data: filters,
                success: function(response) {
                    renderTableRows(response.data);
                }
            });
        }

    // Filter function
        $('#filter').click(function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var filters = {
                start_date: startDate,
                end_date: endDate,
            };
            fetchAndRenderData(filters);
        });

    // Reset function
        $('#reset').click(function() {
            $('#start_date').val('');  
            $('#end_date').val('');    
            var filters = {
                start_date: '',
                end_date: '',
            };
            fetchAndRenderData(filters);
        });
        
    });
</script>
@endpush