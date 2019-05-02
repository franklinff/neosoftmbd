@extends('admin.layouts.sidebarAction')
@section('actions')
@include('admin.architect.actions',compact('ArchitectApplication'))
@endsection
@section('content')
<div class="page-bar">
  <ul class="page-breadcrumb">
    <li>
      <a href="{{route('final_architect_application')}}">Home</a>
      <i class="fa fa-circle"></i>
    </li>
    <li>
      <span>Architect Application</span>
    </li>
  </ul>
  <div class="page-toolbar">

  </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Architect Application
  <small>&nbsp;</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
  <div class="col-md-12">
    @if(Session::has('success'))
    <div class="note note-success">
      <div class="caption">
        <i class="fa fa-gift"></i> {{Session::get('success')}}
      </div>
      <div class="tools pull-right">
        <a href="" class="remove" data-original-title="" title=""> </a>
      </div>
    </div>
    @endif

    <div class="portlet box ">
      <div class="portlet-body">
        <form method="get" action="{{url('architect_application')}}">
          @csrf
          <div class="row-fluid search-form-wrapper">
            <div class="span12">
              <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span3 control-label" for="form_control_1">Search For</label>
                        <div class="span8 select-wrapper">
                            <input type="text" name="keyword" value="{{old('keyword')}}" placeholder="Application No, Candidate Name, Email ID OR Mobile No" title="Enter Application No, Candidate Name, Email ID OR Mobile No" class="span12 m-wrap">
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span2 control-label" for="form_control_1">From</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="from" value="{{old('from')}}" class="span12 m-wrap">
                        </div>

                        <label class="span2 control-label" for="form_control_1">To</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="to" value="{{old('to')}}" class="span12 m-wrap">
                        </div>
                    </div>
                </div>
            </div>
            <div class="span12">
              <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span3 control-label" for="form_control_1">Sort by Status</label>
                        <div class="span8 select-wrapper">
                            <select name="status" class="span12 m-wrap">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="form-group clearfix form-md-line-input">
                        <label class="span2 control-label" for="form_control_1">From</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="from" value="{{old('from')}}" class="span12 m-wrap">
                        </div>

                        <label class="span2 control-label" for="form_control_1">To</label>
                        <div class="span4 select-wrapper">
                            <input type="date" name="to" value="{{old('to')}}" class="span12 m-wrap">
                        </div>
                    </div>
                </div>
            </div>
          <div>
            <input type="hidden" name="listingType" id="listingType" value="">
        </form>
      </div>
    </div>

        <div class="portlet light bordered">
          <div class="portlet-title tabbable-line">
            <div class="caption">
              <span class="caption-subject bold font-yellow-lemon uppercase"> Applications for Architect panel Listing </span>
            </div>
            <ul class="nav nav-tabs">
              <li class="active">
                <a href="{{url('architect_application')}}" class="aplListing" data-val="all"> All </a>
              </li>
              <li class="">
                <a href="{{url('final_architect_application')}}" class="aplListing" data-val="shortlisted"> Shortlisted </a>
              </li>
              <li class="">
                <a href="#portlet_tab3" class="aplListing" data-val="finalSelected" aria-expanded="false"> Final list of selected cadidates </a>
              </li>
            </ul>
          </div>
          <div class="portlet-body">
            <div class="tab-content">
              <div class="tab-pane" id="portlet_tab1">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">

                </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 104.439px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
              </div>
              <div class="tab-pane" id="portlet_tab2">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">

                    </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                  </div>
                  <div class="tab-pane active" id="portlet_tab3">
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><div class="scroller" style="height: 200px; overflow: hidden; width: auto;" data-initialized="1">
                      <table class="table table-striped table-bordered table-hover datatable mdl-data-table dataTable">
                        <thead>
                          <tr>
                            <th>Sr No.</th>
                            <th>Application No.</th>
                            <th>Date</th>
                            <th>Condidate Name</th>
                            <th>Email ID & <br/>Mobile No</th>
                            <th>Status</th>
                            <th>Marks</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i=0 @endphp
                          @forelse($finalSelected as $row)
                          <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->application_number}}</td>
                            <td>{{$row->application_date}}</td>
                            <td>{{$row->candidate_name}}</td>
                            <td>{{$row->candidate_email}}<br>{{$row->candidate_mobile_no}}</td>
                            <td>{{$row->application_status}}</td>
                            <td>{{$row->status}}</td>
                            <td>
                              <a title="View Application" href="{{ url('view_architect_application/'. encrypt($row->id)) }}">View Application</a>
                              &nbsp; | &nbsp;
                              <a title="Evaluate Apllication" href="{{ url('evaluate_architect_application/'. encrypt($row->id)) }}">Evaluate Application</a>
                              &nbsp; | &nbsp;
                              @if($row->application_status=='Final')
                                <a title="Generate Certificate" href="{{ url('generate_certificate/'. encrypt($row->id)) }}">Generate Certificate</a>
                              @else
                                <a title="Forward" href="{{ url('forward_application/'. encrypt($row->id)) }}">Forward Application</a>
                              @endif
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="8">No record found</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                      </div><div class="slimScrollBar" style="background: rgb(187, 187, 187); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 109.89px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(234, 234, 234); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            @endsection
