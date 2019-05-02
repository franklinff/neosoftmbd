@php
    $route_name=\Request::route()->getName();
@endphp
@extends('admin.layouts.sidebarAction')
@section('actions') 

    @if($route_name=='ree.show_reval_calculation_sheet'  || $route_name=='co.show_reval_calculation_sheet' || $route_name=='cap.show_reval_calculation_sheet' || $route_name=='vp.show_reval_calculation_sheet')

        @include('admin.'.$ol_application->folder.$action,compact('ol_application'))


    @else
        @include('admin.'.$ol_application->folder.$action,compact('ol_application'))
    @endif
@endsection
@section('content')

@php $DCRrate = ['EWS / LIG','MIG','HIG']; @endphp
  
<div class="custom-wrapper">
    <div class="col-md-12">
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">Calculation Sheet </h3>
                @if($route_name=='co.show_calculation_sheet')
                    {{ Breadcrumbs::render('calculation_sheet_co',$ol_application->id) }}
                @elseif($route_name=='cap.show_calculation_sheet') 
                    {{ Breadcrumbs::render('calculation_sheet_cap',$ol_application->id) }}
                @elseif($route_name=='vp.show_calculation_sheet') 
                    {{ Breadcrumbs::render('calculation_sheet_vp',$ol_application->id) }}       
                @elseif($route_name=='ree.show_calculation_sheet') 
                    {{ Breadcrumbs::render('REE_calculation',$ol_application->id) }} @elseif($route_name=='ree_applications.custom_calculation_sheet') 
                    {{ Breadcrumbs::render('reval_calculation_sheet',$ol_application->id) }} @elseif($route_name=='ree.show_reval_calculation_sheet') 
                    {{ Breadcrumbs::render('reval_calculation_sheet',$ol_application->id) }} 
                    @elseif($route_name=='co.show_reval_calculation_sheet')
                    {{ Breadcrumbs::render('reval_co_calculation_sheet',$ol_application->id) }}@elseif($route_name=='cap.show_reval_calculation_sheet')
                    {{ Breadcrumbs::render('reval_cap_calculation_sheet',$ol_application->id) }}
                    @elseif($route_name=='vp.show_reval_calculation_sheet')
                    {{ Breadcrumbs::render('reval_vp_calculation_sheet',$ol_application->id) }}
                    @else  
                @endif
                <div class="ml-auto btn-list">
                    <a href="{{ url()->previous() }}" class="btn btn-link"><i class="fa fa-long-arrow-left" style="padding-right: 8px;"></i>Back</a>
                </div>
            </div>
        </div>

        <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x nav-tabs--custom" role="tablist">
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#one" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> परिगणनेचा तक्ता - अ
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#two" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i> Part payment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#three" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>1st installment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#four" role="tab" aria-selected="false">
                    <i class="la la-cog"></i> 2nd, 3rd & 4th installment
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#five" role="tab" aria-selected="false">
                    <i class="la la-briefcase"></i>Summary
                </a>
            </li>
            <li class="nav-item m-tabs__item">
                <a class="nav-link m-tabs__link" data-toggle="tab" href="#six" role="tab" aria-selected="true">
                    <i class="la la-bell-o"></i>REE - Note
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active show" id="one" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        परिगणनेचा तक्ता - अ
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-start align-items-center mb-4">
                                        <span class="flex-shrink-0 text-nowrap">Total Number of buildings:</span>
                                        <input type="text" class="form-control form-control--xs form-control--custom flex-grow-0 ml-3"
                                            name="total_no_of_buildings" id="total_no_of_buildings" value="{{ isset($calculationSheetDetails[0]->total_no_of_buildings) ? $calculationSheetDetails[0]->total_no_of_buildings : 0 }}"
                                            readonly />
                                    </div>
                                    <table id="one" class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                                        <input name="application_id" type="hidden" value="{{ $applicationId }}" />
                                        <input name="user_id" type="hidden" value="{{ $user->id }}" />
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("one");'
                                                    style="max-width: 22px" class="printBtn"></a>
                                        </div>
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "border-style: ridge;">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style = "border-style: ridge;">1.</td>
                                                <td style = "border-style: ridge;">
                                                    कार्यकारी अभियंता /कुर्ला विभाग यांचे सिमांकन नकाशानुसार
                                                    भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. भाडेपट्टा करारनाम्यानुसार क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom"
                                                        name="area_as_per_lease_agreement" id="area_as_per_lease_agreement"
                                                        value="{{ isset($calculationSheetDetails[0]->area_as_per_lease_agreement) ? $calculationSheetDetails[0]->area_as_per_lease_agreement : 0 }}"
                                                        readonly />
                                                </td>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. टिट बिट भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom"
                                                        name="area_of_tit_bit_plot" id="area_of_tit_bit_plot" value="{{ isset($calculationSheetDetails[0]->area_of_tit_bit_plot) ? $calculationSheetDetails[0]->area_of_tit_bit_plot : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    3. आर जी भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom"
                                                        name="area_of_rg_plot" id="area_of_rg_plot" value="{{ isset($calculationSheetDetails[0]->area_of_rg_plot) ? $calculationSheetDetails[0]->area_of_rg_plot : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    4. NTBNIB भूखंडाचे क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_area form-control form-control--custom"
                                                        name="area_of_ntbnib_plot" id="area_of_ntbnib_plot" value="{{ isset($calculationSheetDetails[0]->area_of_ntbnib_plot) ? $calculationSheetDetails[0]->area_of_ntbnib_plot : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" class="form-control form-control--custom" readonly type="text"
                                                        name="area_of_total_plot" id="area_of_total_plot" value="{{ isset($calculationSheetDetails[0]->area_of_total_plot) ? $calculationSheetDetails[0]->area_of_total_plot : 0 }}"
                                                        readonly /></td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    अभिनण्यानुसार भूखंडाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="form-control form-control--custom" name="area_as_per_introduction"
                                                        id="area_as_per_introduction" value="{{ isset($calculationSheetDetails[0]->area_as_per_introduction) ? $calculationSheetDetails[0]->area_as_per_introduction : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    परिगणनाकरिता ग्राह्य भूखंडाचे क्षेत्रफळ (Min of 1 & 2)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="permissible_area total_permissible form-control form-control--custom"
                                                           name="area_of_subsistence_to_calculate" id="area_of_subsistence_to_calculate"
                                                           value="<?php if(isset($calculationSheetDetails[0]->area_of_subsistence_to_calculate)) { echo $calculationSheetDetails[0]->area_of_subsistence_to_calculate; }?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय चटई क्षेत्र निर्देशांक
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="permissible_area total_permissible form-control form-control--custom"
                                                        name="permissible_carpet_area_coordinates" id="permissible_carpet_area_coordinates"
                                                        value="{{ isset($calculationSheetDetails[0]->permissible_carpet_area_coordinates) ? $calculationSheetDetails[0]->permissible_carpet_area_coordinates : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="total_permissible form-control form-control--custom"
                                                        name="permissible_construction_area" id="permissible_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->permissible_construction_area) ? $calculationSheetDetails[0]->permissible_construction_area : 0 }}"
                                                        readonly />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">
                                                    म.न.पा .कडून ल. ओ. आय. पत्रानुसार अनुज्ञेय प्रोरेटा
                                                    क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. प्रति सदनिका चौ मी क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="proratata_area form-control form-control--custom"
                                                        name="sqm_area_per_slot" id="sqm_area_per_slot" value="{{ isset($calculationSheetDetails[0]->sqm_area_per_slot) ? $calculationSheetDetails[0]->sqm_area_per_slot : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. एकूण सदनिका
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="proratata_area total_permissible form-control form-control--custom"
                                                        name="total_house" id="total_house" value="{{ isset($calculationSheetDetails[0]->total_house) ? $calculationSheetDetails[0]->total_house : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="permissible_proratata_area" id="permissible_proratata_area"
                                                        value="{{ isset($calculationSheetDetails[0]->permissible_proratata_area) ? $calculationSheetDetails[0]->permissible_proratata_area : 0 }}"
                                                        readonly />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">7.</td>
                                                <td style = "border-style: ridge;">
                                                    अनुज्ञेय प्रोरेटा बांधकाम क्षेत्रफळ (85% पर्यंत सीमित )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. प्रति सदनिका चौ मी प्रोरेटा बांधकाम क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_permissible form-control form-control--custom"
                                                        name="per_sq_km_proyerta_construction_area" id="per_sq_km_proyerta_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->per_sq_km_proyerta_construction_area) ? $calculationSheetDetails[0]->per_sq_km_proyerta_construction_area : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="proratata_construction_area" id="proratata_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->proratata_construction_area) ? $calculationSheetDetails[0]->proratata_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">8.</td>
                                                <td style = "border-style: ridge;">
                                                    मा उपाध्यक्ष / प्रा यांचे अधिकारातील १०% राखीव कोट्यामधून
                                                    संस्थेस वितरित करावयाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="total_permissible form-control form-control--custom"
                                                        name="area_in_reserved_seats_for_vp_pio" id="area_in_reserved_seats_for_vp_pio"
                                                        value="{{ isset($calculationSheetDetails[0]->area_in_reserved_seats_for_vp_pio) ? $calculationSheetDetails[0]->area_in_reserved_seats_for_vp_pio : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">9.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण अनुज्ञेय बांधकाम क्षेत्रफळ (अ.क्र. ५ + ७ + 8)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="remaining_area form-control form-control--custom"
                                                        name="total_permissible_construction_area" id="total_permissible_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->total_permissible_construction_area) ? $calculationSheetDetails[0]->total_permissible_construction_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">10.</td>
                                                <td style = "border-style: ridge;">
                                                    अस्तित्वातील बांधकाम क्षेत्रफळ (सी - ५७)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="remaining_area form-control form-control--custom"
                                                        name="existing_construction_area" id="existing_construction_area"
                                                        value="{{ isset($calculationSheetDetails[0]->existing_construction_area) ? $calculationSheetDetails[0]->existing_construction_area : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">11.</td>
                                                <td style = "border-style: ridge;">
                                                    उर्वरित क्षेत्रफळ (अ.क्र 9. - अ.क्र.10 )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="remaining_area" id="remaining_area" value="{{ isset($calculationSheetDetails[0]->remaining_area) ? $calculationSheetDetails[0]->remaining_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">12.</td>
                                                <td style = "border-style: ridge;">
                                                    रेडीरेकनर २०१८ - १९ , न. भू. क्र. ३५१ (पै), व्हिलेज-
                                                    हरियाली ,
                                                    टागोरनगर झोन क्रमांक. ११२/५३५, दर रुपये रु. ५५,९०० /-
                                                    (पृष्ठ
                                                    क्रमांक सी - ६०५ ते सी -६०७ )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="redirekner_val form-control form-control--custom"
                                                        name="redirekner_value" id="redirekner_value" value="{{ isset($calculationSheetDetails[0]->redirekner_value) ? $calculationSheetDetails[0]->redirekner_value : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">13.</td>
                                                <td style = "border-style: ridge;">
                                                    बांधकामाचा दर (रेडीरेकनर २०१८-१९)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="redirekner_val form-control form-control--custom"
                                                        name="redirekner_construction_rate" id="redirekner_construction_rate"
                                                        value="{{ isset($calculationSheetDetails[0]->redirekner_construction_rate) ? $calculationSheetDetails[0]->redirekner_construction_rate : 0 }}"
                                                        readonly />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">14.</td>
                                                <td style = "border-style: ridge;">
                                                    LR/RC = ५५,९००/२७५००
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class=" form-control form-control--custom"
                                                        name="redirekner_val" id="redirekner_val" value="{{ isset($calculationSheetDetails[0]->redirekner_val) ? $calculationSheetDetails[0]->redirekner_val : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">15.</td>
                                                <td style = "border-style: ridge;">
                                                    उर्वरितचटईक्षेत्राचे अधिमूल्य
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. उर्वरित च.क्षे.रहिवासी वापर क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="remaining_residential_area" id="remaining_residential_area"
                                                        value="{{ isset($calculationSheetDetails[0]->remaining_residential_area) ? $calculationSheetDetails[0]->remaining_residential_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    2. दर
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <div class="col-sm-12" style="margin-bottom: 12px;padding: 0px">
                                                        <select class="form-control m-bootstrap-select m_selectpicker form-control--custom m-input subtn" name="dcr_rate" id="dcr_rate" disabled>

                                                        @if(count($calculationSheetDetails) == 0 && !isset($calculationSheetDetails->dcr_rate))
                                                            <option value="" selected disabled>Select</option>
                                                        @endif
                                                            @if($DCRrate)
                                                            @foreach($DCRrate as $value)
                                                                @if(isset($calculationSheetDetails->dcr_rate) && $calculationSheetDetails->dcr_rate == $value)
                                                                    <option value="{{$value}}" selected> {{$value}}</option>
                                                                @else
                                                                    <option value="{{$value}}"> {{$value}}</option>
                                                                @endif
                                                            @endforeach
                                                            @endif
                                                        </select>  
                                                    </div>                                                      
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom txtbox"
                                                           name="calculated_dcr_rate_val" id="calculated_dcr_rate_val"
                                                           value="<?php if(isset($calculationSheetDetails[0]->calculated_dcr_rate_val)) { echo $calculationSheetDetails[0]->calculated_dcr_rate_val; } ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    अधिमूल्य
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="total_amount form-control form-control--custom"
                                                        name="balance_of_remaining_area" id="balance_of_remaining_area"
                                                        value="{{ isset($calculationSheetDetails[0]->balance_of_remaining_area) ? $calculationSheetDetails[0]->balance_of_remaining_area : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">16.</td>
                                                <td style = "border-style: ridge;">
                                                    दि.०८.१०.२०१३ च्या अधिसूचनेमधील अनु.क्र.५ ए ,नुसार ७ % ऑफ
                                                    इन्फ्रास्टक्चर शुल्क रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="infrastructure_fee_amount" id="infrastructure_fee_amount"
                                                        value="{{ isset($calculationSheetDetails[0]->infrastructure_fee_amount) ? $calculationSheetDetails[0]->infrastructure_fee_amount : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">17.</td>
                                                <td style = "border-style: ridge;">
                                                    उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रकमेपैकी म.न.पा.स
                                                    भरवायची ५/७ रक्कम (५/७ X अनु.क्र.१६)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="amount_to_be_paid_to_municipal" id="amount_to_be_paid_to_municipal"
                                                        value="{{ isset($calculationSheetDetails[0]->amount_to_be_paid_to_municipal) ? $calculationSheetDetails[0]->amount_to_be_paid_to_municipal : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">18.</td>
                                                <td style = "border-style: ridge;">
                                                    म्हाडाकडे भरवायची ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क रक्कम (२/७
                                                    *
                                                    अनु.क्र.१६ )
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="total_amount form-control form-control--custom"
                                                        name="offsite_infrastructure_charge_to_mhada" id="offsite_infrastructure_charge_to_mhada"
                                                        value="{{ isset($calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada) ? $calculationSheetDetails[0]->offsite_infrastructure_charge_to_mhada : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">19.</td>
                                                <td style = "border-style: ridge;">
                                                    छाननी शुल्क
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom"
                                                           name="scrutiny_fee" id="scrutiny_fee" value="<?php if(isset($calculationSheetDetails[0]->scrutiny_fee)) { echo $calculationSheetDetails[0]->scrutiny_fee; } ?>" />



                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">20.</td>
                                                <td style = "border-style: ridge;">
                                                    अभिन्यास मंजुरी शुल्क रु,१०००/ - प्रति गाळा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="total_amount form-control form-control--custom"
                                                        name="layout_approval_fee" id="layout_approval_fee" value="{{ isset($calculationSheetDetails[0]->layout_approval_fee) ? $calculationSheetDetails[0]->layout_approval_fee : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">21.</td>
                                                <td style = "border-style: ridge;">
                                                    डेब्रिज रिमूव्हल शुल्क रु.६६००/- [for 1 building]
                                                </td>
                                                <td class="text-center"style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="total_amount form-control form-control--custom"
                                                        name="debraj_removal_fee" id="debraj_removal_fee" value="{{ isset($calculationSheetDetails[0]->debraj_removal_fee) ? $calculationSheetDetails[0]->debraj_removal_fee : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">22.</td>
                                                <td style = "border-style: ridge;">
                                                    पाणी वापर शुल्क (रु.१,००,०००/- ) [for 1 building]
                                                </td>
                                                <td class="text-center"style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control total_amount form-control--custom"
                                                        name="water_usage_charges" id="water_usage_charges" value="{{ isset($calculationSheetDetails[0]->water_usage_charges) ? $calculationSheetDetails[0]->water_usage_charges : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">23.</td>
                                                <td style = "border-style: ridge;">
                                                    प्रा. ठराव क्र ६२६० दि. ०४.०६.२००७ व ठराव क्र. ६३४९ दि. २५.११.२००८ अन्वये आर. जी. स्थलांतरणाकरिता दर रु. ५,५३०/- (१० टक्के रे. रे. सन २०१७-१८ रु. ५५३००/- प्रति चौ. मी. ) (१५८४. ४१ चौ. मी. X ५५३०)
                                                </td>
                                                <td class="text-center"style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. आर. जी. स्थलांतरणाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom"
                                                           name="area_of_rg_to_be_relocated" id="area_of_rg_to_be_relocated" value="<?php if(isset($calculationSheetDetails[0]->area_of_rg_to_be_relocated)) { echo $calculationSheetDetails[0]->area_of_rg_to_be_relocated; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom"
                                                           name="total_area_of_rg_to_be_relocated" id="total_area_of_rg_to_be_relocated"
                                                           value="<?php if(isset($calculationSheetDetails[0]->total_area_of_rg_to_be_relocated)) { echo $calculationSheetDetails[0]->total_area_of_rg_to_be_relocated; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">24.</td>
                                                <td style = "border-style: ridge;">
                                                    भुईभाड्याचे भांडवलीकरणे वार्षिक २.५ टक्के
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom"
                                                           name="groundrent_capitalization_yearly" id="groundrent_capitalization_yearly" value="<?php if(isset($calculationSheetDetails[0]->groundrent_capitalization_yearly)) { echo $calculationSheetDetails[0]->groundrent_capitalization_yearly; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">25.</td>
                                                <td style = "border-style: ridge;">
                                                    आगाऊ भुईभाडे (प्रति वर्ष ८ टक्के दराने)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom"
                                                           name="advance_groundrent_per_year" id="advance_groundrent_per_year" value="<?php if(isset($calculationSheetDetails[0]->advance_groundrent_per_year)) { echo $calculationSheetDetails[0]->advance_groundrent_per_year; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">26.</td>
                                                <td style = "border-style: ridge;">
                                                    नाममात्र भुईभाडे (Rs. 1 per year)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="total_amount form-control form-control--custom"
                                                           name="nominal_groundrent" id="nominal_groundrent" value="<?php if(isset($calculationSheetDetails[0]->nominal_groundrent)) { echo $calculationSheetDetails[0]->nominal_groundrent; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">27.</td>
                                                <td style = "border-style: ridge;">
                                                    एकूण रक्कम रुपये (अ .क्र.१५+१८+१९+२०+२१+२२)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="total_amount_in_rs" id="total_amount_in_rs" value="{{ isset($calculationSheetDetails[0]->total_amount_in_rs) ? $calculationSheetDetails[0]->total_amount_in_rs : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">28.</td>
                                                <td style = "border-style: ridge;">
                                                    बृहनमुंबई महानगर पालिकेकडे ऑफ साईट इन्फ्रास्ट्रक्चर शुल्क
                                                    रक्कमपैकी भरणा करावयाची ५/७ रक्कम
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="offsite_infrastructure_charges_to_municipal_corporation"
                                                        id="offsite_infrastructure_charges_to_municipal_corporation"
                                                        value="{{ isset($calculationSheetDetails[0]->offsite_infrastructure_charges_to_municipal_corporation) ? $calculationSheetDetails[0]->offsite_infrastructure_charges_to_municipal_corporation : 0 }}" />

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="two" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("two");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "border-style: ridge;">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style = "border-style: ridge;">1.</td>
                                                <td style = "border-style: ridge;">
                                                    उर्वरितचटई क्षेत्राचे अधिमूल्य
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    उर्वरितच क्षे निरहिवासी वापर क्षेत्र
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" placeholder="0" readonly class="form-control form-control--custom" name="remaining_residential_area"
                                                           id="remaining_residential_area" value="<?php if(isset($calculationSheetDetails[0]->remaining_residential_area)) { echo $calculationSheetDetails[0]->remaining_residential_area;} ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    दर रु
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom" name="calculated_dcr_rate_val"
                                                           id="calculated_dcr_rate_val" value="<?php if(isset($calculationSheetDetails[0]->calculated_dcr_rate_val)) { echo  $calculationSheetDetails[0]->calculated_dcr_rate_val; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    अधिमूल्य
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="form-control form-control--custom" name="remaining_area_of_resident_area_balance"
                                                        id="remaining_area_of_resident_area_balance" value="{{ isset($calculationSheetDetails[0]->remaining_area_of_resident_area_balance) ? $calculationSheetDetails[0]->remaining_area_of_resident_area_balance : 0 }}"
                                                        readonly />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    दि ०८.१०.२०१३ च्या अधिसूचने मधील अनु क्र ५या, नुसार ७% ऑफ
                                                    साईट इन्फ्रास्ट्रुक्चर शुल्क - { (रे रे दर [table pt 11] *
                                                    ७% ) } * { (३.० च क्षे नि प्रमाणे + प्रोरातक्षेत्रफ़ळ,
                                                    [table 1 pt 8]) - (अस्तित्वातील बांधकाम क्षेत्रफळ [table 1
                                                    pt 9]) }
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" class="form-control form-control--custom" name="off_site_infrastructure_fee"
                                                        id="off_site_infrastructure_fee" value="{{ isset($calculationSheetDetails[0]->off_site_infrastructure_fee) ? $calculationSheetDetails[0]->off_site_infrastructure_fee : 0 }}"
                                                        readonly />

                                                </td>
                                            </tr>
                                            <tr id="thisprint">
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    उपरोक्त ऑफ साईट इन्फ्रास्ट्रक्चर शुक्ल रक्कमेपैकी म न प स
                                                    भरावयाची ५/७ रक्कम (५/७ * अनु क्र २)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="amount_to_be_paid_to_municipal1" id="amount_to_be_paid_to_municipal1" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    म्हाडाकडे भरावयाची ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क रक्कम
                                                    (२/७ * अनु क्र २)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="offsite_infrastructure_charge_to_mhada1" id="offsite_infrastructure_charge_to_mhada1" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    १/४ अधिमूल्यापोटी शुल्क
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom"
                                                        name="non_profit_duty" id="non_profit_duty" />

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="three" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        पहिल्या हप्त्याची रक्कम
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("three");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">

                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "border-style: ridge;">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style = "border-style: ridge;">1.</td>
                                                <td style = "border-style: ridge;">
                                                    १/४ अधिमूल्यापोटी शुल्क (उर्वरितचटईक्षेत्राचे अधिमूल्य च्या
                                                    १/४)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="first_installment form-control form-control--custom"
                                                        name="non_profit_duty_installment" id="non_profit_duty_installment" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    म्हाडा कडे भरावयाची ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क रक्कम
                                                    (२/७ * ऑफ साईट इन्फ्रास्ट्रुक्चर शुल्क)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                    <input style="border: none;" type="text" readonly class="first_installment form-control form-control--custom"
                                                        name="offsite_infrastructure_charge_to_mhada1_installment" id="offsite_infrastructure_charge_to_mhada1_installment" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">3.</td>
                                                <td style = "border-style: ridge;">
                                                    छाननी शुल्क
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="first_installment  form-control form-control--custom" placeholder="0"
                                                           name="scrutiny_fee" id="scrutiny_fee" value="<?php if(isset($calculationSheetDetails[0]->scrutiny_fee)) { echo $calculationSheetDetails[0]->scrutiny_fee; } ?>"

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">4.</td>
                                                <td style = "border-style: ridge;">
                                                    अभिन्यास मंजुरी शुल्क रु १,०००/- प्रति गळा
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="first_installment  form-control form-control--custom"
                                                        name="layout_approval_fee" id="layout_approval_fee" value="{{ isset($calculationSheetDetails[0]->layout_approval_fee) ? $calculationSheetDetails[0]->layout_approval_fee : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">5.</td>
                                                <td style = "border-style: ridge;">
                                                    डेब्रिज रिमूव्हल शुल्क रु ६६०० /-
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="first_installment  form-control form-control--custom"
                                                        name="debraj_removal_fee" id="debraj_removal_fee" value="{{ isset($calculationSheetDetails[0]->debraj_removal_fee) ? $calculationSheetDetails[0]->debraj_removal_fee : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">6.</td>
                                                <td style = "border-style: ridge;">
                                                    पाणी वापर शुल्क (रु १,००,०००/-)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="first_installment form-control form-control--custom"
                                                        name="water_usage_charges" id="water_usage_charges" value="{{ isset($calculationSheetDetails[0]->water_usage_charges) ? $calculationSheetDetails[0]->water_usage_charges : 0 }}" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">7.</td>
                                                <td style = "border-style: ridge;">
                                                    प्रा. ठराव क्र ६२६० दि. ०४.०६.२००७ व ठराव क्र. ६३४९ दि. २५.११.२००८ अन्वये आर. जी. स्थलांतरणाकरिता दर रु. ५,५३०/- (१० टक्के रे. रे. सन २०१७-१८ रु. ५५३००/- प्रति चौ. मी. ) (१५८४. ४१ चौ. मी. X ५५३०)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    1. आर. जी. स्थलांतरणाचे क्षेत्रफळ
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="form-control form-control--custom"
                                                           name="area_of_rg_to_be_relocated" id="area_of_rg_to_be_relocated" value="<?php if(isset($calculationSheetDetails[0]->area_of_rg_to_be_relocated)) { echo $calculationSheetDetails[0]->area_of_rg_to_be_relocated; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;"></td>
                                                <td style = "border-style: ridge;">
                                                    Total
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="first_installment form-control form-control--custom"
                                                           name="total_area_of_rg_to_be_relocated" id="total_area_of_rg_to_be_relocated"
                                                           value="<?php if(isset($calculationSheetDetails[0]->total_area_of_rg_to_be_relocated)) { echo $calculationSheetDetails[0]->total_area_of_rg_to_be_relocated; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">8.</td>
                                                <td style = "border-style: ridge;">
                                                    भुईभाड्याचे भांडवलीकरणे वार्षिक २.५ टक्के
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="first_installment form-control form-control--custom"
                                                           name="groundrent_capitalization_yearly" id="groundrent_capitalization_yearly" value="<?php if(isset($calculationSheetDetails[0]->groundrent_capitalization_yearly)) { echo $calculationSheetDetails[0]->groundrent_capitalization_yearly; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">9.</td>
                                                <td style = "border-style: ridge;">
                                                    आगाऊ भुईभाडे (प्रति वर्ष ८ टक्के दराने)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="first_installment form-control form-control--custom"
                                                           name="advance_groundrent_per_year" id="advance_groundrent_per_year" value="<?php if(isset($calculationSheetDetails[0]->advance_groundrent_per_year)) { echo $calculationSheetDetails[0]->advance_groundrent_per_year; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">10.</td>
                                                <td style = "border-style: ridge;">
                                                    नाममात्र भुईभाडे (Rs. 1 per year)
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly placeholder="0" class="first_installment form-control form-control--custom"
                                                           name="nominal_groundrent" id="nominal_groundrent" value="<?php if(isset($calculationSheetDetails[0]->nominal_groundrent)) { echo $calculationSheetDetails[0]->nominal_groundrent; } ?>" />

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">11.</td>
                                                <td class="font-weight-bold" style = "border-style: ridge;">
                                                    एकूण मंडळाकडे भरणा करावयाची पहिल्या हप्त्याची रक्कम
                                                    पूर्णांकामधे
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom" placeholder="0"
                                                           name="payment_of_first_installment" id="payment_of_first_installment"
                                                           value="<?php  if(isset($calculationSheetDetails[0]->payment_of_first_installment)) { echo $calculationSheetDetails[0]->payment_of_first_installment; } ?>" />

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="four" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        मंडळाकडे एकूण भरणा करावयाच्या रकमेचा गोषवारा
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("four");'
                                                style="max-width: 22px" class="printBtn"></a>
                                    </div>
                                    <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                        <thead class="thead-default">
                                            <tr>
                                                <th class="table-data--xs" style = "border-style: ridge;">
                                                    #
                                                </th>
                                                <th style = "border-style: ridge;width:30px">
                                                    तपशील
                                                </th>
                                                <th class="table-data--md" style = "border-style: ridge;">
                                                    रक्कम रु
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style = "border-style: ridge;">1.</td>
                                                <td style = "border-style: ridge;">
                                                    १/४ अधिमूल्यापोटी शुल्क<span class="hint-text"><small>(उर्वरितचटईक्षेत्राचे
                                                            अधिमूल्य च्या १/४)</small></span>
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom" name="non_profit_duty_val" id="non_profit_duty_val"
                                                    />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style = "border-style: ridge;">2.</td>
                                                <td style = "border-style: ridge;">
                                                    मंडळाकडे भरणा करावयाच्या दुसऱ्या, तिसऱ्या व चौथ्या
                                                    हफ्त्याची रक्कम पूर्णांकामध्ये
                                                </td>
                                                <td class="text-center" style = "border-style: ridge;">
                                                    <input style="border: none;" type="text" readonly class="form-control form-control--custom" name="payment_of_remaining_installment" id="payment_of_remaining_installment"
                                                        value="{{ isset($calculationSheetDetails[0]->payment_of_remaining_installment) ? $calculationSheetDetails[0]->payment_of_remaining_installment : 0 }}" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="five" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-subheader">
                                <div class="d-flex align-items-center justify-content-center">
                                    <h3 class="section-title">
                                        अधिमूल्य रकमेचा चार सामान हफ्त्यांत भरणा करण्याबाबतचा प्रस्ताव
                                    </h3>
                                </div>
                            </div>
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <a target="_blank" href="javascript:void(0);" class="btn print-icon ml-auto"><img
                                            src="{{asset('/img/print-icon.svg')}}" onclick='PrintElem("five");' style="max-width: 22px" class="printBtn"></a>
                                </div>
                                <table class="table mb-0" cellspacing="0" cellpadding="0" border="1" style="border-collapse: collapse; border-spacing: 0;">
                                    <thead class="thead-default" >
                                        <tr>
                                            <th class="table-data--xs" style = "border-style: ridge;">
                                                #
                                            </th>
                                            <th style = "border-style: ridge;width:30px">
                                                तपशील
                                            </th>
                                            <th class="table-data--md" style = "border-style: ridge;">
                                                रक्कम रु
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style = "border-style: ridge;">1.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे देकारपत्र जरी केल्याच्या दिनांकापासून पहिल्या सहा
                                                महिन्या पर्यंत भरणा करावयाची पहिल्या हफ्त्याची रक्कम
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                {{ isset($calculationSheetDetails[0]->payment_of_first_installment) ?
                                                $calculationSheetDetails[0]->payment_of_first_installment : 0 }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">2.</td>
                                            <td>
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून एक
                                                वर्षाच्या आत, भरणा करावयाची दुसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दार तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                {{ isset($calculationSheetDetails[0]->payment_of_remaining_installment)
                                                ? $calculationSheetDetails[0]->payment_of_remaining_installment : 0 }}
                                                + interest

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">3.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून दोन
                                                वर्षाच्या आत, भरणा करावयाची तीसऱ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                {{ isset($calculationSheetDetails[0]->payment_of_remaining_installment)
                                                ? $calculationSheetDetails[0]->payment_of_remaining_installment : 0 }}
                                                + interest

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">4.</td>
                                            <td style = "border-style: ridge;">
                                                मंडळाकडे पहिले देकारपत्र जारी केल्याच्या दिनांकापासून तीन
                                                वर्षाच्या आत, भरणा करावयाची चौथ्या हफ्त्याची रक्कम तसेच
                                                प्रत्यक्ष भरेपर्यंत प्रथम देकारपात्राच्या दिनांकापासून १२%
                                                (दर तिमाहीला परिगणनीय दराने) अधिक रकमेचा भरणा करावा लागेल
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                {{ isset($calculationSheetDetails[0]->payment_of_remaining_installment)
                                                ? $calculationSheetDetails[0]->payment_of_remaining_installment : 0 }}
                                                + interest

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style = "border-style: ridge;">5.</td>
                                            <td class="font-weight-bold" style = "border-style: ridge;">
                                                एकूण
                                            </td>
                                            <td class="text-center" style = "border-style: ridge;">
                                                @if(isset($calculationSheetDetails[0]->payment_of_remaining_installment) || isset($calculationSheetDetails[0]->payment_of_first_installment))

                                                    {{ (3 * (float)(str_replace( ',', '',$calculationSheetDetails[0]->payment_of_remaining_installment))) + (float)(str_replace( ',', '',$calculationSheetDetails[0]->payment_of_first_installment)) }}
                                                @else
                                                    0
                                                @endif

                                                + Total interest
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="six" role="tabpanel">
                <div class="m-portlet m-portlet--tabs m-portlet--bordered-semi mb-0 m-portlet--shadow">
                    <div class="portlet-body">
                        <div class="m-portlet__body m-portlet__body--table">
                            <div class="m-section__content mb-0 table-responsive">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="d-flex flex-column h-100 two-cols">
                                            <h3 class="section-title section-title--small">Download REE Note</h3>
                                                <!-- <span class="hint-text">Download  Note uploaded by REE</span> -->
                                                <div class="mt-auto">
                                                    @if(isset($arrData['reeNote']->document_path))
                                                    <a href="{{config('commanConfig.storage_server').'/'.$arrData['reeNote']->document_path}}" target="_blank">

                                                        <button class="btn btn-primary">Download</button>
                                                    </a>
                                                    @else
                                                    <span class="error" style="display: block;color: #ce2323;margin-bottom: 17px;">
                                                        * Note : REE note not available. </span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('calculation_sheet_js')
    <script>
        $(document).ready(function () {

            // **Start** Save tabs location on window refresh or submit

            // Set first tab to active if user visits page for the first time

            if (localStorage.getItem("activeTab") === null) {
                document.querySelector(".nav-link.m-tabs__link").classList.add("active", "show");
            } else {
                document.querySelector(".nav-link.m-tabs__link").classList.remove("active", "show");
            }

            if (location.hash) {
                $('a[href=\'' + location.hash + '\']').tab('show');
            }
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                $('a[href="' + activeTab + '"]').tab('show');
            }

            $('body').on('click', 'a[data-toggle=\'tab\']', function (e) {
                e.preventDefault()
                var tab_name = this.getAttribute('href')
                if (history.pushState) {
                    history.pushState(null, null, tab_name)
                } else {
                    location.hash = tab_name
                }
                localStorage.setItem('activeTab', tab_name)

                $(this).tab('show');

                localStorage.clear();
                return false;
            });

            $(window).on('popstate', function () {
                var anchor = location.hash ||
                    $('a[data-toggle=\'tab\']').first().attr('href');
                $('a[href=\'' + anchor + '\']').tab('show');
                window.scrollTo(0, 0);
            });

            // // **End** Save tabs location on window refresh or submit

            $('input').on('keypress', function (event) {
                /* var regex = new RegExp("^[0-9]\d+$");
                 var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                 if (!regex.test(key)) {
                     event.preventDefault();
                     return false;
                 }*/

                /*  if ($(this).val().indexOf('.') > 0) {
                      var CharAfterdot = ($(this).val().length + 1) - $(this).val().indexOf('.');
                      if ( (($(this).val().length + 1) - $(this).val().indexOf('.')) > 3) {
                          event.preventDefault();
                          return false;
                      }

                  }*/

                var $this = $(this);
                if ((event.which != 46 || $this.val().indexOf('.') != -1) &&
                    ((event.which < 48 || event.which > 57) &&
                        (event.which != 0 && event.which != 8))) {
                    event.preventDefault();
                }

                var text = $(this).val();
                if ((event.which == 46) && (text.indexOf('.') == -1)) {
                    setTimeout(function() {
                        if ($this.val().substring($this.val().indexOf('.')).length > 3) {
                            $this.val($this.val().substring(0, $this.val().indexOf('.') + 3));
                        }
                    }, 1);
                }

                if ((text.indexOf('.') != -1) &&
                    (text.substring(text.indexOf('.')).length > 2) &&
                    (event.which != 0 && event.which != 8) &&
                    ($(this)[0].selectionStart >= text.length - 2)) {
                    event.preventDefault();
                }

                // ============================== format no with comma

                // skip for arrow keys
                if(event.which >= 37 && event.which <= 40) return;

                // format number
                $(this).val(function(index, value) {

                    return numberWithCommas(value);

                });


            });


        })

    </script>
    <script>
        //==========================================   CALCULATION START ==========================

        function numberWithCommas(x) {

            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }

        function cleanNumber(value)
        {
            return value.toString().replace(/\,/g,'');
        }

        function totalAmountInRs()
        {
            var total_amount = 0;
            $(".total_amount").each(function () {

                var total_amount_val = cleanNumber($(this).val());
                var amountVal = (!total_amount_val || isNaN(total_amount_val)) ? 0 : total_amount_val;

                total_amount += +parseFloat(amountVal);
            });
            $("#total_amount_in_rs").attr('value',numberWithCommas(Math.ceil(total_amount)));
        }

        function areaOfTotalPlot()
        {
            var sum = 0;
            $(".total_area").each(function () {
                var sumVal = (!cleanNumber($(this).val()) || isNaN(cleanNumber($(this).val()))) ? 0 : cleanNumber($(this).val());
                sum += +parseFloat(sumVal);
            });
            $("#area_of_total_plot").attr('value',numberWithCommas(sum.toFixed(2)));
        }

        function areaOfSubsistenceToCalculate()
        {
            var sorted = $(".min_val_for_calculation").sort(

                function (a, b) {
                    return cleanNumber(a.value) - cleanNumber(b.value)
                });
            var lowest = sorted[0].value;

            if(lowest==0)
            {
                lowest = sorted[1].value;
            }

            $("#area_of_subsistence_to_calculate").attr('value', numberWithCommas(lowest));
        }

        function permissibleConstructionArea()
        {
            var area_of_subsistence_to_calculate = (!cleanNumber($("#area_of_subsistence_to_calculate").val()) || isNaN(cleanNumber($("#area_of_subsistence_to_calculate").val()))) ? 0 : cleanNumber($("#area_of_subsistence_to_calculate").val());
            var permissible_carpet_area_coordinates = (!cleanNumber($("#permissible_carpet_area_coordinates").val()) || isNaN(cleanNumber($("#permissible_carpet_area_coordinates").val()))) ? 0 : cleanNumber($("#permissible_carpet_area_coordinates").val());

            $("#permissible_construction_area").attr('value',numberWithCommas((area_of_subsistence_to_calculate * permissible_carpet_area_coordinates).toFixed(2)));
        }

        function proratataConstructionArea()
        {
            var per_sq_km_proyerta_construction_area = (!cleanNumber($("#per_sq_km_proyerta_construction_area").val()) || isNaN(cleanNumber($("#per_sq_km_proyerta_construction_area").val()))) ? 0 : cleanNumber($("#per_sq_km_proyerta_construction_area").val());
            var total_house = (!cleanNumber($("#total_house").val()) || isNaN(cleanNumber($("#total_house").val()))) ? 0 : cleanNumber($("#total_house").val());

            $("#proratata_construction_area").attr('value',numberWithCommas((per_sq_km_proyerta_construction_area * total_house).toFixed(2)));
        }

        function calculatedDcrBalanceOfRemainingArea()
        {
            var redirekner_value = (!cleanNumber($("#redirekner_value").val()) || isNaN(cleanNumber($("#redirekner_value").val()))) ? 0 : cleanNumber($("#redirekner_value").val());
            var dcr_rate_in_percentage = (!$("input[type=radio][name=dcr_rate_in_percentage]:checked").val() || isNaN($("input[type=radio][name=dcr_rate_in_percentage]:checked").val())) ? 0 : $("input[type=radio][name=dcr_rate_in_percentage]:checked").val();

            var calculated_dcr = redirekner_value * (dcr_rate_in_percentage / 100);

            $("#calculated_dcr_rate_val").attr('value',numberWithCommas(calculated_dcr.toFixed(2)));

            var remaining_residential_area = (!cleanNumber($("#remaining_residential_area").val()) || isNaN(cleanNumber($("#remaining_residential_area").val()))) ? 0 : cleanNumber($("#remaining_residential_area").val());

            var balance = remaining_residential_area * calculated_dcr.toFixed(2);

            $("#balance_of_remaining_area").attr('value',numberWithCommas(balance.toFixed(2)));
        }

        function nonProfitDuty()
        {
            var remaining_area_of_resident_area_balance = (!cleanNumber($("#remaining_area_of_resident_area_balance").val()) || isNaN(cleanNumber($("#remaining_area_of_resident_area_balance").val()))) ? 0 : cleanNumber($("#remaining_area_of_resident_area_balance").val());

            $("#non_profit_duty").attr('value', numberWithCommas(Math.ceil(1 / 4 * remaining_area_of_resident_area_balance)));
            $("#non_profit_duty_installment").attr('value',  numberWithCommas(Math.ceil(1 / 4 * remaining_area_of_resident_area_balance)));
            $("#non_profit_duty_val").attr('value', numberWithCommas(Math.ceil(1 / 4 * remaining_area_of_resident_area_balance)));

            $("#payment_of_remaining_installment").attr('value',numberWithCommas((Math.ceil(1 / 4 * remaining_area_of_resident_area_balance)).toFixed(2)));
        }

        function calculateAmountForMhadaMuncipal()
        {
            var off_site_infrastructure_fee = (!cleanNumber($("#off_site_infrastructure_fee").val()) || isNaN(cleanNumber($("#off_site_infrastructure_fee").val()))) ? 0 : cleanNumber($("#off_site_infrastructure_fee").val());

            $("#amount_to_be_paid_to_municipal1").attr('value',numberWithCommas((5 / 7 * off_site_infrastructure_fee).toFixed(2)));
            $("#offsite_infrastructure_charge_to_mhada1").attr('value',numberWithCommas((2 / 7 * off_site_infrastructure_fee).toFixed(2)));
            $("#offsite_infrastructure_charge_to_mhada1_installment").attr('value',numberWithCommas((2 / 7 * off_site_infrastructure_fee).toFixed(2)));
        }

        function totalAreaOfRgToBeRelocated()
        {
            var area_of_rg_to_be_relocated = (!cleanNumber($("#area_of_rg_to_be_relocated").val()) || isNaN(cleanNumber($("#area_of_rg_to_be_relocated").val()))) ? 0 : cleanNumber($("#area_of_rg_to_be_relocated").val());
            var lr_val = (!cleanNumber($("#redirekner_value").val()) || isNaN(cleanNumber($("#redirekner_value").val()))) ? 0 : cleanNumber($("#redirekner_value").val());

            var total_area = area_of_rg_to_be_relocated * lr_val * 0.10;

            $("#total_area_of_rg_to_be_relocated").attr('value',numberWithCommas((total_area).toFixed(2)));

            $("#groundrent_capitalization_yearly").attr('value',numberWithCommas((total_area* 0.025 *12.5).toFixed(2)));

            $("#advance_groundrent_per_year").attr('value',numberWithCommas((area_of_rg_to_be_relocated * lr_val  * 0.08 * 1.5).toFixed(2)));

        }

        $(document).on("keyup", "#area_of_rg_to_be_relocated", function () {

            totalAreaOfRgToBeRelocated();
        });

        $(document).on("keyup", "#total_no_of_buildings", function () {

            var total_no_of_buildings = (!cleanNumber($("#total_no_of_buildings").val()) || isNaN(cleanNumber($("#total_no_of_buildings").val()))) ? 0 : cleanNumber($("#total_no_of_buildings").val());

            $("#debraj_removal_fee").attr('value',numberWithCommas(6600 * total_no_of_buildings));
            $("#water_usage_charges").attr('value',numberWithCommas(100000 * total_no_of_buildings));
            $("#scrutiny_fee").attr('value',numberWithCommas(6000 * total_no_of_buildings));

            totalAmountInRs();
        });

        $(document).on("keyup", ".total_area", function () {

            areaOfTotalPlot();

            areaOfSubsistenceToCalculate();

        });

        $(document).on("keyup", "#area_as_per_introduction", function () {

            areaOfSubsistenceToCalculate();
        });


        $(document).on("keyup", ".permissible_area", function () {

            permissibleConstructionArea();
        });


        $(document).on("keyup", ".proratata_area", function () {

            var sqm_area_per_slot = (!cleanNumber($("#sqm_area_per_slot").val()) || isNaN(cleanNumber($("#sqm_area_per_slot").val()))) ? 0 : cleanNumber($("#sqm_area_per_slot").val());
            var total_house = (!cleanNumber($("#total_house").val()) || isNaN(cleanNumber($("#total_house").val()))) ? 0 : cleanNumber($("#total_house").val());

            $("#permissible_proratata_area").attr('value',numberWithCommas((sqm_area_per_slot * total_house).toFixed(2)));
        });

        $(document).on("keyup", "#per_sq_km_proyerta_construction_area", function () {

            proratataConstructionArea();
        });

        $(document).on("keyup", "#total_house", function () {

            proratataConstructionArea();

            var total_house = (!cleanNumber($("#total_house").val()) || isNaN(cleanNumber($("#total_house").val()))) ? 0 : cleanNumber($("#total_house").val());

            $("#layout_approval_fee").attr('value',numberWithCommas(1000 * total_house));

            totalAmountInRs();
        });


        $(document).on("keyup", ".total_permissible", function () {

            var permissible_construction_area = (!cleanNumber($("#permissible_construction_area").val()) || isNaN(cleanNumber($("#permissible_construction_area").val()))) ? 0 : cleanNumber($("#permissible_construction_area").val());
            var proratata_construction_area = (!cleanNumber($("#proratata_construction_area").val()) || isNaN(cleanNumber($("#proratata_construction_area").val()))) ? 0 : cleanNumber($("#proratata_construction_area").val());
            var area_in_reserved_seats_for_vp_pio = (!cleanNumber($("#area_in_reserved_seats_for_vp_pio").val()) || isNaN(cleanNumber($("#area_in_reserved_seats_for_vp_pio").val()))) ? 0 : cleanNumber($("#area_in_reserved_seats_for_vp_pio").val());


            var total = (parseFloat(permissible_construction_area) + parseFloat(proratata_construction_area) + parseFloat(area_in_reserved_seats_for_vp_pio)).toFixed(2);

            $("#total_permissible_construction_area").attr('value',numberWithCommas(total));
        });

        $(document).on("keyup", ".remaining_area", function () {

            if(parseFloat(cleanNumber($("#total_permissible_construction_area").val())) < parseFloat(cleanNumber($("#existing_construction_area").val()))) {
                alert('अस्तित्वातील बांधकाम क्षेत्रफळ should be less than एकूण अनुज्ञेय बांधकाम क्षेत्रफळ');
                return false;

            }

            var total_permissible_construction_area = (!cleanNumber($("#total_permissible_construction_area").val()) || isNaN(cleanNumber($("#total_permissible_construction_area").val()))) ? 0 : cleanNumber($("#total_permissible_construction_area").val());
            var existing_construction_area = (!cleanNumber($("#existing_construction_area").val()) || isNaN(cleanNumber($("#existing_construction_area").val()))) ? 0 : cleanNumber($("#existing_construction_area").val());

            var sub = (parseFloat(total_permissible_construction_area) - parseFloat(existing_construction_area)).toFixed(2);

            $("#remaining_area").attr('value',numberWithCommas(sub));

            $("#remaining_residential_area").attr('value',numberWithCommas(sub));

            if ($('input[type=radio][name=dcr_rate_in_percentage]').is(':checked')) {

                calculatedDcrBalanceOfRemainingArea();
            }

        });


        $(document).on("keyup", ".redirekner_val", function () {

            if (parseFloat(cleanNumber($("#redirekner_construction_rate").val())) === 0 || isNaN(parseFloat(cleanNumber($("#redirekner_construction_rate").val())))) {
                $("#redirekner_val").attr('value',null);
            } else {
                var div = parseFloat(cleanNumber($("#redirekner_value").val())) / parseFloat(cleanNumber($("#redirekner_construction_rate").val()));
                $("#redirekner_val").attr('value',numberWithCommas(div.toFixed(2)));
            }

            calculatedDcrBalanceOfRemainingArea();

            totalAreaOfRgToBeRelocated();
        });


        $(document).on("change", "input[type=radio][name=dcr_rate_in_percentage]", function () {


            calculatedDcrBalanceOfRemainingArea();


            totalAmountInRs();

        });


        $(document).on("keyup", "#redirekner_value", function () {

            var remaining_area = (!cleanNumber($("#remaining_area").val()) || isNaN(cleanNumber($("#remaining_area").val()))) ? 0 : cleanNumber($("#remaining_area").val());
            var redirekner_value = (!cleanNumber($("#redirekner_value").val()) || isNaN(cleanNumber($("#redirekner_value").val()))) ? 0 : cleanNumber($("#redirekner_value").val());

            var fee_amount = (parseFloat(remaining_area) * parseFloat(redirekner_value) * (7 / 100)).toFixed(2);
            $("#infrastructure_fee_amount").attr('value',numberWithCommas(fee_amount));
            $("#amount_to_be_paid_to_municipal").attr('value',numberWithCommas((5 / 7 * fee_amount).toFixed(2)));
            $("#offsite_infrastructure_charges_to_municipal_corporation").attr('value',numberWithCommas(Math.ceil(5 / 7 * fee_amount)));
            $("#offsite_infrastructure_charge_to_mhada").attr('value',numberWithCommas((2 / 7 * fee_amount).toFixed(2)));

            totalAmountInRs();

            calculatedDcrBalanceOfRemainingArea();

            totalAreaOfRgToBeRelocated();

        });

        $(document).on("change paste keyup", ".total_amount", function () {
            totalAmountInRs();
        });

        $(document).on("keyup", "#remaining_area_of_resident_area_balance", function () {
            nonProfitDuty();
        });


        $(document).on("keyup", "#off_site_infrastructure_fee", function () {

            calculateAmountForMhadaMuncipal();
        });


        $(document).on("keyup", ".first_installment", function () {

            var first_installment = 0;
            $(".first_installment").each(function () {
                var installmentVal = (!cleanNumber($(this).val()) || isNaN(cleanNumber($(this).val()))) ? 0 : cleanNumber($(this).val());
                first_installment += +parseFloat(installmentVal);
            });
            $("#payment_of_first_installment").attr('value',numberWithCommas(Math.ceil(first_installment)));
        });

        function PrintElem(elem) {
            $(".printBtn").css("display","none");
            var printable = document.getElementById(elem).innerHTML;
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>Maharashtra Housing and development authority</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(printable);
            mywindow.document.write('</body></html>');

            mywindow.document.close();
            mywindow.focus();

            mywindow.print();
            mywindow.close();
            $(".printBtn").css("display","block");
            return true;
        }

        $("#uploadBtn").click(function () {
            myfile = $("#test-upload").val();
            var ext = myfile.split('.').pop();
            if (myfile != '') {

                if (ext != "pdf") {
                    $("#file_error").text("Invalid type of file uploaded (only pdf allowed).");
                    return false;
                } else {
                    $("#file_error").text("");
                    return true;
                }
            } else {
                $("#file_error").text("This field required");
                return false;
            }
        });

        $(document).ready(function () {
            $(".display_msg").delay(5000).slideUp(300);


            calculateAmountForMhadaMuncipal();

            nonProfitDuty();

            var first_installment = 0;
            $(".first_installment").each(function () {
                var installmentVal = (!cleanNumber($(this).val()) || isNaN(cleanNumber($(this).val()))) ? 0 : cleanNumber($(this).val());
                first_installment += +parseFloat(installmentVal);
            });
            $("#payment_of_first_installment").attr('value',numberWithCommas(Math.ceil(first_installment)));

            // $("#payment_of_remaining_installment").attr('value',numberWithCommas(Math.ceil($("#non_profit_duty").val())));


        });

    </script>
@endsection
