@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.practice.create') }}" class="btn btn-outline-dark">Add Training</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
    @include('admin.response.message')
    <div class="message"></div>
        <div class="card">
        <div class="card-body table-responsive">                                 
            <table id="datatable" class="table table-hover text-nowrap text-center">
                <thead>
                    <tr>            
                        <th>Company Name</th>
                        <th>Company Tax Number</th>
                        <th>Company Email</th>
                        <th>Company Phone Number</th>
                        <th>Practice & Work</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($practice as $row)
                    <tr>                    
                        <td>{{ $row->company_name }}</td>
                        <td>{{ $row->company_tax_number }}</td>
                        <td>{{ $row->company_email }}</td>
                        <td>{{ $row->company_phone_number }}</td>
                        <td>{{ $row->practice_and_work_fields }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.practice.edit', $row->id) }}">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="#" data-destroy="{{ route('admin.practice.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">Record not found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>     
            <div class="mt-2">
                {{ $practice->links('admin.pagination.page_limits') }}
            </div>                            
        </div>
    </div>
</div>
</section>
@endsection