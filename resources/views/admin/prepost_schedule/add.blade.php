@extends('admin.layouts.sidebarAction')
@section('actions')
    @include('admin.hearing.actions',compact('hearing_data'))
@endsection
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Prepone/ Postpone Hearing</h3>
            {{ Breadcrumbs::render('Prepone/Postpone Hearing', $arrData['hearing_data']->id) }}
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

        <form role="form" id="prePostSchedule" method="post" files="true" class="m-form m-form--rows m-form--label-align-right"
            action="{{route('fix_schedule.store')}}">
            @csrf

            <input type="hidden" name="hearing_schedule_id" value="{{ $arrData['hearing_data']->hearingSchedule->id }}">
            <input type="hidden" name="hearing_id" value="{{ $arrData['hearing_data']->id }}">

            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="pre_post_status">Prepone/Postpone Hearing:</label>
                        <div class="m-radio-inline">
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="pre_post_status" value="1"> Prepone
                                <span></span>
                            </label>
                            <label class="m-radio m-radio--primary">
                                <input type="radio" name="pre_post_status" checked value="0"> Postpone
                                <span class="help-block"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="case_year">Case Year:</label>
                        <input type="text" id="case_year" name="case_year" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->case_year }}" readonly>
                        <span class="help-block">{{$errors->first('case_year')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="case_number">Case Number:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="case_number" name="case_number" class="form-control form-control--custom m-input"
                                value="{{ $arrData['hearing_data']->id }}" readonly>
                            <span class="help-block">{{$errors->first('case_number')}}</span>
                        </div>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="appellant_name">Apellent Name:</label>
                        <input type="text" id="appellant_name" name="appellant_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->applicant_name }}" readonly>
                        <span class="help-block">{{$errors->first('appellant_name')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="respondent_name">Respondent Name:</label>
                        <input type="text" id="respondent_name" name="respondent_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->respondent_name }}" readonly>
                        <span class="help-block">{{$errors->first('respondent_name')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="first_hearing_date">First Hearing Date:</label>
                        <input type="text" id="first_hearing_date" name="first_hearing_date" class="form-control form-control--custom"
                            class="form-control form-control--custom m-input" value="{{ $arrData['hearing_data']->hearingSchedule->preceding_date }}"
                            readonly>
                        <span class="help-block">{{$errors->first('first_hearing_date')}}</span>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="preceding_officer_name">Preceding Officer Name:</label>
                        <input type="text" id="preceding_officer_name" name="preceding_officer_name" class="form-control form-control--custom m-input"
                            value="{{ $arrData['hearing_data']->preceding_officer_name }}" readonly>
                        <span class="help-block">{{$errors->first('preceding_officer_name')}}</span>
                    </div>
                </div>

                <div class="form-group m-form__group row">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="date">Select Date:</label>
                        <input type="text" id="date" name="date" class="form-control form-control--custom m_datepicker"
                            class="form-control form-control--custom m-input" value="{{ old('date') }}">
                        <span class="help-block">{{$errors->first('date')}}</span>
                    </div>
                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="time">Preceding Time:</label>
                        <input type="text" id="time" name="time" class="form-control form-control--custom m-input"
                               value="{{ old('time') }}">
                        <span class="help-block">{{$errors->first('time')}}</span>
                    </div>

                </div>
            <div class="form-group m-form__group row">
                <div class="col-sm-4 form-group">
                    <label class="col-form-label" for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control form-control--custom form-control--fixed-height m-input">{{ old('description') }}</textarea>
                    <span class="help-block">{{$errors->first('description')}}</span>
                </div>
            </div>

            </div>
            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                <div class="m-form__actions px-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="btn-list">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="{{url('/hearing')}}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if(count($hearingLogs->hearingPrePostSchedule) > 0)
    <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0">
        <div class="portlet-body">
            <div class="m-portlet__body m-portlet__body--serial-no m-portlet__body--serial-no-pdf">
                <div class="remark-body">
                    <div class="pb-2">
                        <h3 class="section-title section-title--small mb-2">
                            History:
                        </h3>
                    </div>
                </div>
                <div class="col-md-12 table-responsive">
                    <table id="dtBasicExample" class="table" style="font-size: 14px">
                        <thead>
                        <tr>
                            <th class="th-sm">sr.</th>
                            <th class="th-sm">Date</th>
                            <th class="th-sm">Time</th>
                            <th class="th-sm">User</th>
                            <th class="th-sm">Role</th>
                            <th class="th-sm">Description</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($hearingLogs->hearingPrePostSchedule as $log)
                            <tr>
                                <td> {{$i}}</td>
                                <td> {{ isset($log->date) ? $log->date : '' }}</td>
                                <td> {{ isset($log->time) ? $log->time : '' }}</td>
                                <td> {{ isset($log->userDetails->name) ? $log->userDetails->name : '' }}</td>
                                <td> {{ isset($log->userDetails->roleDetails->name) ? $log->userDetails->roleDetails->name : '' }}</td>
                                <td> {{ isset($log->description) ? $log->description : '' }}</td>
                            </tr>
                            @php $i++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif

@endsection
@section('js')
    <script src="{{asset('/js/mdtimepicker.min.js')}}" type="text/javascript"></script>

    <script>
        $(function () {
            $('#time').timepicker();
        });

        $(document).ready(function () {
            $('#dtBasicExample').DataTable();
            $('.dataTables_length').addClass('bs-select');

            $('#dtBasicExample_wrapper > .row:first-child').remove();
        });

        $('table').dataTable({searching: false, ordering:false, info: false});
    </script>
@endsection
