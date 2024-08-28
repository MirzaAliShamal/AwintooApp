@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.payment.create') }}" class="btn btn-outline-dark">Add Payment</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
    <div class="message"></div>
    @include('admin.response.message')
        <div class="card">
        <div class="card-body table-responsive">                                 
            <table id="datatable" class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Passport Number</th>
                        <th>Payment</th>
                        <th>Job</th>
                        @if(auth()->user()->role == 2)
                            <th>Status</th>
                        @endif
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($data as $row)
                    <tr>
                        <td>{{ $row->client_name }}</td>
                        <td>{{ $row->passport_number }}</td>
                        <td>{{ $row->payment }}</td>
                        <td>{{ $row->job->job_name }}</td>
                        @if(auth()->user()->role == 2)
                            <td>{{ $row->status }}</td>
                        @endif
                        <td>
                            @if($row->status == 'Confirmed')
                                <a class="btn btn-sm btn-outline-success" href="{{ route('admin.payment.invoice', $row->id) }}">
                                    <i class="fa fa-file"></i>
                                </a>
                            @endif
                            {{-- <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.payment.edit', $row->id) }}">
                                <i class="fa fa-pen"></i>
                            </a> --}}
                            <a href="#" data-destroy="{{ route('admin.payment.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                <i class="fa fa-trash"></i>
                            </a>
                            @if(auth()->user()->role == 1)
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ $row->status ?? 'Status' }}
                                </button>
                                <div class="dropdown-menu dropdown-menu-scrollable">
                                    @foreach([
                                        'Pending',
                                        'Confirmed',
                                    ] as $status)
                                        <a class="dropdown-item update-status" data-status="{{ route('admin.payment.updateStatus', ['id' => $row->id, 'status' => $status]) }}" href="#">
                                            {{ $status }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Record not found.</td>
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