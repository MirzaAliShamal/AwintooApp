@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.user.indexAdmin') }}" class="btn btn-outline-dark">Admins</a>
                <a href="{{ route('admin.user.create', ['type' => 'agent']) }}" class="btn btn-outline-dark">Add Agent</a>
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
                        <th>Name</th>
                        <th>Agency Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                      <td>{{ $user->agency ? $user->agency->agency_name : '' }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.user.edit', $user->id) }}">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="#" data-destroy="{{ route('admin.user.destroy', $user->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
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
                {{ $users->links('admin.pagination.page_limits') }}
            </div>                              
        </div>
    </div>
</div>
</section>
@endsection