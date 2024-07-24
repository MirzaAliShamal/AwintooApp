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
        <div class="card">
        <div class="card-body table-responsive">                                 
            <table id="datatable" class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Passport Number</th>
                        <th>Payment</th>
                        <th>Job</th>
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
                        <td>
                            <a class="btn btn-sm btn-outline-success" href="{{ route('admin.payment.invoice', $row->id) }}">
                                <i class="fa fa-file"></i>
                            </a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.payment.edit', $row->id) }}">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="#" data-destroy="{{ route('admin.payment.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">Record not found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>                                
        </div>
    </div>
</div>
</section>
@endsection