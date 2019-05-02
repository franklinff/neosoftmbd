@extends('frontend.layouts.sidebarAction')
@section('actions')
    @include('frontend.society.actions',compact('ol_applications'))
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Redevelopment Application Form</h3>
                {{ Breadcrumbs::render('society_offer_letter_edit',$ol_applications->id) }}&nbsp;({{ $ol_application->ol_application_master->model }})
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

            <form id="save_offer_letter_application_dev" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('society_offer_letter_update') }}">
                @csrf
                <input type="hidden" name="applicationId" value="{{ isset($ol_applications->id) ? $ol_applications->id : '' }}">
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label mhada-multiple-label" for="preceding_officer_name">Department: <span class="star">*</span></label>
                            {{-- <input type="text" id="department_name" name="department_name" class="form-control form-control--custom m-input" value="EE" readonly> --}}
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" data-live-search="true" id="department_name" name="department_name" required>
                                <option value="">Select</option>
                                <!-- ee division set by EEDivisionComposer -->
                                @foreach($ee_divisions as $ee_division)
                                    <option {{($ol_application->department!=''?$ol_application->department->id:'')==$ee_division->id?'selected':''}} value="{{ $ee_division->id }}">{{ $ee_division->division }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="application_master_id" value="{{ $id }}">
                            <input type="hidden" name="request_form_id" value="{{ $ol_application->request_form->id }}">
                            <span class="help-block">{{$errors->first('department_name')}}</span>
                        </div>
                        
                    </div>
                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="application_type_id">Layout:
                            <span class="star">*</span> </label>
                            <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" data-live-search="true" id="layouts" name="layout_id" required>
                                @foreach($layouts as $layout)
                                    @if(isset($ol_applications) && $ol_applications->layout_id == $layout['id'])
                                        <option value="{{ $layout['id'] }}" selected>{{ $layout['layout_name'] }}</option>
                                    @else
                                        <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('application_type_id')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="case_year">Building No:</label>
                            <input type="text" id="building_no" name="building_no" class="form-control form-control--custom m-input" value="{{ $society_details->building_no }}" readonly>
                            <span class="help-block">{{$errors->first('building_no')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name">Society Name:</label>
                            <input type="text" id="name" name="name" class="form-control form-control--custom m-input" value="{{ $society_details->name }}" readonly>
                            <span class="help-block">{{$errors->first('name')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="address">Society Address:</label>
                            <textarea id="address" name="address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>
                            <span class="help-block">{{$errors->first('address')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="date_of_meeting">Resolution Date: <span class="star">*</span></label>
                            <input type="text" id="m_datepicker" name="date_of_meeting" class="form-control form-control--custom m-input m_datepicker" value="{{ date(config('commanConfig.dateFormat'), strtotime($ol_application->request_form->date_of_meeting)) }}" readonly>
                            <span class="help-block">{{$errors->first('date_of_meeting')}}</span>
                        </div>
                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="resolution_no">Resolution No:
                            <span class="star">*</span></label>
                            <input type="text" id="resolution_no" name="resolution_no" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $ol_application->request_form->resolution_no }}">
                            <span class="help-block">{{$errors->first('resolution_no')}}</span>
                        </div>
                    </div>

                    <div class="m-form__group row mhada-lease-margin">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="architect_name">Architect Name:</label>
                            <input type="text" id="architect_name" name="architect_name" class="form-control form-control--custom m-input" value="{{ $ol_application->request_form->architect_name }}">
                            <span class="help-block">{{$errors->first('architect_name')}}</span>
                        </div>
                        @if($id == '13' || $id == '17')
                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="developer_name">Developer Name:</label>
                                <input type="text" id="developer_name" name="developer_name" class="form-control form-control--custom form-control--fixed-height m-input" value="{{ $ol_application->request_form->developer_name }}">
                                <span class="help-block">{{$errors->first('developer_name')}}</span>
                            </div>
                        @endif
                    </div>

                    <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                        <div class="m-form__actions px-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="btn-list">
                                        <button type="submit"  class="btn btn-primary">Update</button>
                                        <a href="{{route('society_offer_letter_dashboard')}}" class="btn btn-secondary">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection