@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
        </div>
    </div>
</section>
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2 text-center">
            <div class="col-sm-12">
                <a href="#" data-route="{{ route('admin.report.contract') }}" data-title="Contract Report" class="btn w-50 bg-orange" data-toggle="modal" data-target="#confirmationModal">Contract Report</a>
                </div>
            <div class="col-sm-12 mt-2">
                <a href="#" data-route="{{ route('admin.report.confirm') }}" data-title="Confirm Report" class="btn bg-olive w-50" data-toggle="modal" data-target="#confirmationModal">Confirm Report</a>
            </div>
            <div class="col-sm-12 mt-2">
                <a href="#" data-route="{{ route('admin.report.loi') }}" data-title="LOI Report" class="btn w-50 bg-purple" data-toggle="modal" data-target="#confirmationModal">LOI Report</a>
            </div>
            {{-- <div class="col-sm-12 mt-2">
                <a href="#" data-route="{{ route('admin.report.rptApplication') }}" data-title="rpt-Application Employeement" class="btn w-50 bg-info" data-toggle="modal" data-target="#confirmationModal">Rpt Application</a>
            </div> --}}
        </div>
    </div>
</section>
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="confirmationForm" action="" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="client-id">Client ID</label>
                        <input type="text" class="form-control" id="client-id" name="client_id" required>
                    </div>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#confirmationModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var route = button.data('route');
            var title = button.data('title');

            // Update the modal's content.
            var modal = $(this);
            modal.find('.modal-title').text(title);
            modal.find('form').attr('action', route);
        });
    });
</script>

@endpush