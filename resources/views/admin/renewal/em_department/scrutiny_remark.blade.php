@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.renewal.'.$data->folder.'.action')
@endsection
@section('content')
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0">
        <div class="d-flex">
            {{ Breadcrumbs::render('renewal_em_scrutiny',$data->id) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item em_tabs" id="section-1">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#scrutiny-summary-remark" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> No Dues Certificate
                </a>
            </li>
            <li class="nav-item m-tabs__item em_tabs" id="section-2">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#list-of-allottes" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> List of Bonafide Allottees
                </a>
            </li>
            <li class="nav-item m-tabs__item em_tabs" id="section-3">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#society-resolution" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i> Covering Letter
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div class="tab-pane section-1 active show" id="scrutiny-summary-remark" role="tabpanel">
            <div class="m-portlet m-portlet--mobile m_panel">
                <div class="m-portlet__body" style="padding-right: 0;">
                    @if (session('success'))
                        <div class="alert alert-success society_registered">
                            <div class="text-center">{{ session('success') }}</div>
                        </div>
                    @endif
                    @if(session()->get('role_name') == config('commanConfig.estate_manager') && $data->srApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                        <h3 class="section-title section-title--small mb-0">Generate No dues certificate:</h3>
                        <div class=" row-list">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="font-weight-semi-bold">Edit No Dues Certificate</p>
                                    <p>
                                        @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.draft_text')))
                                            <div class="alert alert-success society_registered">
                                                <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message.draft_text')) }}</div>
                                            </div>
                                        @endif
                                    </p>
                                    <p>Click to view generated No dues certificate in PDF format</p>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        Edit</a>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="w-100 @if($data->srApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded')) row-list @endif">
                        <div class="">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100">
                                        <h5>Download No Dues Certificate</h5>
                                        <p> Click to download No Dues Certificate in pdf format </p>
                                        <div class="mt-auto">
                                            @if($no_dues_certificate_docs['renewal_drafted_no_dues_certificate']['sr_document_status'] != null)
                                                <a href="{{ config('commanConfig.storage_server').'/'.$no_dues_certificate_docs['renewal_drafted_no_dues_certificate']['sr_document_status']->document_path }}"
                                                   class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                            @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                            * Note : No Dues Certificate not available. </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(session()->get('role_name') == config('commanConfig.estate_manager') && $data->srApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                    <div class="col-sm-6 border-left">
                                    <div class="d-flex flex-column h-100">
                                        <h5>Upload No Dues Certificate</h5>
                                        <span class="hint-text">Click on 'Upload' to upload No Dues Certificate</span>
                                        <form action="{{ route('em.save_renewal_no_dues_certificate') }}" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="custom-file">
                                                <input class="custom-file-input pdfcheck" name="no_dues_certificate" type="file"
                                                       id="test-upload_1" required="required">
                                                <label class="custom-file-label" for="test-upload_1">Choose
                                                    file...</label>
                                                <span class="text-danger" id="file_error"></span>
                                                <input type="hidden" id="applicationId" name="applicationId" value="{{ $data->id }}">
                                            </div>
                                            @if(isset($no_dues_certificate_docs['renewal_uploaded_no_dues_certificate']) && $no_dues_certificate_docs['renewal_uploaded_no_dues_certificate']->sr_document_status != null)
                                                <a href="{{ config('commanConfig.storage_server').'/'.$no_dues_certificate_docs['renewal_uploaded_no_dues_certificate']->sr_document_status->document_path }}" class="btn btn-primary btn-custom" target="_blank" rel="no-opener">Download uploaded file</a><br/><br/>
                                            @endif
                                            <div class="mt-auto">
                                                <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="tab-pane section-2" id="list-of-allottes" role="tabpanel">
        <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body" style="padding-right: 0;">
                    @if (session('success'))
                        <div class="alert alert-success society_registered">
                            <div class="text-center">{{ session('success') }}</div>
                        </div>
                    @endif
                        <div class=" row-list">
                            <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="section-title section-title--small mb-0">
                                        List of Allottees uploaded @if(isset($bonafide_docs['renewal_bonafide_list']) && isset($bonafide_docs['renewal_bonafide_list']->sr_document_status->document_path) && Session::all()['role_name'] == config('commanConfig.estate_manager') && $data->srApplicationLog->status_id == config('commanConfig.conveyance_status.in_process')) by Society @endif:</h5>
                                        
                                            <p>Click to download generated list of allottees in xls format</p>
                                            <!-- <a href="{{ route('em.download_list_of_allottees') }}" class="btn btn-primary" target="_blank" rel="noopener">Download</> -->
                                            @if(isset($bonafide_docs['renewal_bonafide_list']) && isset($bonafide_docs['renewal_bonafide_list']->sr_document_status->document_path) && $data->srApplicationLog->status_id == config('commanConfig.conveyance_status.forwarded'))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$bonafide_docs['renewal_bonafide_list']->sr_document_status->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">
                                                Download</a>
                                            @elseif(isset($bonafide_docs['renewal_bonafide_list']) && isset($bonafide_docs['renewal_bonafide_list']->sr_document_status->document_path) && Session::all()['role_name'] != config('commanConfig.estate_manager'))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$bonafide_docs['renewal_bonafide_list']->sr_document_status->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">
                                                    Download</a>

                                            @elseif(isset($society_list_docs['list_of_members_from_society']->sr_document_status->document_path) && Session::all()['role_name'] == config('commanConfig.estate_manager'))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$society_list_docs['list_of_members_from_society']->sr_document_status->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">
                                                    Download Allottees List</a> 
                                                    <a href="{{ route('em.download_list_of_allottees') }}" class="btn btn-primary" target="_blank" rel="noopener">Download Template</a>
                                            @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">* Note : List of Allottees is not available. </span>   
                                            @endif    
                                    </div>
        
                    
                                @if(session()->get('role_name') == config('commanConfig.estate_manager') && $data->srApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                    <div class="col-sm-6 @if(isset($data->sr_form_request) && $data->sr_form_request->template_file) border-left @endif">
                                    <div class="d-flex flex-column h-100">
                                        <h5>Upload List of Bonafide Allottees</h5>
                                        <span class="hint-text">Click on 'Upload' to upload List of Bonafide Allottees</span>
                                        <p>
                                        @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                            <div class="alert alert-success society_registered">
                                                <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger society_registered">
                                                <div class="text-center">{{ session('error') }}</div>
                                            </div>
                                        @endif
                                            </p>
                                            <form action="{{ route('em.save_renewal_list_of_allottees') }}" id="list_of_allottees" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="custom-file">
                                                    <input class="custom-file-input pdfcheck" name="document_path" type="file"
                                                           id="test-upload_2" required="required">
                                                    <label class="custom-file-label" for="test-upload_2">Choose
                                                        file...</label>
                                                    <span class="text-danger" id="file_error"></span>
                                                    <input type="hidden" id="application_id" name="application_id" value="{{ $data->id }}">
                                                    <input type="hidden" id="document_name" name="document_name" value="bonafide_list">
                                                </div>
                                                @if(isset($bonafide_docs['renewal_bonafide_list']) && $bonafide_docs['renewal_bonafide_list']->sr_document_status != null)
                                                    <a href="{{ config('commanConfig.storage_server').'/'.$bonafide_docs['renewal_bonafide_list']->sr_document_status->document_path }}" class="btn btn-primary btn-custom" target="_blank" rel="no-opener">Download uploaded file</a><br/><br/>
                                                @endif
                                                <div class="mt-auto">
                                                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                                </div>
                                            </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane section-3" id="society-resolution" role="tabpanel">
            <!-- Society Resolution div here -->
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
                <div class="portlet-body">
                    <div class="m-portlet__body" style="padding-right: 0;">
                    @if (session('success'))
                        <div class="alert alert-success society_registered">
                            <div class="text-center">{{ session('success') }}</div>
                        </div>
                    @endif
                         <div class=" row-list">
                            <div class="row">                                
                                    <div class="col-sm-6">
                                        <h5 class="section-title section-title--small mb-0">Download Covering Letter</h5>
                                        <p>
                                            @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.draft_text')))
                                                <div class="alert alert-success society_registered">
                                                    <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.draft_text')) }}</div>
                                                </div>
                                            @endif
                                            @if (session('error'))
                                                <div class="alert alert-danger society_registered">
                                                    <div class="text-center">{{ session('error') }}</div>
                                                </div>
                                            @endif
                                        </p>
                                        <p>Click to download Covering Letter in pdf format</p>
                                
                                    @if(!empty($covering_letter_docs[config('commanConfig.documents.em_renewal.covering_letter')[0]]->sr_document_status))
                                            <a href="{{ config('commanConfig.storage_server').'/'.$covering_letter_docs[config('commanConfig.documents.em_renewal.covering_letter')[0]]->sr_document_status->document_path }}" class="btn btn-primary" target="_blank" rel="noopener">Download</a>
                                    
                                    @else
                                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                * Note : Covering Letter is not available. </span>
                                    @endif
                                </div>    

                                @if(session()->get('role_name') == config('commanConfig.estate_manager') && $data->srApplicationLog->status_id != config('commanConfig.conveyance_status.forwarded'))
                                    <div class="col-sm-6 border-left">
                                    <div class="d-flex flex-column h-100">
                                        <h5>Upload Covering Letter</h5>
                                        <span class="hint-text">Click on 'Upload' to upload Covering Letter</span>
                                        <p>
                                        @if (session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')))
                                            <div class="alert alert-success society_registered">
                                                <div class="text-center">{{ session(config('commanConfig.no_dues_certificate.redirect_message_status.upload')) }}</div>
                                            </div>
                                        @endif
                                        @if (session('error'))
                                        <div class="alert alert-danger society_registered">
                                            <div class="text-center">{{ session('error') }}</div>
                                        </div>
                                        @endif
                                        </p>
                                        <form action="{{ route('em.upload_renewal_covering_letter') }}" id="no_dues_certi_upload" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="custom-file">
                                                <input class="custom-file-input pdfcheck" name="covering_letter" type="file"
                                                       id="test-upload_3" required="required">
                                                <label class="custom-file-label" for="test-upload_3">Choose
                                                    file...</label>
                                                <span class="text-danger" id="file_error"></span>
                                                <input type="hidden" id="application_id" name="application_id" value="{{ $data->id }}">
                                            </div>
                                            @if(isset($covering_letter_docs['renewal_em_covering_letter']) && $covering_letter_docs['renewal_em_covering_letter']->sr_document_status != null)
                                                <a href="{{ config('commanConfig.storage_server').'/'.$covering_letter_docs['renewal_em_covering_letter']->sr_document_status->document_path }}" class="btn btn-primary btn-custom" target="_blank" rel="no-opener">Download uploaded file</a><br/><br/>
                                            @endif
                                            <div class="mt-auto">
                                                <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Upload</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal modal-large fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">No Dues Certificate</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="noDuesCerti" action="{{route('em.save_renewal_no_dues_certificate')}}" method="POST">
                        @csrf
                        <input type="hidden" id="applicationId" name="applicationId" value="{{ $data->id }}">
                        <input type="hidden" id="document_id" name="text_document_id" value="{{ $no_dues_certificate_docs['renewal_text_no_dues_certificate']->id }}">
                        <input type="hidden" id="document_id" name="pdf_document_id" value="{{ $no_dues_certificate_docs['renewal_drafted_no_dues_certificate']->id }}">
                        <textarea id="ckeditorText" name="ckeditorText" style="display: none;">
                            @if(!empty($content))
                                @php echo $content; @endphp
                            @else
                                <div style="" id="">
                                    <div style="padding-left: 15px;">
                                        <p style="font-weight: bold; font-size: 16px; margin-bottom: 10px;">Subject:</p>
                                        <div style="line-height: 2.0; padding-left: 20px;">
                                        <p style="font-size: 15px;">1. It is to certify that Building No. {{ $data->societyApplication->building_no }} consisting of <span style="font-weight: bold;">test</span> T/S under the <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Scheme at <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> In favour of <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span>
                                            Co-op. Housing Society Ltd. Have paid all the dues in respect of above bldg./bldgs. Including the final sale price for the bldg. and premium of the land as
                                            follow:</p>
                                        </div>
                                        <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                            2. Final Sale Price of the Bldg/bldgs.<br/>
                                            (A) Cost of Construction<span style="padding-left: 30px;font-size: 15px;"></span><br/>
                                            (B) Premium Land<span style="padding-left: 68px;font-size: 15px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                                            <span>Total<span style="padding-left: 88px;font-size: 15px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></span>
                                        </p>
                                    </div>
                                    <div style="padding-left: 15px;">
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    3. Charges for Common Services are paid upto <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                                                    <span> The rate of Charges of Common Services payable by the said Society is Rs.<span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Per Quarter.</span>
                                            </p>

                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    4. Lease Rent Paid Upto <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                                                    <span> The Rate of the Lease rent payable by the said society is Rs.<span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Per Annum</span>
                                            </p>
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    5. Whether Municipal Taxes <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> are paid upto date (In Case the Society is Paying the Municipal Taxes directly to the Municipal Corporation of
                                                    <span><span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> the same stated and accordingly.</span>
                                            </p>
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    6. N.A .Assessment Paid Upto    <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span><br/>
                                                    <span> The Rate of N.A Assessment Payable by the said Society is Rs.<span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Per Tenement/Per Month.</span>
                                            </p>

                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    7. Whether Municipal Taxes <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> are paid upto date (In Case the Society is Paying the Municipal Taxes directly to the Municipal Corporation of
                                                    <span><span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> the same stated and accordingly.</span>
                                            </p>
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    <span> 8. Date of Allotment dt. <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></span>
                                            </p>
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    <span> 9. Date of Handling over of Pump House <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> underground tank to the society.</span>
                                            </p>
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                <span>10. Remarks if any <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><span style="font-weight: bold;"></span>
                                            </p>
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                                    It is confirmed that no litigation with the board involving the society or/ and it’s any member is pending. So also there are no court order/ Injunction restraining. The Board from conveying the above said building or any tenement and from leasing the land.
                                                    There is no objection whatsoever to convey the building and lease the land to the above said society.
                                                    Encl: Bonifide Tenements List.
                                            </p>
                                            <p style="line-height: 2.0; padding-right: 20px; font-size: 15px; ">
                                                Estate Manager <br> <span style="font-weight: bold;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span> Hsg. & Area Dev.  <br> Board, Mumbai
                                            </p>
                                            <p style="line-height: 2.0; padding-left: 20px; font-size: 15px; ">
                                            To,<br>

                                            EM-II /Conveyance<br>

                                            --------------  Board, Mumbai.400051
                                            </p>
                                    </div>
                                </div>
                            @endif
                                </textarea>
                        <input type="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.disableAutoInline = true;
        CKEDITOR.replace('ckeditorText', {
            height: 700,
            allowedContent: true
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script>
        $(document).ready(function () {
            // pdf validation
            // $("#uploadBtn").click(function () {
            //
            //     myfile = $("#test-upload").val();
            //     var ext = myfile.split('.').pop();
            //     if (myfile != '') {
            //
            //         if (ext != "pdf") {
            //             $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
            //             return false;
            //         } else {
            //             $("#file_error").text("");
            //             return true;
            //         }
            //     } else {
            //         $("#file_error").text("This field required");
            //         return false;
            //     }
            // });



            //cookies setting for tabs
            $(".display_msg").delay("slow").slideUp("slow");

            var id = Cookies.get('sectionId');
            if (id != undefined) {
                //alert(id);


                $(".tab-pane").removeClass('active');
                $(".nav-link").removeClass('active');
                $(".m-tabs__item").removeClass('active');
                $("#" + id+ " a").addClass('active');

                $("." + id).addClass('active');
            }

            $(".em_tabs").on('click', function () {
                $(".nav-link").removeClass('active');
                Cookies.set('sectionId', this.id);
            });

            function showUploadedFileName() {
                $('.custom-file-input').change(function (e) {
                    $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
                });
            }
            showUploadedFileName();

            // $('#no_dues_certi_upload').validate({
            //     rules:{
            //         no_dues_certificate: {
            //             required:true,
            //             extension:'pdf'
            //         }
            //     },
            //     messages:{
            //         no_dues_certificate: {
            //             required: 'File is required to upload.',
            //             extension: 'File only in pdf format is required.'
            //         }
            //     }
            // });

            $('#list_of_allottees').validate({
                rules:{
                    document_path: {
                        required:true,
                        extension:'xls'
                    }
                },
                messages:{
                    document_path: {
                        required: 'File is required to upload.',
                        extension: 'File only in xls format is required.'
                    }
                }
            });

            $('.society_registered').delay("slow").slideUp("slow");

        });
    </script>


@endsection