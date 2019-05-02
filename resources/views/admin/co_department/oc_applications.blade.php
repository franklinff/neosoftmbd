@extends('admin.layouts.app')
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
         <h3 class="m-subheader__title m-subheader__title--separator">Application for Consent for OC</h3>
         {{ Breadcrumbs::render('co_consent_oc') }}
      </div>
   </div>
   <div class="m-portlet m-portlet--compact filter-wrap">
      <div class="row--filter">
         <div class="col-md-12">
            <form role="form" id="noc_applications_form" method="get" class="form-group m-form__group row align-items-end mb-0"
               action="{{ route('co_applications.consent_oc') }}">
               <!--                                 <div class="col-md-3">
                  <label for="exampleSelect1">Search</label>
                  <div class="m-input-icon m-input-icon--left">
                      <input type="text" class="form-control form-control--custom m-input" placeholder="Search..."
                          id="m_form_search">
                      <span class="m-input-icon__icon m-input-icon__icon--left">
                          <span>
                              <i class="la la-search"></i>
                          </span>
                      </span>
                  </div>
                  </div> -->
               <div class="row align-items-center">
                  <div class="col-md-2">
                     <div class="form-group m-form__group">
                        <input type="text" id="submitted_at_from" name="submitted_at_from" class="form-control form-control--custom m-input m_datepicker"
                           placeholder="From Date" readonly value="{{ isset($getData['submitted_at_from'])? $getData['submitted_at_from'] : '' }}">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group m-form__group">
                        <input type="text" id="submitted_at_to" name="submitted_at_to" class="form-control form-control--custom m-input m_datepicker"
                           placeholder="To Date" readonly value="{{ isset($getData['submitted_at_to'])? $getData['submitted_at_to'] : '' }}">
                     </div>
                  </div>
                  @php
                  $status = isset($getData['update_status'])? $getData['update_status'] : '';
                  @endphp
                  <div class="col-md-3">
                     <div class="form-group m-form__group">
                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                           id="update_status" name="update_status">
                           <option value="">Select Status</option>
                           @foreach(config('commanConfig.applicationStatus') as $key =>
                           $application_status)
                           <option value="{{ $application_status }}"
                           {{ ($status == $application_status) ? 'selected' : '' }}>{{
                           ucwords(str_replace('_', ' ', $key)) }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group m-form__group">
                        <div class="btn-list">
                           <button type="submit" class="btn m-btn--pill m-btn--custom btn-primary">Search</button>
                           <button type="reset" onclick="window.location.href='{{ url("/co_consent_oc_applications") }}'" class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <!-- END: Subheader -->
   <div class="m-portlet m-portlet--compact m-portlet--mobile">
      <div class="m-portlet__body">
         <!--begin: Datatable -->
         {!! $html->table() !!}
         <!--end: Datatable -->
      </div>
   </div>
   <input type="hidden" id="myModalBtn" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" />
   <!-- Modal -->
   <div id="myModal" class="modal fade" role="dialog">
   </div>
   <!-- END EXAMPLE TABLE PORTLET-->
</div>
@endsection
@section('datatablejs')
{!! $html->scripts() !!}
<script>
   /*$("#update_status").on("change", function () {
       $("#eeForm").submit();
   });*/
   
   $(document).ready(function () {
       $(".display_msg").delay(5000).slideUp(300);
   });
   
</script>
@endsection