@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.conveyance.'.$data->folder.'.action')
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
                Sale & Lease Deed Agreement</h3>
                 {{ Breadcrumbs::render('conveyance_draft_sale_lease',$data->id) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
        </div>
    </div> 
        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link active show" data-toggle="tab" href="#sale-deed-agreement" role="tab"
                    aria-selected="false">
                    <i class="la la-cog"></i> Sale Deed Agreement
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#lease-deed-agreement" role="tab"
                    aria-selected="true">
                    <i class="la la-bell-o"></i> Lease Deed Agreement
                </a>
            </li>
        </ul>
    </div>

@php 
    if(isset($data->SignSaleAgreement->document_path)){
        $document = $data->SignSaleAgreement->document_path;
    }
    else if(isset($data->DraftSaleAgreement->document_path)) {
        $document = $data->DraftSaleAgreement->document_path;

    } else if(isset($data->DraftGeneratedSale->document_path)) {
        $document = $data->DraftGeneratedSale->document_path;
    } 

    if(isset($data->SignLeaseAgreement->document_path))  
        $document1 = $data->SignLeaseAgreement->document_path;
    else if(isset($data->DraftLeaseAgreement->document_path)) 
        $document1 = $data->DraftLeaseAgreement->document_path; 
    else if(isset($data->DraftGeneratedLease->document_path)) 
        $document1 = $data->DraftGeneratedLease->document_path;    

@endphp    


<input type="hidden" name="applicationId" value="{{ isset($data->id) ? $data->id : '' }}">    
    <div class="tab-content">
        <div class="tab-pane active show" id="sale-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download</h5>
                                            <span class="hint-text">Click to download Sale Deed Agreement </span>
                                            <div class="mt-auto">
                                                @if(isset($document))
                                                <input type="hidden" name="oldSaleFile" value="{{ isset($data->SignSaleAgreement) ? $data->SignSaleAgreement->document_path : '' }}">
                                                <a href="{{ config('commanConfig.storage_server').'/'.$document }}" target="_blank">
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Sale Deed Agreement is not available.</span>
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

            <!-- Add Send to JT CO here -->
        </div>

        <div class="tab-pane" id="lease-deed-agreement" role="tabpanel">
            <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                <div class="portlet-body">
                    <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-section__content mb-0 table-responsive">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download </h5>
                                            <span class="hint-text">Click to download Lease Deed Agreement</span>
                                            <div class="mt-auto">
                                                @if(isset($document1))
                                                <input type="hidden" name="oldLeaseFile" value="{{ isset($data->SignLeaseAgreement) ? $data->SignLeaseAgreement->document_path : '' }}">
                                                <a href="{{ config('commanConfig.storage_server').'/'.$document1 }}" target="_blank"> 
                                                <Button type="button" class="s_btn btn btn-primary" id="submitBtn">
                                                        Download </Button>
                                                </a>
                                                @else
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    *Note : Lease Deed Agreement is not available.</span>
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
<!-- </form> -->

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

    @if($data->riders)
        <div class="m-portlet m-portlet--mobile m_panel">  
            <div class="m-portlet__body">   
                <div class="col-xs-12 row">
                    <div class="col-md-12">
                        <h3 class="section-title section-title--small">Riders</h3>
                        <textarea rows="4" cols="63" name="remark" readonly>{{ isset($data->riders) ? $data->riders : '' }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    @endif 
 
    @if($data->status->status_id != config('commanConfig.conveyance_status.forwarded') && $data->status->status_id != config('commanConfig.conveyance_status.reverted') )

    <form class="nav-tabs-form" id ="CommentFRM" role="form" method="POST" action="{{ route('conveyance.save_agreement_comments')}}">
        @csrf          
        <div class="m-portlet m-portlet--mobile m_panel">  
         <input type="hidden" name="application_id" value="{{ isset($data->id) ? $data->id : '' }}">
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
      
@endsection
@section('js')
<script>
    $("#agreementFRM").validate({
        rules: {
            sale_agreement: {
                extension: "pdf"
            },            
            lease_agreement: {
                extension: "pdf"
            },
        }, messages: {
            sale_agreement: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            },            
            lease_agreement: {
                extension: "Invalid type of file uploaded (only pdf allowed)."
            }
        }
    });  
</script>
@endsection
