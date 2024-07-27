@extends('front.layouts.app')
@section('panel')
<div class="col-lg-8">
	<div class="mt-2">
        <h4>Expiry Notifications</h4>
    </div>
   <table class="table table-bordered text-center">
   		<tr>
            <th>Notification Type</th>
            <th>Expiry Date</th>
            <th>Days Left</th>
            <th>Read</th>
   		</tr>
   		<tbody>
   			@forelse($data as $row)
   			<tr>
   				<td>{{ ucfirst(str_replace('_', ' ', $row->type)) }}</td>
   				<td>{{ $row->expiry_date }}</td>
   				<td>{{ $row->days_left }}</td>
   				<td>
   				@if($row->read == 0)
   					<a href="" data-read='{{ route('front.read.notify', $row->id) }}' class="btn mark-as-read btn-sm text-primary"><i class="fas fa-eye"></i></a>
   				@endif
   				</td>
   			</tr>
   			@empty
   			<tr>
   				<td colspan="4">Notification not found</td>
   			</tr>
   			@endforelse
   		</tbody>
   </table>
</div>
@endsection