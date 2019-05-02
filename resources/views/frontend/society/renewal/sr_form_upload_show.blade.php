@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.renewal.actions',compact('sc_application'))
@endsection
@section('content')
    <div class="panel" id="ee-note">
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
            <div class="portlet-body">
                <div class="m-portlet__body m-portlet__body--table">
                    <div class="m-subheader" style="padding: 0;">
                        <div class="d-flex align-items-center justify-content-center">
                            <h4 class="section-title">
                                Application for {{ $sc_application->srApplicationType->application_type }}
                            </h4>
                        </div>
                    </div>
                    <div class="m-section__content mb-0 table-responsive">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100 two-cols">
                                        <h5>Download Renewal Application</h5>
                                        <span class="hint-text">Download submitted application in .pdf format</span>
                                        <div class="mt-auto">
                                            <a title="Donwload Renewal Application" href="{{ route('sr_form_download') }}" target="_blank" class="btn btn-primary" rel="noopener"><i class="icon-pencil"></i>Donwload Renewal Application</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 border-left">
                                    <div class="d-flex flex-column h-100 two-cols">
                                        <h5>Upload Signed & Stamped Application here</h5>
                                        <span class="hint-text">Click on 'Upload' to upload signed & stamped application for society renewal.</span>
                                        <form action="{{ route('sr_form_upload') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="custom-file">
                                                <input class="custom-file-input" name="sr_application_form" type="file"
                                                       id="test-upload" required="">
                                                <label class="custom-file-label" for="test-upload">Choose
                                                    file...</label>
                                                <span class="help-block">
                                                @if(session('error_uploaded_file'))
                                                        {{session('error_uploaded_file')}}
                                                    @endif
                                            </span>
                                                <input type="hidden" name="id" value="{{ $sc_application->id }}">
                                            </div>
                                            <div class="mt-auto">
                                                <button type="submit" class="btn btn-primary btn-custom"
                                                        id="uploadBtn">Upload and Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection