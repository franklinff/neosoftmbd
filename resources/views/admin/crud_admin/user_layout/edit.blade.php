@extends('admin.crud_admin.app')
@section('actions')
    @include('admin.crud_admin.user_layout.actions')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Edit User Layout</h3>
                {{ Breadcrumbs::render('edit_user_layout',$user_layout['id']) }}
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>

        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            <form id="edituserlayout" role="form" method="post" class="m-form m-form--rows m-form--label-align-right" action="{{route('user_layouts.update',$user_layout['id'])}}" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="m-portlet__body m-portlet__body--spaced">
                    <div class="form-group m-form__group row">
                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="user_id">Users:<span class="star">*</span></label>
                            <select data-live-search="true" title="Please Select User" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="user_id" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}" {{ ($user['id'] == $user_layout['user_id']) ? "selected" : "" }}>{{ $user['name']}}</option>
                                @endforeach
                            </select>
                            <span class="error">{{$errors->first('user_id')}}</span>

                        </div>

                        <div class="col-sm-4 form-group">
                            <label class="col-form-label" for="layout_id">Layout:<span class="star">*</span></label>
                            <select data-live-search="true" title="Please Select Layout" class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input" id="layout_id" name="layout_id">
                                @foreach($layouts as $layout)
                                    <option value="{{ $layout['id']  }}"  {{ ($layout['id'] == $user_layout['layout_id']) ? "selected" : "" }}>{{ $layout['layout_name'] }}</option>
                                @endforeach
                            </select>
                            <span class="error">{{$errors->first('layout_id')}}</span>

                        </div>
                    </div>
                </div>
                @if(Session::has('error'))
                    <div><span class="error">{{Session::get('error')}}</span></div>
                @endif
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions px-0">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="btn-list">
                                    <button type="submit" id="edit_user_layout" class="btn btn-primary">Update</button>
                                    <a href="{{route('user_layouts.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

