@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.ee_department.action_oc',compact('oc_application'))
@endsection
@section('css')
<style>
    .loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('/img/loading-spinner-blue.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
</style>
@endsection
@section('content')
<div class="loader" style="display:none;"></div>
@if(session()->has('success'))
<div class="alert alert-success display_msg">
   {{ session()->get('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-success display_msg">
   {{ session()->get('error') }}
</div>
@endif

<div class="custom-wrapper">
   <div class="col-md-12">
      <div class="d-flex">
         {{ Breadcrumbs::render('scrutiny-remark-ee-oc',$oc_application->id) }}
         <div class="ml-auto btn-list">
            <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
         </div>
      </div>
      <div id="tabbed-content" class="">
         <ul id="top-tabs" class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom tabs">
            <li class="nav-item m-tabs__item active" data-target="#ree-scrunity" id="section-1">
               <a class="nav-link m-tabs__link">
               <i class="la la-cog"></i>Scrutiny
               </a>
            </li>
         </ul>
         <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
            <div class="portlet-body">
               <div class="m-portlet__body m-portlet__body--table m-portlet__body--serial-no">
                  <div class="m-subheader">
                     <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                           Society Details:
                        </h3>
                     </div>
                     <div class="row field-row">
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Application Number:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->application_no ?
                              $arrData['society_detail']->application_no : '' }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Application Date:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->submitted_at ?
                              date(config('commanConfig.dateFormat'),
                              strtotime($arrData['society_detail']->submitted_at)) : ''}}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Registration No:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->registration_no }}</span>
                           </div>
                        </div>                        
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Name:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->name }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Society Address:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->address }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Building Number:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->building_no
                              }}</span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="m-subheader">
                     <div class="d-flex align-items-center">
                        <h3 class="section-title section-title--small">
                           Appointed Architect Details:
                        </h3>
                     </div>
                     <div class="row field-row">
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Name of Architect:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->name_of_architect
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Mobile Number:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->architect_mobile_no
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Address:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->architect_address
                              }}</span>
                           </div>
                        </div>
                        <div class="col-sm-6 field-col">
                           <div class="d-flex">
                              <span class="field-name">Architect Telephone Number:</span>
                              <span class="field-value">{{
                              $arrData['society_detail']->eeApplicationSociety->architect_telephone_no
                              }}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="tab-content">
            @php
            if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
            config('commanConfig.applicationStatus.forwarded')))
            { 
            $style = "display:none";
            $style1 = "display:none";
            $disabled='disabled';
            }
            elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
            { 
            $style = "display:none";
            $style1 = "display:none";
            $disabled='disabled';
            }
            else
            {
            $style = "";
            $style1 = "";
            $disabled="";
            }
            @endphp
            <div>
               <div class="m-portlet m-portlet--no-top-shadow">
                  <div class="tab-content">
                     <div>
                        <form class="form--custom" action="{{ route('ee.scrutiny_verification_oc') }}" method="post">
                           @csrf
                           <div class="table-checklist m-portlet__body m-portlet__body--table table--box-input">
                              <div class="table-responsive">
                                 <table class="table">
                                    <thead class="thead-default">
                                       <th>Sr.No</th>
                                       <th class="table-data--xl">Topics</th>
                                       <th>Yes</th>
                                       <th>No</th>
                                       <th>Comments</th>
                                    </thead>
                                    <tbody>
                                       @php
                                       $i = 1;
                                       @endphp
                                       <input type="hidden" name="society_id" value="{{ $arrData['society_detail']->id }}">
                                       <input type="hidden" name="application_id" id="application_id" value="{{ $oc_application->id }}">

                                       @foreach($arrData['scrutiny_questions_oc'] as
                                       $each_question)
                                       <input type="hidden" name="question_id[{{$i}}]" value="{{ $each_question->id }}">
                                       @php if(isset($each_question->is_compulsory) && $each_question->is_compulsory == '1'){
                                       $required = 'required';
                                       }
                                       else{
                                       $required = '';
                                       }
                                       @endphp
                                       {{--
                                       @php
                                       if(isset($arrData['scrutiny_answers_to_questions'][$each_question->id]))
                                       {
                                       $disabled='disabled';
                                       $style = "display:none";
                                       }else{
                                       if(session()->get('role_name') == config('commanConfig.ee_junior_engineer'))
                                       {
                                       $disabled='';
                                       $style = "";
                                       }
                                       }
                                       @endphp
                                       --}} 
                                       
                                       <tr>
                                          <td>{{ isset($each_question->group) && isset($each_question->sort_by) ? $each_question->group.'.'.$each_question->sort_by : $each_question->group }}</td>
                                          <td><p>{{ $each_question->question }}</p></td>
                                          <td>
                                             <label class="m-radio m-radio--primary">
                                             <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                             value="1" {{($each_question->is_compulsory == 1) ? 'required' : '' }}
                                             {{ (isset($arrData['scrutiny_answers_to_questions'][$each_question->id]) && $arrData['scrutiny_answers_to_questions'][$each_question->id]['answer'] == 1) ? 'checked' : '' }}>
                                             <span></span>
                                             </label>
                                          </td>
                                          @php
                                          if(isset($arrData['scrutiny_answers_to_questions'][$each_question->id]['answer'])
                                          &&
                                          $arrData['scrutiny_answers_to_questions'][$each_question->id]['answer']
                                          == 0)
                                          {
                                          $checked = 'checked';
                                          }
                                          else{
                                          $checked = '';
                                          }
                                          @endphp

                                          <td>
                                             <label class="m-radio m-radio--primary">
                                             <input {{$disabled}} type="radio" name="answer[{{$i}}]"
                                             value="0" {{ $checked }}>
                                             <span></span>
                                             </label>
                                          </td>
                                          <td>
                                             @if($each_question->remarks_applicable == 1)
                                             <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                             name="remark[{{$i}}]" id="remark-one">{{ isset($arrData['scrutiny_answers_to_questions'][$each_question->id]) ? $arrData['scrutiny_answers_to_questions'][$each_question->id]['remark'] : '' }}</textarea>
                                             @else
                                             {{'Not Applicable'}};
                                             @endif 
                                             @if($each_question->is_upload == 1)

                                             <input type="hidden" id="question_id" value="{{ isset($each_question) ? $each_question->id : '' }}">
                                                <div class="custom-file mt-3" style="{{$style}}">
                                                   <input class="custom-file-input file-upload" type="file" id="test-upload_{{$each_question->id}}" data-index = "{{$each_question->id}}" {{(isset($arrData['scrutiny_answers_to_questions'][$each_question->id]['document_path'])) ? '' : 'required' }}>
                                                   <label class="custom-file-label" for="test-upload_{{$each_question->id}}">Choose
                                                file...</label>
                                                <input type="hidden" id="document_{{$each_question->id}}" name="document_path[{{$i}}]" value="{{isset($arrData['scrutiny_answers_to_questions'][$each_question->id]['document_path']) ? isset($arrData['scrutiny_answers_to_questions'][$each_question->id]['document_path']) : '' }}"> 
                                                @php
                                                if(isset($arrData['scrutiny_answers_to_questions'][$each_question->id]['document_path'])){
                                                   $displayFile = "display:block";
                                                }else{
                                                   $displayFile = "display:none";
                                                }

                                                @endphp
                                                <span class="text-danger file_error_{{$each_question->id}}"></span>
                                                
                                                </div>
                                                 <a target="_blank" class="btn-link" id="file_{{$each_question->id}}" href="{{isset($arrData['scrutiny_answers_to_questions'][$each_question->id]['document_path']) ? config('commanConfig.storage_server').'/'.$arrData['scrutiny_answers_to_questions'][$each_question->id]['document_path'] : ''}}" style="{{$displayFile}}" download >Download</a>
                                          @endif
                                          </td>
               
                                       </tr>
                                       @php
                                       $i++;
                                       @endphp
                                       @endforeach
                                       <tr>
                                          <td colspan="2">Additional Remarks (If any)</td>
                                          <td colspan="3">
                                             <textarea {{$disabled}} class="form-control form-control--custom form-control--textarea"
                                             name="ee_additional_remarks" id="remark-one">{{ isset($oc_application->ee_additional_remarks) ? $oc_application->ee_additional_remarks : '' }}</textarea>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <button type="submit" style="{{ $style }}" class="btn btn-primary saveBtn" next_tab = "nested_tab_2">Save</button>
                           @if(isset($arrData['scrutiny_answers_to_questions']) && count($arrData['scrutiny_answers_to_questions']) > 0)
                              <a href="{{ route('ee.oc_ee_variation_report',$oc_application->id)}}" class="btn btn-primary">Generate Variation Report</a>
                           @endif
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="tab-pane" id="three" aria-expanded="false">
               three
               </div> -->
            @php
            if(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id ==
            config('commanConfig.applicationStatus.forwarded')))
            $display = "display:none";
            elseif (session()->get('role_name') != config('commanConfig.ee_junior_engineer'))
            $display = "display:none";
            else
            $display = "";
            @endphp
            <div>
               <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                  <div class="portlet-body">
                     <div class="m-portlet__body m-portlet__body--table">
                        <div class="m-subheader" style="padding: 0;">
                           <div class="d-flex">
                              <h3 class="section-title">
                                 Note
                              </h3>
                           </div>
                        </div>
                        <div class="m-section__content mb-0 table-responsive">
                                 
                                 <!-- <div class="col-sm-6">
                                    <div class="d-flex flex-column h-100 two-cols">
                                       <h5>Download Note</h5>
                                       <div class="mt-auto">
                                          <a target="_blank" href="{{ config('commanConfig.storage_server').'/'.$oc_application->ee_office_note_oc}} ">
                                          <button class="btn btn-primary">
                                          Download EE Note</button>
                                          </a>
                                       </div>
                                    </div>
                                 </div> -->
                                 <div class="col-sm-6" style="{{ $display }}">
                                    <div class="d-flex flex-column h-100 two-cols">
                                       <h5>Upload Note</h5>
                                       <span class="hint-text">Click on 'Upload' to upload EE Note</span>
                                       <form action="{{ route('ee.upload_office-note-oc') }}" method="post"
                                          enctype="multipart/form-data" style="margin-left: -2%;">
                                          @csrf
                                          <input type="hidden" name="application_id" value="{{ $oc_application->id }}">
                                          <div class="custom-file">
                                             <input class="custom-file-input" name="ee_office_note_oc" type="file"
                                                id="test-upload" required="">
                                             <label class="custom-file-label" for="test-upload">Choose
                                             file...</label>
                                          </div>
                                          <span class="text-danger" id="file_error"></span>
                                          <div class="mt-auto">
                                             <button type="submit" style="{{ $style1 }}" class="btn btn-primary btn-custom upload_note"
                                                id="uploadBtn">Upload</button>
                                          </div>
                                       </form>
                                    </div> 
                                 </div>
                        </div>
                        @if(isset($arrData['eeNote']) && count($arrData['eeNote']) > 0)
                        <div class="m-section__content mb-0 table-responsive" style="margin-top: 30px">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="d-flex flex-column h-100 two-cols">
                                            <h5>Download EE Note</h5>
                                               
                                                    <div class="table-responsive">
                                                    <table class="mt-2 table table-hover" id="dtBasicExample"> 
                                                    <thead>
                                                        <tr>
                                                            <th>Document Name</th>
                                                            <th class="text-center">Download</th>
                                                            <th class="text-center" style="{{$style}}">Delete</th>   
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    @foreach($arrData['eeNote'] as $note)  
                                                        <tr>
                                                            <td>                                                                    @php
                                                        if($note->document_name){
                                                            $fileName = explode(".",$note->document_name)[0]; 
                                                        }elseif($note->document_path){
                                                            $fileName = explode(".",explode('/',$note->document_path)[1])[0];
                                                        }
                                                        @endphp 

                                                        {{ isset($fileName) ? $fileName : ''}} 
                                                            </td>
                                                            <td class="text-center">
                                                                <a class="btn-link" download href="{{ config('commanConfig.storage_server').'/'.$note->document_path}} " target="_blank" download>
                                                        Download </a> 
                                                            </td>
                                                            <td class="text-center" style="{{$style}}">
                                                                <i class="fa fa-close icon2 d-icon hide-print" id="{{ isset($note->id) ? $note->id : '' }}" onclick="removeDocuments(this.id)"></i>
                                                                <input type="hidden" name= "oldFile" id="oldFile_{{$note->id}}" value="{{ isset($note->document_path) ? $note->document_path : '' }}"> 
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>    
                                                    </table>

                                                @elseif(isset($arrData['get_last_status']) && ($arrData['get_last_status']->status_id == config('commanConfig.applicationStatus.forwarded')))
                                                <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                    * Note : EE note not available. </span>
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
      </div>
   </div>
</div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script>
   $(".editDocumentStatus, .deleteDocumentStatus").on("click", function () {
       var documentstatusid = $(this).attr('data-documentstatusid');
       var id = $(this).attr('data-id');
       $.ajax({
           type: "POST",
           url: "{{ route('get-ee-scrutiny-data') }}",
           data: {
               "_token": "{{ csrf_token() }}",
               "documentStatusId": documentstatusid,
           },
           cache: false,
           success: function (res) {
               $("#comment_by_EE_" + id).val(res.comment_by_EE);
               $("#oldFileName_" + id).val(res.EE_document_path);
   
               $("#fileName_" + id).val(res.EE_document_path);
           }
       });
   });
   
   //        $("#demarcation_date, #tit_bit_date").datepicker();
   
   $(".submt_btn").click(function () {
       var id = this.id.substr(10, 2);
       console.log(id);
       myfile = $("#EE_document_path_" + id).val();
       var ext = myfile.split('.').pop();
       console.log(ext);
       if (myfile != '') {
           if (ext != "pdf") {
               $("#file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
               return false;
           } else {
               $("#file_error_" + id).text("");
               return true;
           }
       } 
       // else {
       //     $("#file_error_" + id).text("This field required");
       //     return false;
       // }
   });
   
   $(".edit_btn").click(function () {
       var id = this.id.substr(8, 2);
       myfile = $("#EE_document_" + id).val();
       var ext = myfile.split('.').pop();
   
       if (myfile != '') {
           if (ext != "pdf") {
               $("#edit_file_error_" + id).text("Invalid type of file uploaded (only pdf allowed).");
               return false;
           } else {
               $("#edit_file_error_" + id).text("");
               return true;
           }
        } 
        // else {
       //     $("#edit_file_error_" + id).text("This field required");
       //     return false;
       // }
   });
   
   $(".upload_note").click(function () {
       myfile = $("#test-upload").val();
       var ext = myfile.split('.').pop();
       if (myfile != '') {
   
           if (ext != "pdf") {
               $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
               return false;
           } else {
               $("#file_error").text("");
               return true;
           }
       } else {
           $("#file_error").text("This field required");
           return false;
       }
   });

   $(".file-upload").change(function(){
      var questionId = $(this).attr('data-index');
      var myfile = $(this).val();
      console.log(myfile);
      var ext = myfile.split('.').pop();
      if (ext == "pdf"){
          $(".loader").show();
          var fileData = $(this).prop('files')[0];
          var applicationId = $("#application_id").val();
          
          var form_data = new FormData();
          form_data.append('file', fileData);  
          form_data.append('application_id', applicationId);  
          form_data.append('question_id', questionId);  
          form_data.append('_token', document.getElementsByName("_token")[0].value);

          $.ajax({
              url: "/upload_oc_scrutiny_documents", // point to server-side PHP script
              data: form_data,
              type: 'POST',
              contentType: false, // The content type used when sending data to the server.
              cache: false, // To unable request pages to be cached
              processData: false,
              success: function(result) {
               var  res = JSON.parse(result);
               console.log(res);
               if (res.status == 'success'){
                  $(".file_error_"+questionId).text("");
                  $("#file_"+questionId).css("display","block")
                  $("#file_"+questionId).attr("href", res.data);
                  $("#document_"+questionId).val(res.filePath);
               }
                  $(".loader").hide();
                  // if(data == 'success')
                      // $("#file_error_"+id).css("display","none");
              }
          });
      }else{
         $(".file_error_"+questionId).text("Invalid type of file uploaded (only pdf allowed).");
      }
   });

   function removeDocuments(id) {
     
        var oldFile = $("#oldFile_"+id).val();
        var form_data = new FormData();
        form_data.append('id', id);
        form_data.append('oldFile', oldFile);
        form_data.append('_token', document.getElementsByName("_token")[0].value);
        $(".loader").show();
   
            $.ajax({
                url: "/delete_oc_note",
                data: form_data,
                type: 'POST',
                contentType: false, 
                cache: false, 
                processData: false,
                success: function(data) {
                    console.log(data);
                    $(".loader").hide();
                    if (data == 'success'){
                        location.reload();
                    }
                }
            })        
    }

   $(document).ready(function () {
      $('#dtBasicExample').DataTable();
      $('.dataTables_length').addClass('bs-select');

      $('#dtBasicExample_wrapper > .row:first-child').remove();
    });  

    $('#dtBasicExample').dataTable({searching: false, ordering:false, info: false});
   
</script>
@endsection