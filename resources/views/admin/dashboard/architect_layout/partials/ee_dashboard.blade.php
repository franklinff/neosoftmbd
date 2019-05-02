<div class="container-fluid">
    <div class="m-subheader px-0 m-subheader--top">
        <div class="d-flex align-items-center">
            <h3 class="m-subheader__title">Revision in Layout</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-7">
            <div class="m-portlet db-table">
                <div class="table-responsive">
                    <table class="table text-center">
                        <thead>
                        <th style="width: 10%;">Sr. No</th>
                        <th style="width: 60%;" class="text-center">Stages</th>
                        <th style="width: 15%;" class="text-left">Count</th>
                        <th style="width: 15%;">Action</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">1.</td>
                            <td>Total No of Application Sent For Revision</td>
                            <td class="text-center"><span class="count-circle">{{$architect_data['total_no_of_appln_for_revision']}}</span></td>
                            <td><button class="btn btn-action">View</button></td>
                        </tr>
                        <tr>
                            <td class="text-center">2.</td>
                            <td>Application Pending</td>
                            <td><span class="count-circle">{{$architect_data['application_pending']}}</span></td>
                            <td><button class="btn btn-action">View</button></td>
                        </tr>
                        <tr>
                            <td class="text-center">3.</td>
                            <td>Application Forwarded</td>
                            <td><span class="count-circle">{{$architect_data['ee_forwarded_layouts']}}</span></td>
                            <td><button class="btn btn-action">View</button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="m-portlet">
                <img src="img/data-gola.jpg">
            </div>
        </div>
    </div>

</div>

@if(session()->get('role_name')==config('commanConfig.ee_branch_head'))
    <div class="container-fluid">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title">Layout Approval</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-7">
                <div class="m-portlet db-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                            <th style="width: 10%;">Sr. No</th>
                            <th style="width: 60%;" class="text-center">Stages</th>
                            <th style="width: 15%;" class="text-left">Count</th>
                            <th style="width: 15%;">Action</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1.</td>
                                <td>Total No of Application Sent For Revision</td>
                                <td class="text-center"><span class="count-circle">{{$architect_data['total_no_of_appln_for_revision']}}</span></td>
                                <td><button class="btn btn-action">View</button></td>
                            </tr>
                            <tr>
                                <td class="text-center">2.</td>
                                <td>Pending at JE / SE</td>
                                <td><span class="count-circle">{{$architect_data['jr_ee_pending']}}</span></td>
                                <td><button class="btn btn-action">View</button></td>
                            </tr>
                            <tr>
                                <td class="text-center">3.</td>
                                <td>Pending at  Deputy Engineer</td>
                                <td><span class="count-circle">{{$architect_data['dy_ee_pending']}}</span></td>
                                <td><button class="btn btn-action">View</button></td>
                            </tr>
                            <tr>
                                <td class="text-center">4.</td>
                                <td>Pending at EE</td>
                                <td><span class="count-circle">{{$architect_data['head_ee_pending']}}</span></td>
                                <td><button class="btn btn-action">View</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="m-portlet">
                    <img src="img/data-gola.jpg">
                </div>
            </div>
        </div>

    </div>
@endif







{{--<div class="hearing-accordion-wrapper">--}}
    {{--<div class="m-portlet m-portlet--compact hearing-accordion architect-accordion mb-0">--}}
        {{--<div class="d-flex justify-content-between align-items-center">--}}
            {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
               {{--data-toggle="collapse" href="#layout_forwarded_for_approval">--}}
                {{--<span class="form-accordion-title">Revision in Layout</span>--}}
                {{--<span class="accordion-icon architect-accordion-icon"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="layout_forwarded_for_approval"--}}
         {{--data-parent="#accordion">--}}
        {{--<div class="row no-gutters hearing-row">--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Total No of Application Sent For Revision</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['total_no_of_appln_for_revision']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Application Pending</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['application_pending']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Application Forwarded</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['ee_forwarded_layouts']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--@if(session()->get('role_name')==config('commanConfig.ee_branch_head'))--}}
{{--<div class="hearing-accordion-wrapper">--}}
    {{--<div class="m-portlet m-portlet--compact architect-layout-approval-ee-accordion mb-0">--}}
        {{--<div class="d-flex justify-content-between align-items-center">--}}
            {{--<a class="btn--unstyled section-title section-title--small d-flex justify-content-between mb-0 w-100"--}}
               {{--data-toggle="collapse" href="#layout_forwarded_for_ee_head">--}}
                {{--<span class="form-accordion-title">Layout Approval</span>--}}
                {{--<span class="accordion-icon architect-layout-approval-ee-accordion-icon"></span>--}}
            {{--</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="m-portlet__body m-portlet__body--hearing m-portlet__body--spaced collapse" id="layout_forwarded_for_ee_head"--}}
         {{--data-parent="#accordion">--}}
        {{--<div class="row no-gutters hearing-row">--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Total No of Application Sent For Revision</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['total_no_of_appln_for_revision']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at JE / SE</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['jr_ee_pending']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at  Deputy Engineer</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['dy_ee_pending']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col">--}}
                {{--<div class="m-portlet app-card text-center">--}}
                    {{--<h2 class="app-heading">Pending at EE</h2>--}}
                {{--<h2 class="app-no mb-0">{{$architect_data['head_ee_pending']}}</h2>--}}
                    {{--<a href="" class="app-card__details mb-0">View Details</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
{{--@endif--}}
