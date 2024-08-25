@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="{{ route('admin.notify.index', ['type' => 'id_expire']) }}" class="btn btn-outline-dark {{ ( request('type') == 'id_expire') ? 'active' : '' }}">Id Expiry</a>
                <a href="{{ route('admin.notify.index', ['type' => 'passport']) }}" class="btn btn-outline-dark {{ ( request('type') == 'passport') ? 'active' : '' }}">Passport Expiry</a>
                <a href="{{ route('admin.notify.index', ['type' => 'insurance']) }}" class="btn btn-outline-dark {{ ( request('type') == 'insurance') ? 'active' : '' }}">Insurance Expiry</a>
                <a href="{{ route('admin.notify.index', ['type' => 'driver']) }}" class="btn btn-outline-dark {{ ( request('type') == 'driver') ? 'active' : '' }}">Driver Licence Expiry</a>
                <a href="{{ route('admin.notify.index', ['type' => 'police']) }}" class="btn btn-outline-dark {{ ( request('type') == 'police') ? 'active' : '' }}">Police Certificate Expiry</a>
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
                        <th>Client ID</th>
                        <th>Client Name</th>
                        <th>Expiry Date</th>
                        <th>Days Left</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($data as $row)
                    <tr>
                        <td>{{ $row->client_id }}</td>
                        <td>{{ $row->full_name }}</td>
                        <td>{{ $row->expiry_date }}</td>
                        <td>{{ $row->days_left }}</td>
                        <td>
                            <a href="#" data-destroy="{{ route('admin.notify.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Record not found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>                                
        </div>
    </div>
</div>
</section>
@endsection