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
                        @if(auth()->user()->role == 1)
                            <th width="100">Action</th>
                        @endif
                    </tr>
                </thead>
                 <tbody>
                    @forelse($data as $row)
                    <tr>
                        <td>{{ $row->client->full_name }}</td>
                        <td>{{ $row->body_size }}</td>
                        @if(auth()->user()->role == 1)
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.info.edit', $row->id) }}">
                                <i class="fa fa-pen"></i>
                            </a>
                            <a href="#" data-destroy="{{ route('admin.info.destroy', $row->id) }}" class="btn btn-sm btn-outline-danger deleteAction mr-1">
                                <i class="fa fa-trash"></i>
                            </a>
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
        </div>
    </div>
</div>
</section>
@endsection