@extends('admin.layouts.app')
@section('panel')
<section class="content-header">                    
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div id="client-docs" class="col-sm-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.eavaluation.showData', $client->id) }}" class="btn btn-outline-dark">{{ $client->full_name }}`s Data</a>
                <a href="{{ route('admin.eavaluation.index') }}" class="btn btn-outline-dark">Back</a>
                <a href="#rest-info" class="btn btn-outline-dark">Rest Information</a>
            </div>
        </div>
    </div>
</section>
<section class="content">
 <div class="container-fluid">
    <div class="message"></div>
    <div class="card p-4">
        <div class="row">
            @php
            $documents = [
                'photo' => 'Photo',
                'id_front' => 'ID Front',
                'id_back' => 'ID Back',
                'license_front' => 'License Front',
                'license_back' => 'License Back',
                'job_application_sign' => 'Job Application Sign',
                'passport_copy' => 'Passport Copy',
                'police_certificate' => 'Police Certificate',
                'school_certificate' => 'School Certificate',
                'bank_certificate' => 'Bank Certificate'
            ];
            @endphp
            @foreach($documents as $key => $label)
            @if(!empty($client->$key))
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header justify-content-between">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>{{ $label }}</strong>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="#" data-delete-doc="{{ route('admin.eavaluation.document.delete', ['id' => $client->id, 'document' => $key]) }}" class="btn btn-sm btn-outline-danger delete-doc">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        @php
                        $fileExtension = pathinfo($client->$key, PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ getImage(getFilePath($key) .'/' .$client->$key) }}" alt="{{ $label }}" class="img-fluid">
                        @elseif($fileExtension == 'pdf')
                        <a href="{{ getImage(getFilePath($key) .'/' .$client->$key) }}" target="_blank" class="btn btn-outline-primary">
                            View PDF
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6">
                <h3 id="rest-info">Rest Information Documents</h3>
            </div>
            <div class="col-sm-6 text-right">
                <a href="#client-docs" class="btn btn-outline-dark">Client Documents</a>
            </div>
        </div>
        <hr>
        @php
        $restDocuments = [
            'five_minutes_work_video' => 'Five Minutes Work Video',
            'legalized_police_certificate' => 'Legalized Police Certificate',
            'legalized_school_certificate' => 'Legalized School Certificate',
            'legalized_driver_license' => 'Legalized Driver License',
            'resident_card_front' => 'Resident Card Front',
            'resident_card_back' => 'Resident Card Back'
        ];
        @endphp
        <div class="row">
            @foreach($restDocuments as $key => $label)
            @if(!empty($client->restInfo->$key))
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <strong>{{ $label }}</strong>
                            </div>
                            <div class="col-sm-6 text-right">
                                <a href="#" data-delete-doc="{{ route('admin.eavaluation.document.delete', ['id' => $client->id, 'document' => $key]) }}" class="btn btn-sm btn-outline-danger delete-doc">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-center">
                        @php
                        $fileExtension = pathinfo($client->restInfo->$key, PATHINFO_EXTENSION);
                        @endphp

                        @if($key === 'five_minutes_work_video' && $fileExtension === 'zip')
                        <a href="{{ getImage(getFilePath($key) .'/' .$client->restInfo->$key) }}" target="_blank" class="btn btn-outline-primary">
                            Download ZIP
                        </a>
                        @elseif(in_array($fileExtension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ getImage(getFilePath($key) .'/' .$client->restInfo->$key) }}" alt="{{ $label }}" class="img-fluid">
                        @elseif($fileExtension == 'pdf')
                        <a href="{{ getImage(getFilePath($key) .'/' .$client->restInfo->$key) }}" target="_blank" class="btn btn-outline-primary">
                            View PDF
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
</section>
@endsection