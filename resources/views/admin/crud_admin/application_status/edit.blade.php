@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.application_status.actions')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Application Status Details</h3>
                {{ Breadcrumbs::render('edit_application_status',$status['id']) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <form id="editapplicationstatus" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('application_status.update',$status['id'])}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="status_name">Application Status Name:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="status_name" name="status_name" class="form-control form-control--custom m-input"  value="{{ $status['status_name'] }}">
                                <span class="text-danger">{{$errors->first('status_name')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="btn-list">
                                    <button type="submit" id="edit_application_status" class="btn btn-primary">Update</button>
                                    <a href="{{route('application_status.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

