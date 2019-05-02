@extends('admin.layouts.app')
@section('content')

@if(session()->has('success'))
<div class="alert alert-success display_msg">
    {{ session()->get('success') }}
</div>
@endif
@php $route_name = Route::currentRouteName(); @endphp
<div class="col-md-12">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title m-subheader__title--separator">Requests For revising layout</h3>
            {{ Breadcrumbs::render('architect_layout') }}
            {{-- @if(session()->get('role_name')=='junior_architect')
            <a href="{{route('architect_layout.add')}}" class="btn btn-primary ml-auto">Add Layout</a>
            @endif --}}
        </div>
        
        <div class="m-portlet m-portlet--compact filter-wrap">
            <div class="row align-items-center row--filter">
                <div class="col-md-12">
                    <form role="form" id="eeForm" class="floating-labels-form" method="get" action="{{ route($route_name) }}">
                        <div class="row align-items-center mb-0">
                            <div class="col-md-2 mb-0">
                                <div class="form-group m-form__group">
                                    <label for="title" class="col-form-label">Layout No</label>
                                    <input type="text" id="title" name="title" class="form-control form-control--custom m-input"
                                        placeholder="" value="{{ isset($getData['title'])? $getData['title'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-2 mb-0">
                                <div class="form-group m-form__group">
                                    <label for="submitted_at_from" class="col-form-label">From Date</label>
                                    <input type="text" id="submitted_at_from" name="submitted_at_from" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="" value="{{ isset($getData['submitted_at_from'])? $getData['submitted_at_from'] : '' }}">
                                </div>
                            </div>
                            <div class="col-md-2 mb-0">
                                <div class="form-group m-form__group">
                                    <label for="submitted_at_to" class="col-form-label">To Date</label>
                                    <input type="text" id="submitted_at_to" name="submitted_at_to" class="form-control form-control--custom m-input m_datepicker"
                                        placeholder="" value="{{ isset($getData['submitted_at_to'])? $getData['submitted_at_to'] : '' }}">
                                </div>
                            </div>

                            @php
                            $status = isset($getData['update_status'])? $getData['update_status'] : '';
                            @endphp

                            <div class="col-md-3 mb-0">
                                <div class="form-group m-form__group focused">
                                    <label for="submitted_at_to" class="col-form-label mhada-multiple-label">Select Status</label>
                                    <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input"
                                        id="update_status" name="update_status">
                                        <option value="" style="font-weight: normal;">Select Status</option>
                                        @foreach(config('commanConfig.architect_layout_status') as $key =>
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
                                        <button type="reset" onclick="window.location.href='{{ route("architect_layout.index") }}'"
                                            class="btn m-btn--pill m-btn--custom btn-metal">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    @php
$route="";
$route=\Request::route()->getName();
@endphp
    <div class="m-portlet m-portlet--mobile">
            <div class="d-flex justify-content-between ">
                    <h3 class="section-title section-title--small">&nbsp;</h3>
                    <div class="topnav">
                        {{-- <a class="btn-link {{isset($_GET['application_status'])?($_GET['application_status']==0?'active':''):'active'}}"
                         href="?application_status=0">All</a> --}}
                    <a class="btn-link {{$route=='architect_layout.index'?'active':''}}" href="{{route('architect_layout.index')}}">Requests Revision</a>
                        {{-- <a class="btn-link {{isset($_GET['application_status'])?($_GET['application_status']==1?'active':''):''}}"
                            href="?application_status=1">Shortlisted</a> --}}
                    <a class="btn-link {{$route=='architect_layouts_layout_details.index'?'active':''}}" href="{{route('architect_layouts_layout_details.index')}}">Layout Details</a>
                        {{-- <a class="btn-link {{isset($_GET['application_status'])?($_GET['application_status']==2?'active':''):''}}"
                            href="?application_status=2">Final</a> --}}
                    </div>
                </div>
        {{-- <div class="btn-list mb-2">
            <a class="btn btn-primary" href="{{route('architect_layout.index')}}">Requests Revision</a>
            <a class="btn btn-primary" href="{{route('architect_layouts_layout_details.index')}}">Layout Details</a>
        </div> --}}
        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item {{$route_name=='architect_layout.index'?'active':''}}">
                    <a class="nav-link" href="{{route('architect_layout.index')}}">Requests Revision</a>
                </li>
                <li class="nav-item {{$route_name=='architect_layouts_layout_details.index'?'active':''}}">
                    <a class="nav-link" href="{{route('architect_layouts_layout_details.index')}}">Layout Details</a>
                </li>
            </ul>
        </nav> --}}
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