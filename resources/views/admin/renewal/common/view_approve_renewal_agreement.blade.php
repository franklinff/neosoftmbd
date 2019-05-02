@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.renewal.'.$data->folder.'.action')
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

@php
    if(isset($data->approveAgreement->document_path))
        $document = $data->approveAgreement->document_path;
    else if(isset($data->DraftSignAgreement->document_path))
        $document = $data->DraftSignAgreement->document_path;    
    else if(isset($data->renewalAgreement->document_path))
        $document = $data->renewalAgreement->document_path;
@endphp

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
         <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Lease Agreement </h3>
                     {{ Breadcrumbs::render('renewal_approve_sale_lease',$data->id) }}
                    <div class="ml-auto btn-list">
                        <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                    </div>
            </div>
        </div>  
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Renewal of Lease Agreement
                </a>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane active show" id="sale-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                            <div class="d-flex align-items-center justify-content-center">
                                <h4 class="section-title">
                                    Renewal of Lease Agreement
                                </h4>
                            </div> 
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Lease deed agreement </span>
                                            <div class="mt-auto">
                                                @if(isset($document))
                                                <a href="{{ config('commanConfig.storage_server').'/'.$document }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Lease deed agreement is not available.</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

   <!-- download and upload stamp duty letter      -->
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <div class="m-subheader" style="padding: 0;">
                <div class="d-flex align-items-center justify-content-center">
                    <h4 class="section-title">
                        Stamp Duty Letter
                    </h4>
                </div> 
            </div>
            <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 ">
                            <div class="d-flex flex-column h-100 two-cols">
                                <h5>Download</h5>
                                <span class="hint-text">Click to Download Stamp Duty Letter </span>
                                <div class="mt-auto">
                                    @if(isset($data->StampLetter->document_path) && 
                                        (session()->get('role_name') == config('commanConfig.dyco_engineer')) && ($data->status->status_id != config('commanConfig.renewal_status.forwarded') || $data->status->status_id != config('commanConfig.renewal_status.reverted')))

                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->StampLetter->document_path }}" target="_blank" class="btn btn-primary">Download </a>

                                    @elseif(isset($data->draftStampLetter->document_path))
                                    <a href="{{ config('commanConfig.storage_server').'/'.$data->draftStampLetter->document_path }}" class="btn btn-primary" target="_blank">Download </a>                                
                                    @else
                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                        *Note : Stamp Duty Letter is not available.</span>
                                    @endif
                                </div>
                            </div>
                        </div> 
                    @if($data->status->status_id != config('commanConfig.renewal_status.forwarded') && $data->status->status_id != config('commanConfig.renewal_status.reverted'))
                    
                        <div class="col-sm-6 border-left">
                        <form class="nav-tabs-form" id ="send" role="form" method="POST" action="{{ route('dyco.save_renewal_stamp_duty')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                            <div class="d-flex flex-column h-100 two-cols">
                                <h5>Upload</h5>
                                <input type="hidden" id="oldStamp" name="oldStamp" value="{{ isset($data->StampLetter->document_path) ? $data->StampLetter->document_path : '' }}">
                                <span class="hint-text">Click to upload Stamp Duty Letter</span>
                                    <div class="custom-file">
                                        <input class="custom-file-input" name="stamp_letter" type="file" id="test-upload1">
                                            <label class="custom-file-label" for="test-upload1">Choose
                                            file...</label> 

                                             @if(isset($data->StampLetter->document_path) && 
                                                (session()->get('role_name') == config('commanConfig.dyco_engineer')))

                                                <a href="{{ config('commanConfig.storage_server').'/'.$data->StampLetter->document_path }}" target="_blank" class="btn-link">Download </a> 
                                            @endif 
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary" style="display:block">
                                        Upload</button> 
                                    </div>         
                                </div>
                            </form>                           
                        </div> 
                    @endif    
                    </div>
                </div>
            </div>                   
        </div>
    </div>    
 
@if(session()->get('role_name') == config('commanConfig.dyco_engineer') && ($data->status->status_id != config('commanConfig.renewal_status.forwarded') && $data->status->status_id != config('commanConfig.renewal_status.reverted')) )
    <div class="m-portlet m-portlet--mobile m_panel">
        <div class="m-portlet__body">
            <h5>Send To Society</h5>
            <span class="hint-text" style="margin-left: 12px;"> Send stamp duty Letter to Society,</span>
            <div class="col-xs-12 row">
                <div class="col-md-12">
                    <form class="nav-tabs-form" id ="send" role="form" method="POST" action="{{ route('dyco.renewal_send_to_society')}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                        <div class="col-md-6" style="display: inline;">
                            <input type="submit" class="s_btn btn btn-primary" id="sendToSociety" value="Send to Society ">                                
                        <span class="error" id="stampError" style="display: none;color: #ce2323;margin-top: 11px;margin-left: 12px;">*Note : Please upload Stamp Duty Letter.</span>  
                            </div>     
                    </form> 
                </div>
            </div>
        </div>
    </div>
@endif       
         
    <!-- display all Agreements comments -->
    @if(count($data->AgreementComments) > 0)       
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
            <h3 class="section-title section-title--small">Remark History </h3>
                <div class="remark-body">
                    <div class="remarks-section">
                        <div class="m-scrollable m-scroller ps ps--active-y remarks-section-container"
                            data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
                            @foreach($data->AgreementComments as $comment)
                                <div class="remarks-section__data">
                                    <p class="remarks-section__data__row"><span>Remark By {{ isset($comment->Roles->display_name) ?  $comment->Roles->display_name : '' }}</p>
                                    <p class="remarks-section__data__row"><span>Remark:</span><span>{{ isset($comment->remark) ? $comment->remark : '' }}</span></p>
                                </div>
                            @endforeach                                         
                        </div>
                    </div>
                </div>               
            </div>    
        </div> 
    @endif  

    <!-- Add your remark -->
    @if($data->status->status_id != config('commanConfig.renewal_status.forwarded') && $data->status->status_id != config('commanConfig.renewal_status.reverted'))    
    <form class="nav-tabs-form" id ="CommentFRM" role="form" method="POST" action="{{ route('renewal.save_agreement_comments')}}">
    @csrf        
        <input type="hidden" name="application_id" id="application_id" value="{{ isset($data->id) ? $data->id : '' }}">  
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                <h3 class="section-title section-title--small">Remark</h3>
                <div class="col-xs-12 row">
                    <div class="col-md-12">
                        <textarea rows="4" cols="63" name="remark"></textarea>
                        <button type="submit" class="btn btn-primary mt-3" style="display:block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif   
</div>

@endsection

@section('js')
<script>
    $("#stampFRM").validate({
        rules: {            
            stamp_letter: {
                extension: "pdf",
                required: true
            },
        }, messages: {           
            stamp_letter: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    }); 

    $("#sendToSociety").click(function(){
        
        var stampLetter = $("#oldStamp").val();
        if(stampLetter != ""){
            $("#stampError").css("display","none"); 
            return true;           
        }else{
            $("#stampError").css("display","block");
            return false;
        }
    });       
</script>
@endsection


