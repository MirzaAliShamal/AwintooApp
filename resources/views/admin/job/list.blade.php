@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.job.create') }}" class="btn btn-outline-dark">Add Job</a>
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
            <table id="datatable" class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>Job Name</th>
                        <th>Price</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($jobs as $job)
                    <tr>
                        <td>{{ $job->job_name }}</td>
                        <td>{{ $job->price }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.job.edit', $job->id) }}">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="#" data-destroy="{{ route('admin.job.destroy', $job->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
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
                {{ $jobs->links('admin.pagination.page_limits') }}
            </div>                              
        </div>
    </div>
</div>
</section>
@endsection