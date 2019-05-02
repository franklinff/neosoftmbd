@extends('admin.layouts.app')
@section('content')
<div class="col-md-12">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Add Lease</h3>
            {{ Breadcrumbs::render('lease_create',encrypt($id)) }}
            <div class="ml-auto btn-list">
                <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-portlet m-portlet--mobile m-portlet--forms-view">

        <form id="addLeaseDetail" role="form" method="post" class="m-form m-form--rows m-form--label-align-right floating-labels-form"
            action="{{route('lease_detail.store')}}">
            @csrf
            <input type="hidden" name="society_id" value="{{ $id }}">
            <div class="m-portlet__body m-portlet__body--spaced">
                <div class="m-form__group row mhada-lease-margin">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="lease_rule_other">Lease rule 16 & other:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_rule_other" name="lease_rule_other" class="form-control form-control--custom m-input"
                                value="{{ old('lease_rule_other') }}">
                            <span class="help-block">{{$errors->first('lease_rule_other')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="lease_basis">School/society/ others on lease basis:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_basis" name="lease_basis" class="form-control form-control--custom m-input"
                                value="{{ old('lease_basis') }}">
                            <span class="help-block">{{$errors->first('lease_basis')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-form__group row mhada-lease-margin">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="area">Area(Sq.m.):</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="area" name="area" class="form-control form-control--custom m-input"
                                value="{{ old('area') }}">
                            <span class="help-block">{{$errors->first('area')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="lease_period">Lease Period(in Yrs.):</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_period" name="lease_period" class="form-control form-control--custom m-input"
                                value="{{ old('lease_period') }}">
                            <span class="help-block">{{$errors->first('lease_period')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-form__group row mhada-lease-margin">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="lease_start_date">Start date of lease:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_start_date" name="lease_start_date" class="m_datepicker form-control form-control--custom m-input"
                                value="{{ old('lease_start_date') }}">
                            <span class="help-block">{{$errors->first('lease_start_date')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="lease_rent">Land rent / lease rent(in Rs.):</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="lease_rent" name="lease_rent" class="form-control form-control--custom m-input"
                                value="{{ old('lease_rent') }}">
                            <span class="help-block">{{$errors->first('lease_rent')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-form__group row mhada-lease-margin">
                    <div class="col-sm-4 form-group">
                        <label class="col-form-label" for="lease_rent_start_month">Month to start collection of lease
                            rent:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <select class="form-control form-control--custom m-input" id="lease_rent_start_month" name="lease_rent_start_month">
                                @foreach($arrData['month_data'] as $month)
                                <option value="{{ $month->id  }}" {{ (date('n') == $month->id) ? "selected" : "" }}>{{
                                    $month->month_name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block">{{$errors->first('lease_rent_start_month')}}</span>
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-1 form-group">
                        <label class="col-form-label" for="interest_per_lease_agreement">Interest as per Lease
                            agreement, in %:</label>
                        <div class="m-input-icon m-input-icon--right">
                            <input type="text" id="interest_per_lease_agreement" name="interest_per_lease_agreement"
                                class="form-control form-control--custom m-input" value="{{ old('interest_per_lease_agreement') }}">
                            <span class="help-block">{{$errors->first('interest_per_lease_agreement')}}</span>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="btn-list">
                                    <button type="submit" id="add_lease" class="btn btn-primary">Save</button>
                                    <a href="{{url('/lease_detail/'.encrypt($id))}}" class="btn btn-secondary">Cancel</a>
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
