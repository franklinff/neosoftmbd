@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.role.actions')
@endsection
@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Add Role</h3>
                {{ Breadcrumbs::render('add_role') }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <form id="addrole" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('roles.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="name">Name:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="name" name="name" class="form-control form-control--custom m-input"  value="{{ old('name') }}">
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="display_name">Display Name:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="display_name" name="display_name" class="form-control form-control--custom m-input"  value="{{ old('display_name') }}">
                                <span class="text-danger">{{$errors->first('display_name')}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="description">Description:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="description" name="description" class="form-control form-control--custom m-input"  value="{{ old('description') }}">
                                <span class="text-danger">{{$errors->first('description')}}</span>
                            </div>
                        </div>

                        <div class="col-sm-4 offset-sm-1 form-group">
                            <label class="col-form-label" for="redirect_to">Redirect To:</label>
                            <div class="m-input-icon m-input-icon--right">
                                <input type="text" id="redirect_to" name="redirect_to" class="form-control form-control--custom m-input"  value="{{ old('redirect_to') }}">
                                <span class="text-danger">{{$errors->first('redirect_to')}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="btn-list">
                                    <button type="submit" id="add_role" class="btn btn-primary">Save</button>
                                    <a href="{{route('roles.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

