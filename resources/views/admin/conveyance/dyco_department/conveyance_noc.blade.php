@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.dyco_department.action',compact('data'))
@endsection
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif

<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">
            Generate NOC
            </h3>
            {{ Breadcrumbs::render('noc_for_conveyance',$data->id) }} 
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>

  <!-- Generate NOC-->    
    @if(session()->get('role_name') == config('commanConfig.dycdo_engineer'))
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex align-items-center justify-content-center">
                        <h4 class="section-title">
                            Generate NOC
                        </h4>
                    </div>
                </div> 
                <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
                    <div class="container">
                        <div class="row">
                        @if($data->status->status_id != config('commanConfig.conveyance_status.forwarded'))
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Generate</h5>
                                    <span class="hint-text">Click to Generate NOC </span>
                                    <div class="mt-auto">                           
                                        <a href="{{ route('dyco.generate_canveyance_noc',encrypt($data->id)) }}" class="btn btn-primary">Generate </a>
                                    </div>
                                </div>
                            </div>
                        @endif     
                            <div class="col-sm-6 border-left">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Download</h5>
                                    <span class="hint-text">Click to Download NOC </span>
                                    <div class="mt-auto">
                                        @if(isset($data->draftNOC->document_path))
                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->draftNOC->document_path }}" class="btn btn-primary" target="_blank">Download </a>                                
                                        @else
                                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                            *Note : NOC is not available.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                   
            </div>
        </div> 
    @endif   
 
    <!-- Send NOC to society -->
    @if(session()->get('role_name') == config('commanConfig.dyco_engineer'))

        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex align-items-center justify-content-center">
                       <h4 class="section-title">
                            Download Generated NOC
                        </h4>
                    </div>
                </div> 
                <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
                    <div class="container">
                        <div class="row">     
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Download</h5>
                                    <span class="hint-text">Click to Download NOC </span>
                                    <div class="mt-auto">
                                        @if(isset($data->draftNOC->document_path) && $data->status->status_id != config('commanConfig.conveyance_status.forwarded'))
                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->draftNOC->document_path }}" class="btn btn-primary" target="_blank">Download </a>                                
                                        @elseif(isset($data->NOC->document_path))
                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->NOC->document_path }}" class="btn btn-primary" target="_blank"> Download </a>
                                        @else
                                        <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                            *Note : NOC is not available.</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                   
            </div>
        </div>
        @endif 
         @if(session()->get('role_name') == config('commanConfig.dyco_engineer') && $data->status->status_id != config('commanConfig.conveyance_status.forwarded'))
        <div class="m-portlet m-portlet--mobile m_panel">
            <div class="m-portlet__body">
                <div class="m-subheader" style="padding: 0;">
                    <div class="d-flex align-items-center justify-content-center">
                        <h4 class="section-title">
                            NOC for Conveyance
                        </h4>
                    </div>
                </div>     
                <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <form class="nav-tabs-form" id ="NOCFRM" role="form" method="POST" action="{{ route('dyco.save_noc')}}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                                    <div class="d-flex flex-column h-100 two-cols">
                                        <h5>Upload</h5>
                                        <span class="hint-text">Click to upload NOC</span>
                                            <input type="hidden"  id="oldNOC" name="oldNOC" value="{{ isset($data->NOC->document_path) ? $data->NOC->document_path : '' }}">
                                                <div class="custom-file">
                                                    <input class="custom-file-input stamp_letter" name="NOC" type="file" id="test-upload1">
                                                    <label class="custom-file-label" for="test-upload1">Choose
                                                        file...</label> 
                                                        @if(isset($data->NOC->document_path))

                                                        <a href="{{ config('commanConfig.storage_server').'/'.$data->NOC->document_path }}" class="btn-link" target="_blank"> Download </a> 
                                                     @endif       
                                                </div>
                                            <div class="mt-auto" style="margin-top: 14px !important">   
                                                <input type="submit" class="btn btn-primary" value="Submit">
                                             </div>                                
                                    </div>
                                </form>                             
                            </div>
                            <div class="col-sm-6 border-left">
                                <div class="d-flex flex-column h-100 two-cols">
                                    <h5>Send to Society</h5>
                                    <span class="hint-text">Send NOC to Society </span>
                                    <div class="mt-auto">
                                        <form class="nav-tabs-form" id ="agreementFRM" role="form" method="POST" action="{{ route('dyco.send_to_society')}}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">
                                                <input type="submit" class="s_btn btn btn-primary" id="submitBtn" value="Send to Society">
                                        </form>
                                        <span class="error" id="NOCError" style="display: none;color: #ce2323;margin-bottom: 17px;">
                                        *Note : Please Upload NOC.</span>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div> 
        </div>              
 @endif 

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

        @if($data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') )

        <form class="nav-tabs-form" id ="CommentFRM" role="form" method="POST" action="{{ route('conveyance.save_agreement_comments')}}">
            @csrf   
             <input type="hidden" name="application_id" value="{{ isset($data->id) ? $data->id : '' }}">
            <div class="m-portlet m-portlet--mobile m_panel">  
                <div class="m-portlet__body">   
                    <div class="col-xs-12 row">
                        <div class="col-md-12">
                            <h3 class="section-title section-title--small">Remark</h3>
                                <textarea rows="4" cols="63" name="remark"></textarea>
                                <button type="submit" class="btn btn-primary mt-3" style="display:block">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif     
 </form> 

</div>
@endsection
@section('js')
<script>
    $("#NOCFRM").validate({
        rules: {
            NOC: {
                extension: "pdf",
                required : true
            },            
        }, messages: {
            NOC: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            },            
        }
    });  

    $("#submitBtn").click(function(){
        
        var oldNOC = $("#oldNOC").val();
        if(oldNOC != ""){
            $("#NOCError").css("display","none"); 
            return true;           
        }else{
            $("#NOCError").css("display","block");
            return false;
        }
    });    
</script>
@endsection
