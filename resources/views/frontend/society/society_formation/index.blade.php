@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Society Formation Application FormAA</h3>
               {{ Breadcrumbs::render('society_formation') }}
        </div>
    </div>
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">
        <form id="save_sc_application" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form" action="{{ route('society_formation.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="m-form__group row mhada-lease-margin">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="layout_id">Layout:</label>
                        <select data-live-search="true" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout_id" name="layout_id" required>
                            @foreach($layouts as $layout)
                                <option value="{{ $layout['id'] }}">{{ $layout['layout_name'] }}</option>
                            @endforeach
                        </select>
                    <input type="hidden" name="sf_application_id" value="{{ $getPreviousScApplicationData!=null?$getPreviousScApplicationData->id:'' }}">
                    <input type="hidden" name="society_id" value="{{ $society_details->id }}">
                    <input type="hidden" name="sc_application_master_id" value="{{$sc_application_master_id}}">
                        <span class="text-danger">{{$errors->first('layout_id')}}</span>
                    </div>
                </div>
                @for($i=0; $i < count($field_names); $i++)
                @if($i != 0) @php $i++; @endphp @endif
                    <div class="m-form__group row mhada-lease-margin">
                        @if(isset($field_names[$i]))
                            <div class="col-sm-4 form-group">
                                <label class="col-form-label" for="{{ $field_names[$i] }}">@php $labels = implode(' ', explode('_', $field_names[$i])); echo ucwords($labels); @endphp:</label>
                                @if($field_names[$i] == 'society_address')
                                    @php echo $comm_func->form_fields($field_names[$i], 'textarea','' , '', $society_details->address, 'readonly') @endphp
                                    {{--<textarea id="society_address" name="society_address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>--}}
                                @elseif(strpos($field_names[$i], 'date') != null)
                                    @php echo $comm_func->form_fields($field_names[$i], 'date') @endphp
                                @elseif($field_names[$i] == 'society_name' || $field_names[$i] == 'society_no' || $field_names[$i] == 'building_no' || $field_names[$i] == 'society_registration_no' || $field_names[$i] == 'proposed_society_name')
                                    @if($field_names[$i] == 'society_name')
                                        @php echo $comm_func->form_fields($field_names[$i], 'text', '', '', $society_details->name, 'readonly'); @endphp
                                    @elseif($field_names[$i] == 'society_registration_no')
                                        @php echo $comm_func->form_fields($field_names[$i], 'text', '', '', $society_details->registration_no, 'readonly') @endphp
                                    @elseif($field_names[$i] == 'proposed_society_name')
                                        @php echo $comm_func->form_fields($field_names[$i], 'text', '', '', $getPreviousScApplicationData!=null?$getPreviousScApplicationData->proposed_society_name:'', 'readonly') @endphp
                                    @else
                                        @php echo $comm_func->form_fields($field_names[$i], 'text', '', '', $society_details->building_no, 'readonly') @endphp
                                    @endif
                                @else
                                    @php echo $comm_func->form_fields($field_names[$i], 'text') @endphp
                                    {{--<input type="text" id="{{ $field_names[$i+1] }}" name="{{ $field_names[$i+1] }}" class="form-control form-control--custom m-input @if(strpos($field_names[$i+1], 'date') != null) m_datepicker @endif" @if($field_names[$i+1] == 'society_name' || $field_names[$i+1] == 'society_no') value="@if($field_names[$i+1] == 'society_name') {{ $society_details->name }} @else {{ $society_details->building_no }} @endif" readonly @endif>--}}
                                @endif
                                <span class="text-danger">{{$errors->first($field_names[$i])}}</span>
                            </div>
                        @endif
                        @if(isset($field_names[$i+1]))
                            <div class="col-sm-4 offset-sm-1 form-group">
                                <label class="col-form-label" for="{{ $field_names[$i+1] }}">@php $labels = implode(' ', explode('_', $field_names[$i+1])); echo ucwords($labels); @endphp:</label>
                                @if($field_names[$i+1] == 'society_address')
                                    @php echo  $comm_func->form_fields($field_names[$i+1], 'textarea','' , '', $society_details->address, 'readonly') @endphp
                                    {{--<textarea id="society_address" name="society_address" class="form-control form-control--custom form-control--fixed-height m-input" readonly>{{ $society_details->address }}</textarea>--}}
                                @elseif(strpos($field_names[$i+1], 'date') != null)
                                    @php echo $comm_func->form_fields($field_names[$i+1], 'date') @endphp
                                @elseif($field_names[$i+1] == 'society_name' || $field_names[$i+1] == 'society_no'|| $field_names[$i+1] == 'building_no'  || $field_names[$i+1] == 'society_registration_no' || $field_names[$i+1] == 'proposed_society_name')
                                    @if($field_names[$i+1] == 'society_name')
                                        @php echo $comm_func->form_fields($field_names[$i+1], 'text', '', '', $society_details->name, 'readonly') @endphp
                                    @elseif($field_names[$i+1] == 'society_registration_no')
                                        @php echo $comm_func->form_fields($field_names[$i+1], 'text', '', '', $society_details->registration_no, 'readonly') @endphp
                                    @elseif($field_names[$i+1] == 'proposed_society_name')
                                        @php echo $comm_func->form_fields($field_names[$i+1], 'text', '', '', $getPreviousScApplicationData!=null?$getPreviousScApplicationData->proposed_society_name:'', '') @endphp
                                    @else
                                        @php echo $comm_func->form_fields($field_names[$i+1], 'text', '', '', $society_details->building_no, 'readonly') @endphp
                                    @endif
                                @else
                                    @php echo $comm_func->form_fields($field_names[$i+1], 'text') @endphp
                                    {{--<input type="text" id="{{ $field_names[$i+1] }}" name="{{ $field_names[$i+1] }}" class="form-control form-control--custom m-input @if(strpos($field_names[$i+1], 'date') != null) m_datepicker @endif" @if($field_names[$i+1] == 'society_name' || $field_names[$i+1] == 'society_no') value="@if($field_names[$i+1] == 'society_name') {{ $society_details->name }} @else {{ $society_details->building_no }} @endif" readonly @endif>--}}
                                @endif
                                {{--<input type="hidden" name="application_master_id" value="{{ $id }}">--}}
                                <span class="text-danger">{{$errors->first($field_names[$i+1])}}</span>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <a href="{{route('society_formation.create')}}" class="btn btn-secondary">Cancel</a>
                                <button type="submit"  class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection