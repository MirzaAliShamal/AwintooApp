@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.agency.create') }}" class="btn btn-outline-dark">Add Agency</a>
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
                        <th>Agency Logo</th>
                        <th>Agency Name</th>
                        <th>Company Name</th>
                        <th>Director Name</th>
                        <th>Company Registration Number</th>
                        <th>Quota</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($agency as $row)
                    <tr>
                        <td>
                            <img src="{{ getImage(getFilePath('agencyLogo') . '/' . $row->agency_logo) }}" class="img-fluid img-thumbnail" alt="Image preview" style="height:70px;">
                        </td>
                        <td>{{ $row->agency_name }}</td>
                        <td>{{ $row->company_name }}</td>
                        <td>{{ $row->director_name }}</td>
                        <td>{{ $row->company_registration_number }}</td>
                        <td>{{ $row->quota }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.agency.edit', $row->id) }}">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="#" data-destroy="{{ route('admin.agency.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
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
                {{ $agency->links('admin.pagination.page_limits') }}
            </div>                            
        </div>
    </div>
</div>
</section>
@endsection