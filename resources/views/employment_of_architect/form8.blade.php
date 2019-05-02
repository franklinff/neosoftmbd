@extends('admin.layouts.sidebarAction')
@section('actions')
@include('employment_of_architect.actions',compact('application'))
@endsection
@section('content')

<div class="col-md-12">
    <div class="d-flex form-steps-wrap">
            <a href="{{ route("appointing_architect.step1",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 1<span>Basic Details</span></a>
            <a href="{{ route("appointing_architect.step2",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 2<span>Enclosures</span></a>
            <a href="{{ route("appointing_architect.step3",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 3<span>Details of Consultants</span></a>
            <a href="{{ route("appointing_architect.step4",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 4<span>Important Projects</span></a>
            <a href="{{ route("appointing_architect.step5",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 5<span>Work Handled</span></a>
            <a href="{{ route("appointing_architect.step6",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 6<span>Details of Firm</span></a>
            <a href="{{ route("appointing_architect.step7",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 7<span>Work In Hand</span></a>
            <a href="{{ route("appointing_architect.step8",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab active">Step 8<span>Works Completed</span></a>
            <a href="{{ route("appointing_architect.step9",['id'=>encrypt($application->id)]) }}" class="btn--unstyled flex-grow-1 form-step-tab ">Step 9<span>Supporting Documents</span></a>
    </div>
    <div id="accordion" class="mt-4">
        @php
        $prev_form_number=old('form_number')?old('form_number'):1;
        @endphp
    <h3 class="section-title section-title--small mb-4">&nbsp;</h3>
{{-- <h3 class="section-title section-title--small mb-4">PROJECT DETAIL SHEET - WORK COMPLETED</h3> --}}
        {{-- <h3 class="section-title section-title--small mb-4">Name of Applicant: {{$application->name_of_applicant}}</h3> --}}

        @php
        $project_count=$application->project_sheets->count();
        @endphp

        @if($prev_form_number>$project_count)
        @php $project_count=($prev_form_number-$project_count)+$project_count @endphp
        @endif

        @if($project_count>1)
        @php $k=($project_count-1); @endphp
        @else
        @php $k=0; @endphp
        @endif


        @for($j=0;$j<(1+$k);$j++) <div class="m-portlet m-portlet--compact form-accordion m-portlet--forms-compact">
            <div class="d-flex justify-content-between align-items-center form-steps-toplinks">
                <a class="btn--unstyled section-title section-title--small form-count-title d-flex justify-content-between collapsed" data-toggle="collapse"
                    href="#form_{{$j+1}}"><span class="form-accordion-title">Project {{$j+1}}:</span><span class="accordion-icon"></span></a>
                @if($j>=1)
                <h2 class='m--font-danger ml-3 mb-0'><i title='Delete' class='fa fa-remove'></i></h2>
                @endif
            </div>
            <form role="form" method="post" class="m-form m-form--rows m-form--label-align-right form-steps-box floating-labels-form" action="{{route('appointing_architect.step8_post',['id'=>encrypt($application->id)])}}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="form_number" value="{{$j+1}}">
                <input type="hidden" name="application_id" value="{{$application->id}}" class="one">
                <input type="hidden" name="project_sheet_detail_id" value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->id:''}}">
                <div class="m-portlet__body m-portlet__body--spaced collapse form-count {{$prev_form_number==$j+1?'show':''}}"
                    id="form_{{$j+1}}" data-parent="#accordion">
                    <div class="m-form__group row align-items-end">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name_of_project_{{$j}}">Name of Project<span class="star">*</span></label>
                            <input type="text" id="name_of_project_{{$j}}" name="name_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->name_of_project:old('name_of_project')}}">
                            @if ($errors->has('name_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('name_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="location_{{$j}}">Location<span class="star">*</span></label>
                            <input type="text" id="location_{{$j}}" name="location" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->location:old('location')}}">
                            @if ($errors->has('location') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('location')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name_of_client_{{$j}}">Name of Client<span class="star">*</span></label>
                            <input type="text" id="name_of_client_{{$j}}" name="name_of_client" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->name_of_client:old('name_of_client')}}">
                            @if ($errors->has('name_of_client') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('name_of_client')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="address_{{$j}}">Address<span class="star">*</span></label>
                            <input type="text" id="address_{{$j}}" name="address" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->address:old('address')}}">
                            @if ($errors->has('address') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('address')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="tel_no_{{$j}}">Phone Number<span class="star">*</span></label>
                            <input onkeypress="return isNumberKey(event)" type="text" id="tel_no_{{$j}}" name="tel_no" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->tel_no:old('tel_no')}}">
                            @if ($errors->has('tel_no') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('tel_no')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group focused">
                        <label class="col-form-label mhada-label-index" for="extract_{{$j}}">Upload copy of agreement:
                                <!--<span class="star">*</span>--></label>
                            <div class="custom-file">
                                @php
                                $file="";
                                $file=isset($application->project_sheets[$j])?$application->project_sheets[$j]->copy_of_agreement:'';
                                @endphp
                                <input accept="pdf" title="please upload file with pdf extension" {{ $file!=""?"":"required" }} type="file" id="extract_{{$j}}" name="copy_of_agreement" class="custom-file-input">
                                <label title="" class="custom-file-label" for="extract_{{$j}}">Choose File...</label>
                                <span class="help-block"></span>
                                
                                <a style="display:{{$file!=''?'block':'none'}}" target="_blank" class="btn-link" href="{{config('commanConfig.storage_server').'/'.$file}}">download</a>
                            </div>
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="built_up_area_in_sq_m_{{$j}}">Build Up Area in m<sup>2</sup><span class="star">*</span></label>
                            <input onkeypress="return isNumberKey(event)" type="text" id="built_up_area_in_sq_m_{{$j}}" name="built_up_area_in_sq_m" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->built_up_area_in_sq_m:old('built_up_area_in_sq_m')}}">
                            @if ($errors->has('built_up_area_in_sq_m') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('built_up_area_in_sq_m')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="land_area_in_sq_m_{{$j}}">Land Area in m<sup>2</sup><span class="star">*</span></label>
                            <input onkeypress="return isNumberKey(event)" type="text" id="land_area_in_sq_m_{{$j}}" name="land_area_in_sq_m" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->land_area_in_sq_m:old('land_area_in_sq_m')}}">
                            @if ($errors->has('land_area_in_sq_m') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('land_area_in_sq_m')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="estimated_value_of_project_{{$j}}">Estimated Value of Projects in Rs<span class="star">*</span></label>
                            <input onkeypress="return isNumberKey(event)" type="text" id="estimated_value_of_project_{{$j}}" name="estimated_value_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->estimated_value_of_project:old('estimated_value_of_project')}}">
                            @if ($errors->has('estimated_value_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('estimated_value_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="completed_value_of_project_{{$j}}">Completed Value of Projects in Rs<span class="star">*</span></label>
                            <input onkeypress="return isNumberKey(event)" type="text" id="completed_value_of_project_{{$j}}" name="completed_value_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->completed_value_of_project:old('completed_value_of_project')}}">
                            @if ($errors->has('completed_value_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('completed_value_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="date_of_start_{{$j}}">Date of Start<span class="star">*</span></label>
                            <input type="text" id="date_of_start_{{$j}}" name="date_of_start" class="form-control form-control--custom m_datepicker"
                                readonly value="{{isset($application->project_sheets[$j])?date('d-m-Y',strtotime($application->project_sheets[$j]->date_of_start)):old('date_of_start')}}">
                            @if ($errors->has('date_of_start') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('date_of_start')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="date_of_completion_{{$j}}">Date of Completion<span class="star">*</span></label>
                            <input type="text" id="date_of_completion_{{$j}}" name="date_of_completion" class="form-control form-control--custom m_datepicker"
                                readonly value="{{isset($application->project_sheets[$j])?date('d-m-Y',strtotime($application->project_sheets[$j]->date_of_completion)):old('date_of_completion')}}">
                            @if ($errors->has('date_of_completion') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('date_of_completion')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="whether_service_terminated_by_client_{{$j}}">Whether Service Terminated by Client<span class="star">*</span></label>
                            <input type="text" id="whether_service_terminated_by_client_{{$j}}" name="whether_service_terminated_by_client" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->whether_service_terminated_by_client:old('whether_service_terminated_by_client')}}">
                            @if ($errors->has('whether_service_terminated_by_client') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('whether_service_terminated_by_client')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="salient_features_of_project_{{$j}}">Salient Features of Project<span class="star">*</span></label>
                            <input type="text" id="salient_features_of_project_{{$j}}" name="salient_features_of_project" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->salient_features_of_project:old('salient_features_of_project')}}">
                            @if ($errors->has('salient_features_of_project') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('salient_features_of_project')
                                }}</span>
                            @endif
                        </div>
                        <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="reason_for_delay_if_any_{{$j}}">Reasons for Delay (If any)<span class="star">*</span></label>
                            <input type="text" id="reason_for_delay_if_any_{{$j}}" name="reason_for_delay_if_any" class="form-control form-control--custom m-input"
                                value="{{isset($application->project_sheets[$j])?$application->project_sheets[$j]->reason_for_delay_if_any:old('reason_for_delay_if_any')}}">
                            @if ($errors->has('reason_for_delay_if_any') && $prev_form_number==$j+1)
                            <span class="text-danger">{{ $errors->first('reason_for_delay_if_any')
                                }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        
                    </div>
                    <div class="form-group m-form__group row">
                        
                    </div>
                    <div class="form-group m-form__group row">
                        
                    </div>
                    <div class="form-group m-form__group row">
                        
                    </div>
                    <div class="form-group m-form__group row">
                        
                    </div>
                    <div class="form-group m-form__group row">
                        
                    </div>
                    <div class="form-group m-form__group row">
                        
                    </div>
                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit" style="padding-top: 300px">
                        <div class="m-form__actions px-0">
                            <div class="btn-list">
                                <input type="submit" id="" class="btn btn-primary" name="Save">
                                <a href="" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
    @endfor
</div>
<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
    <div class="m-form__actions p-0">
        <div class="btn-list d-flex justify-content-between align-items-center">
            <a id="add-more" class="btn--add-delete add">add more<a>
           
            <a href="{{route('appointing_architect.step9',['id'=>encrypt($application->id)])}}" id="" class="btn btn-primary">Next</a>
        </div>
    </div>
</div>
</div>

@endsection


@section('js')
<script>
    $(document).ready(function () {
        //document.querySelector(".m-portlet__body").classList.add("show");

        function showUploadedFile() {
            $('.custom-file-input').change(function (e) {
                $(this).parents('.custom-file').find('.custom-file-label').text(e.target.files[0].name);
            });
        }


        $('#add-more').click(function (e) {
            e.preventDefault();
            var formAccordion = $("#accordion .form-accordion:first").clone();
            var formAccordionCount = $("#accordion").find('.form-accordion').length+1;
            var formAccordionInputHidden = formAccordion.find("input").filter(
                function (index, item) {
                    if (item.name !== 'application_id' && item.name !== '_token' && item.type !==
                        'submit') {
                        item.value = '';
                        var temp1=item.id;
                        formAccordion.find("input[id='"+temp1+"']")[0].setAttribute('value','');
                        
                    }
                    if(item.type!='hidden' && item.type!='submit')
                    {
                        var temp=item.id;
                        var temp_index=temp.split("_").pop(-1);
                        updated_temp=temp.replace('_'+temp_index, '_'+formAccordionCount);
                        item.setAttribute('id',updated_temp)
                        formAccordion.find("label[for='"+temp+"']")[0].setAttribute('for',updated_temp);
                       // console.log(v)
                    }
                    
                });

            formAccordion.find(".form-steps-toplinks").append("<h2 class='m--font-danger ml-3 mb-0'><i title='Delete' class='fa fa-remove'></i></h2>");

            
            var newID = 'form_' + formAccordionCount;

            formAccordion.find("input[name='form_number']")[0].value = formAccordionCount

            var formAccordionNumber = formAccordion.find('.form-count-title')[0];
            formAccordionNumber.classList.remove("collapsed");
            formAccordionNumber.setAttribute("href", "#" + newID);

            var formAccordionTitle = formAccordion.find('.form-accordion-title')[0];
            formAccordionTitle.textContent = "Project " + formAccordionCount + ":";

            var file_input = formAccordion.find('.custom-file-input')[0];
            file_input.setAttribute('id', 'extract_' + formAccordionCount)
            file_input.setAttribute('required', 'required');
            var file_label = formAccordion.find('.custom-file-label')[0];
            file_label.setAttribute('for', 'extract_' + formAccordionCount);
            var download_link = formAccordion.find('.btn-link')[0];
            download_link.setAttribute('style', 'display:none;');

            var formAccordionCount = formAccordion.find('.form-count')[0];
            formAccordionCount.setAttribute("id", newID);

            var formAccordionShow = formAccordion.find('.form-count')[0];
            var changed_class_name_for_show = formAccordionShow.getAttribute('class');
            formAccordionShow.setAttribute('class', changed_class_name_for_show + ' show')

            formAccordion.insertAfter("#accordion .form-accordion:last");

             formAccordion.find('form').each(function() {  // attach to all form elements on page
                var form=$(this)
                form.validate({       // initialize plugin on each form
                    rules: {
                    name_of_project: "required",
                    location:"required",
                    name_of_client:"required",
                    address:"required",
                    tel_no:{
                        required:true,
                        number:true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    built_up_area_in_sq_m:{
                        required:true,
                        number:true
                    },
                    land_area_in_sq_m:{
                        required:true,
                        number:true
                    },
                    estimated_value_of_project:{
                        required:true,
                        number:true
                    },
                    completed_value_of_project:{
                        required:true,
                        number:true
                    },
                    date_of_start:"required",
                    date_of_completion:"required",
                    whether_service_terminated_by_client:"required",
                    salient_features_of_project:"required",
                    reason_for_delay_if_any:"required"
                    }
                });
            });

            showUploadedFile();

            $(".m_datepicker").datepicker({
                todayHighlight: !0,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                },
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
            
            removeAccordion();
        });

        function removeAccordion() {
            if($('.form-steps-toplinks')) {
                $('.form-steps-toplinks').on('click', '.fa-remove', function(e) {
                    var delete_id=$(this).closest('.form-steps-toplinks').next('form').find("input[name='project_sheet_detail_id']")[0].value;
                    //$(this)[0].closest('.form-accordion').remove();
                    if(delete_id!="")
                    {
                        if(confirm('are you sure?'))
                        {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-Token': '{{csrf_token()}}'
                                }
                            });
                            var thisInstance=$(this);
                            $.ajax({
                                url:"{{route('appointing_architect.delete_project_sheet_detail')}}",
                                method:'POST',
                                data:{delete_imp_project_id:delete_id},
                                success:function(data){
                                    if(data.status==0)
                                    {
                                        thisInstance[0].closest('.form-accordion').remove();
                                    }else
                                    {
                                        alert('something went wrong');
                                    }
                                }
                            })
                        }
                    }else
                    {
                        $(this)[0].closest('.form-accordion').remove();
                    }


                });
            }
        }

        removeAccordion();
    });

    $(document).ready(function() {

$('form').each(function() {  // attach to all form elements on page
    var form=$(this)
    form.validate({       // initialize plugin on each form
        rules: {
          name_of_project: "required",
          location:"required",
          name_of_client:"required",
          address:"required",
          tel_no:{
                        required:true,
                        number:true,
                        minlength: 10,
                        maxlength: 10,
                    },
          built_up_area_in_sq_m:{
                        required:true,
                        number:true
                    },
          land_area_in_sq_m:{
                        required:true,
                        number:true
                    },
          estimated_value_of_project:{
                        required:true,
                        number:true
                    },
          completed_value_of_project:{
                        required:true,
                        number:true
                    },
          date_of_start:"required",
          date_of_completion:"required",
          whether_service_terminated_by_client:"required",
          salient_features_of_project:"required",
          reason_for_delay_if_any:"required"
        }
    });
});
});
function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode != 46 && charCode > 31 
        && (charCode < 48 || charCode > 57))
            return false;

        return true;
    }
</script>
@endsection
