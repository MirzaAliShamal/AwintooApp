@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 d-flex align-items-center justify-content-end">
                <a href="{{ route('admin.info.create') }}" class="btn btn-outline-dark">Add Rest Information</a>
                {{-- <form class="saveForm ml-2" data-storeURL="{{ route('admin.info.import') }}" enctype="multipart/form-data">
                    <input type="file" name="file" class="form-control" />
                    <p></p>
                    <button type="submit" class="btn btn-outline-dark">Import</button>
                </form> --}}
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
                        <th>Body Size</th>
                        <th width="100">Action</th>
                    </tr>
                </thead>
                 <tbody>
                    @forelse($data as $row)
                    <tr>
                        <td>{{ $row->client->full_name }}</td>
                        <td>{{ $row->body_size }}</td>
                        @if((auth()->user()->role == 2))
                        @if(empty($row->five_minutes_work_video) || empty($row->legalized_police_certificate) || empty($row->legalized_school_certificate) || empty($row->legalized_driver_license))
                            <td>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.info.edit', $row->id) }}">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" data-destroy="{{ route('admin.info.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        @endif
                        @else
                            <td>
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.info.edit', $row->id) }}">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a href="#" data-destroy="{{ route('admin.info.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ $row->status ?? 'Status' }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-scrollable">
                                        @foreach([
                                            'Waiting',
                                            'Visa Application Started',
                                            'Accepted',
                                            'Denied',
                                        ] as $status)
                                            <a class="dropdown-item update-status" data-status="{{ route('admin.info.updateStatus', ['id' => $row->id, 'status' => $status]) }}" href="#">
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
                        <td colspan="4">Record not found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>    
            <div class="mt-2">
                {{ $data->links() }}
            </div>                              
        </div>
    </div>
</div>
</section>
@endsection