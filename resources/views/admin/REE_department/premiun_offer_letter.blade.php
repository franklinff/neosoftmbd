<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
@php $ntw = new \NTWIndia\NTWIndia(); @endphp
<div class="m_portlet">
    <form id="OfferLetterFRM" action="{{ route('ree.save_offer_letter')}}" method="post">
        @csrf
        <input type="hidden" id="applicationId" name="applicationId" value="{{$applicatonId}}">
        <textarea id="ckeditorText" name="ckeditorText" style="display:none">
        @if($content != "")
            {{$content}}
        @else
        <div style="" id="">


                <!-- Header starts here -->
                <div>
                    <div style="margin-top: 30px; text-align: right;">
                        <div style="float: left; width: 56%;"></div>
                        <div style="float: left; width: 44%;">
                            <div style="text-align: left;">
                                <span>No.CO/MB/REE/NOC/F-1008/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2018</span>
                            </div>
                            <div style="text-align: left;">
                                <span>Date:</span>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                    <h3 style="text-decoration: underline; text-align: center; margin-bottom: 30px;">Offer Letter</h3>
                    <div>
                        <p style="margin-bottom:0; line-height:0.25;">To,</p>
                        <span style="margin-bottom:0; line-height:0.25;">The Secretary,</span>
                        <p style="margin-bottom:0; line-height:0.25;">{{$calculationData->eeApplicationSociety->name}}</p>
                        <p style="margin-bottom:0; line-height:0.25;">Building No.
                        <span style="font-weight: bold;">{{($calculationData->eeApplicationSociety->building_no ? $calculationData->eeApplicationSociety->building_no : '')}}</span></p>
                        <p style="margin-bottom:0; line-height:0.25;">_______________________________________</p>
                        <!-- <p style="margin-bottom:0; line-height:0.25;">Mumbai - 400 083.</p> -->
                    </div>
                </div>

                <!-- Header ends here -->

                <!-- Subject starts here -->

                <div style="padding-left: 50px; margin-top: 30px; line-height: 1.5;">

                    <table style="width: 100%; border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td valign="top" style="border: 1px solid #000; text-align: center; padding: 5px;">Sub:</td>
                                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                                    Proposed redevelopment of existing building <span style="font-weight: bold;"> {{($calculationData->eeApplicationSociety->building_no ? $calculationData->eeApplicationSociety->building_no : '')}} </span>,
                                    known as <span style="font-weight: bold;"> {{($calculationData->eeApplicationSociety->name ? $calculationData->eeApplicationSociety->name : '')}} ( {{($calculationData->eeApplicationSociety->address ? $calculationData->eeApplicationSociety->address : '')}} )</span>  under DCR 33(5) dated
                                    08.10.2013 & it's modification dtd. 03.07.2017.
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" style="border: 1px solid #000; text-align: center; padding: 5px;">Ref:</td>
                                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                                    <span style="display: block; margin-bottom: 4px;">1. Society's letter dated  <span style="font-weight: bold;">{{($calculationData->submitted_at ? date('d-m-Y',strtotime($calculationData->submitted_at)) : '')}} </span></span>
                                    <span style="display: block;">2. Hon'ble V.P./A's approval <span style="font-weight: bold;"> {{($calculationData->vpDate ? date('d-m-Y',strtotime($calculationData->vpDate)) : '')}}. </span></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--  -->
                <!-- Subject ends here -->

                <!-- Letter Body starts here --> 
                <div style="line-height: 1.5;">
                    <p style="margin-bottom: 5px;">Sir,</p>
                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">With reference to the above, you have submitted subjective proposal for utilization of additional BUA & balance BUA of layout under
                        DCR 33(5) dated 08.10.2013 & it's modification dtd. 03.07.2017, your proposal is approved By
                        Competent authority.</p>

                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">Allotment of additional buildable area of <span style="font-weight: bold"> {{ $calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->remaining_area : ""}} m<sup>2</sup> </span> (for residential use)[i.e. ___________ in the form of additional BUA + <span style="font-weight: bold;"> {{ ($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->proratata_construction_area : '' }} m<sup>2</sup> </span> in the form of balance built up area of layout (Pro-rata)] over and above <span style="font-weight: bold;"> {{ ($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->existing_construction_area : ''}} m<sup>2</sup> </span>
                        existing built up area.</p>
                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">
                    The above allotment is on sub-divided plot as per layout admeasuring about <span style="font-weight: bold"> {{ ($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->area_of_subsistence_to_calculate : '' }} m<sup>2</sup> </span> 

                    (i.e. <span style="font-weight: bold"> {{ ($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->area_as_per_lease_agreement : '' }} m<sup>2</sup> </span> Lease Area +
                    <span style="font-weight: bold"> {{ ($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->area_of_tit_bit_plot : '' }} m<sup>2</sup> </span>

                    Tit Bit area). The total built up area should be permitted up to existing BUA <span style="font-weight: bold"> {{ ($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->existing_construction_area : '' }} m<sup>2</sup> </span> m<sup>2</sup>
                        
                        + <span style="font-weight: bold"> {{($calculationData->premiumCalculationSheet !="") ? $calculationData->premiumCalculationSheet->remaining_area : ''}} m<sup>2</sup> </span> (for residential use)[i.e. ___________ m<sup>2</sup> in the form of additional BUA + <span style="font-weight: bold"> {{ ($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->proratata_construction_area : '' }} m<sup>2</sup></span> in
                        the form of balance built up area of layout (Pro-rata)] thus total BUA = <span style="font-weight: bold"> {{($calculationData->premiumCalculationSheet != "") ? $calculationData->premiumCalculationSheet->total_permissible_construction_area : ''}} m<sup>2</sup> </span> only.</p>
                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">MHADA's resolution no.6260
                        dt.04.06.2007, AR 6615 dt.06.08.2013, AR 6349 dt.25.11.2008, AR No.6383 dt.24.02.2009, AR No.6397
                        dt.05.05.2009, AR No.6422 dt.07.08.2009 & Revised DCR 33(5) dated 03.07.2017 are applicable in the
                        instant case.</p>
                    <p style="text-indent: 25px; margin-top: 5px; margin-bottom: 5px;">It is to inform you that Hon'ble
                        V.P./A has considered your request for allowing to make payment of premium in Four installments as
                        per Authority resolution No. 6749, dated 11.07.2017 as mentioned below:</p>
                </div>

                <!-- Letter Body ends here -->

                <!-- Table 1 starts here -->
                @if($custom == '1')
                <div>
                    <h3 style="text-transform: uppercase; font-weight: bold; text-decoration: underline; text-align: center;">Table-1</h3>
                    <table style="width: 100%; text-align: center; border-collapse: collapse;">
                        <thead style="text-align: center;">
                            <tr>
                                <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                                <th style="width: 65%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                                <th style="border: 35% solid #000; padding: 5px 10px">Amount in Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($table1 as $value)
                            
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">{{$i}}</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">{{ isset($value['title']) ? $value['title'] : '' }}</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> <span style="font-weight: bold">{{ isset($value['amount']) ? $value['amount'] : '' }} </td>
                            </tr> 
                        @php $i++; @endphp
                        @endforeach    
                        </tbody>
                    </table>
                </div>                          
                @else
                <div>
                    <h3 style="text-transform: uppercase; font-weight: bold; text-decoration: underline; text-align: center;">Table-1</h3>
                    <table style="width: 100%; text-align: center; border-collapse: collapse;">
                        <thead style="text-align: center;">
                            <tr>
                                <th style="width: 10%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                                <th style="width: 65%; border: 1px solid #000; padding: 5px 10px">Particular</th>
                                <th style="width: 35%; border: 1px solid #000; padding: 5px 10px">Amount in Rs.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">1.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Scrutiny Fees (
                                    Residential Use )</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->scrutiny_fee : '')}} </td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">2.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Debris Removal Rs.
                                    6600/- Per Bldg.</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->debraj_removal_fee : '')}} </span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">3.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Layout approval
                                    fees (Rs. 1,000/- X 32 T/s)</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold"> {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->layout_approval_fee : '')}} </span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">4.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Deposit Amount for
                                    Water Charges as per CE-II / A's Circular dated 02.06.2009</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold"> {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->water_usage_charges : '')}}</span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">5.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Ready Reckoner
                                    Rate of 2018-19
                                    (CTS No. 351 (pt), Hariyali, Tagore Nagar)</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->redirekner_value : '')}}</span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">6.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rate of
                                    Construction </td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->redirekner_construction_rate : '')}}</span></td>
                            </tr>
                            <tr> 
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">7.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">LR /RC Ratio
                                    (55,900.00 / 27,500.00)</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->redirekner_val : '')}}</span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">8.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Premium towards
                                    additional buildable area for use of <span style="font-weight: bold"> {{$calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->remaining_area : ''}} m<sup>2</sup> </span> sq. mt. by charging Rs.
                                    ___________@ ___________ current Ready Reckoner Rate of 2018-19 (i.e. ___________ of Rs.<span style="font-weight: bold"> {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->calculated_dcr_rate_val : '')}}/-) </span> as per
                                    Table C-1, in DCR 33(5),dated 03.07.2017. </td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->balance_of_remaining_area : '')}} </span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">9.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Offsite
                                    infrastructure charges
                                    (RR Rate 2018-19 Rs. {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->redirekner_value : '')}} /- x 7%) x (Permissible BUA as per 3.0 FSI ___________ m2 +
                                    ___________ m<sup>2</sup> balance BUA of layout (Pro-rata ) - (Existing BUA <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->existing_construction_area : '')}} m<sup>2</sup></span>) =  (
                                    <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->remaining_area : '')}} m<sup>2</sup></span> X <span style="font-weight: bold"> 

                                    {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->redirekner_value : '')}} X 7%)</span></td>
                                
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->infrastructure_fee_amount : '')}}</span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">10.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid
                                    to MCGM
                                    (5/7 of Sr. No. 09)</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"> <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->amount_to_be_paid_to_municipal : '')}}</span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">11.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Amount to be paid
                                    to MHADA (2/7 of Sr.No. 09)</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->offsite_infrastructure_charge_to_mhada : '')}}
                                </span></td>
                            </tr>                            
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">For R.G. relocation Rs. <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->redirekner_value : '')}}
                                </span>/- (10% of Rs <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->redirekner_value : '')}} </span> per m2 of R. R. 2017-18 ) *

                                 {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->area_of_rg_to_be_relocated : '')}}   </td>

                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->total_area_of_rg_to_be_relocated : '')}}
                                </span></td>
                            </tr>                            
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Capitalization of lease rent annual 2.5%</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->groundrent_capitalization_yearly : '')}}
                                </span></td>
                            </tr>                           
                             <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Advance Lease rent 8%</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->advance_groundrent_per_year : '')}}
                                </span></td>
                            </tr>                            
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Nominal Lease rent</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;">
                                <span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->nominal_groundrent : '')}}
                                </span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">12.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be
                                    paid to MHADA <table style="width: 100%;">
                                        <tr>
                                            <td style="font-size: 12px;">( Sr.No.1+2+3+4+8+11)</td>
                                            <td style="text-align: right;">Say Amount</td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold">{{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->total_amount_in_rs : '')}} </span></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                <td colspan="2" style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Rs.
                                    {{  $ntw->numToWord((($calculationData->premiumCalculationSheet) != "" && ($calculationData->premiumCalculationSheet->total_amount_in_rs) != "") ? str_replace( ',', '',$calculationData->premiumCalculationSheet->total_amount_in_rs) : 0 ) }}</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;"></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left;">Total Amount to be
                                    paid to MCGM (Sr.No. 10)</td>
                                <td style="border: 1px solid #000;padding: 5px 10px; text-align: center;"><span style="font-weight: bold"> {{(($calculationData->premiumCalculationSheet != "" 
                                && $calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation != "") ? str_replace(',', '',$calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation) : 0)}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif

                <!-- Table 1 ends here -->

                <!-- Table 2 starts here -->

                <div style="margin-top: 100px;">

                    <div style="text-align: center;">
                        <h3 style="text-transform: uppercase; font-weight: bold;">As per Authority Resolution No. 6749 dt.
                            11/07/2017 payment of premium to be allowed in four installments is as under.</h3>
                        <h3 style="text-transform: uppercase; font-weight: bold; text-decoration: underline;">Table 2</h3>
                        <p style="line-height: 1.25; margin-bottom: 0;">Payment of Premium & Other Charges payable to
                            MHADA.</p>
                    </div>

                    <table style="width: 100%; text-align: center; border-collapse: collapse;">
                        <thead style="text-align: center;">
                            <tr>
                                <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Sr.No</th>
                                <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Installments</th>
                                <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Minimum Amount of Installments</th>
                                <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Time Limit from the issue of
                                    Offer Letter for payment of Installment</th>
                                <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Penalty Interest in case delay
                                    in payment</th>
                                <th style="width: 4%; border: 1px solid #000; padding: 5px 10px">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; font-weight: bold;">A</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; font-weight: bold;">B</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; font-weight: bold;">C</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; font-weight: bold;">D</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; font-weight: bold;">E</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; font-weight: bold;">F</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 4%;">1)</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 5%;">First
                                    Installment</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 5%;"><span style="font-weight: bold"> 
                            @if($custom == '1')
                                {{ isset($summary['within_6months']) ? $summary['within_6months'] : '' }}
                            @else
                                {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->payment_of_first_installment : '')}} 
                            @endif    
                                </span></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 10%;"><span style="font-weight: bold"> 6 Months </span> from the date of offer letter issued.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;"> 
                                a) Compound Interest @ 12% or prime lending rate (PLR) as decide by SBI whichever is higher to be calculated from the date of offer letter issued, up to date of payment (Calculated every three Months i.e. quarterly) as the amercible interest.
                                b) The Premium will be calculated as per prevailing R.R. rate at the time of actual payment to be made.
                                </td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;">If the premium amount as per 'b' is more from a & b calculated in column no. E then the new offer letter will be issued as per new Ready Reckonr rate & accordingly new rate also applicable for further instalment.</td>
                            </tr>

                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 4%;">2)</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 20%;">Second
                                    Installment</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 25%;"><span style="font-weight: bold"> 
                                @if($custom == '1')
                                    {{ isset($summary['within_1year']) ? $summary['within_1year'] : '' }}
                                @else
                                    {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->payment_of_remaining_installment : '')}} 
                                @endif 
                                </span></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 21%;">Within
                                    <span style="font-weight: bold"> ONE year </span> from the date of offer letter issued </td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;">Compound Interest @ 12% or prime lending rate (PLR) as decide by SBI whichever is higher to be calculated from the date of offer letter issued, up to date of payment (Calculated every three Months i.e. quarterly) as the amercible interest.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;">The amercible interest will be applicable on aggregate amount as per column No. C.</td>
                            </tr>

                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 4%;">3)</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 20%;">Third
                                    Installment</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 25%;"><span style="font-weight: bold"> 
                                @if($custom == '1')
                                    {{ isset($summary['within_2year']) ? $summary['within_2year'] : '' }}
                                @else
                                    {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->payment_of_remaining_installment : '')}} 
                                @endif 
                                </span></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 21%;">Within
                                    <span style="font-weight: bold"> TWO years </span> from the date of offer letter issued.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;">Compound Interest @ 12% or prime lending rate (PLR) as decide by SBI whichever is higher to be calculated from the date of offer letter issued, up to date of payment (Calculated every three Months i.e. quarterly) as the amercible interest.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;">The amercible interest will be applicable on aggregate amount as per column No. C.</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 4%;">4)</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 20%;">Fourth
                                    Installment</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: center; width: 25%;"><span style="font-weight: bold"> 
                                @if($custom == '1')
                                    {{ isset($summary['within_3year']) ? $summary['within_3year'] : '' }}
                                @else
                                    {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->payment_of_remaining_installment : '')}} 
                                @endif                                 
                                </span></td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 21%;">Within
                                    <span style="font-weight: bold"> THREE years </span> the date of first offer letter issued.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;">Compound Interest @ 12% or prime lending rate (PLR) as decide by SBI whichever is higher to be calculated from the date of offer letter issued, up to date of payment (Calculated every three Months i.e. quarterly) as the amercible interest.</td>
                                <td style="border: 1px solid #000; padding: 5px 10px; text-align: left; width: 30%;">The amercible interest will be applicable on aggregate amount as per column No. C.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table 2 ends here -->

                <div style="margin-top: 60px; line-height: 1.5">
                    <p style="margin-bottom: 5px; margin-top: 5px;">1) As per the above Table no. 2, society will have to
                        make payment of first installment to MHADA and MCGM WITHIN SIX MONTHS and remaining THREE
                        installments within stipulated time limit as per Table no. 2. If society fails to make payment as
                        per above schedule then penalty/interest shall be charged as per A.R. no. 6749 dt. 11/07/2017.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">2) If society fails to make this payment of first
                        installment to MHADA and MCGM within six months then the Offer Letter will stand cancelled.
                        Thereafter, whenever the society will apply for revised offer letter it will be issued as per
                        prevailing policy of MHADA.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">3) Your society will have to submit an undertaking on
                        stamp paper of Rs.250/- for agreeing all the terms and conditions mentioned in the Annexure – I,
                        then only NOC will be issued to the subjective proposal.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">4) The Society's Architect will have to verify the plot
                        area and dimension as per site report given by Executive Engineer/Housing Kurla Division and submit
                        report about confirmation.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">5) This allotment is subject to payment of Stamp duty
                        if / as and when may be imposed by the Govt. of Maharashtra (Under the relevance provisions of
                        Maharashtra Stamp Duty Act. The allottee will have to submit an Undertaking to this effect on Stamp
                        paper worth Rs.100/-)</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">6) M.C.G.M. has incurred expenditure for onsite
                        infrastructure prior to modification in D.C.R. 33(5) & after modification in D.C.R. 33(5).The
                        pro-rata premium shall be payable by the applicant and the pro-rata premium of revised layout under
                        DCR 33(5) shall also payable by applicant as and when communicated, a notarized undertaking
                        incorporating above shall be submitted in this office before final NOC.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">7) Your society will have to submit No dues certificate
                        from concerned Estate Manager before issue of NOC. </p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">8) Your society will have to submit Property cards and
                        CTS Plans as per approved sub-division Plot area before issue of OC.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">9) All conditions in lease deed & sale deed are
                        applicable to the society.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">10) The society shall execute a Supplementary Lease
                        Deed with the Mumbai Board for allotment of additional Tit Bit area of –––––––––– m<sup>2</sup> before asking for
                        consent letter for Occupation Certificate</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">11) Your society will have to submit duly signed &
                        registered development agreement before NOC.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">12) It is binding on society to pay any arrears if any
                        for the earlier NOC issued more particularly on site and / or offsite infrastructure charges as and
                        when communicated by Mumbai Board.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">13) MHADA reserve it's right to withdraw, change,
                        alter, amend their offer letter and conditions mentioned therein in future at any point of time
                        without giving any reason to do so.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">14) It should be sole responsibility of society to obtain the approval of plans from EE,BP Cell, Greater Mumbai / MHADA and this allotment is made subject to approval of EE,BP Cell, Greater Mumbai / MHADA.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">15) The society should have to submit the rectification
                        / Correction in CTS No. in the sale deed / lease deed as per CTS plan and PR card before issuance
                        of NOC for said building if applicable.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">16) Your society will abide by all terms and conditions
                        as may be given under NOC letter.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">An amount of Rs. <span style="font-weight: bold"> {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation : 0)}} /- </span>(Rs.  {{  $ntw->numToWord(($calculationData->premiumCalculationSheet !="" && $calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation) !="" ? str_replace( ',', '',$calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation) : 0 ) }}) may be paid in the office of the Assistant
                        Accounts Officer/ Mumbai Board, Third Floor, Griha Nirman Bhavan, Bandra (E), Mumbai – 400051 by
                        Demand Draft/ Pay Order within <span style="font-weight: bold"> SIX months </span> from the date of issue of this letter and produce
                        certified Xerox copy of the receipt in this office.</p>

                    <p style="margin-bottom: 5px; margin-top: 5px;">Your society should pay offsite infrastructure charges
                        as per modified DCR 33(5) clause (5) an amount of Rs. <span style="font-weight: bold"> {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation : 0)}} /- </span> (In words Rs. {{  $ntw->numToWord(($calculationData->premiumCalculationSheet !="" && $calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation !="") ? str_replace( ',', '',$calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation) : 0 ) }}) payable to MCGM, in the office of the Executive
                        Engineer, Building Permission Cell, Greater Mumbai, MHADA, Bandra (E),Mumbai 400 051., within <span style="font-weight: bold"> SIX
                        months </span> from the date of issue of this letter and produce certified Xerox copy of the receipt in
                        this office.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">On receipt of the same the NOC for IOD / IOA purpose
                        will be processed & NOC for Commencement Certificate will be processed as per payment of premium &
                        Other Charges paid to MHADA as per Table -2, under certain terms and condition, which may please,
                        be noted.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;">17) Society has to ensure that Contractors / Sub-Contractors appointed by the society or Developer of the society, who are in charge of construction work; shall be registered with MBOCWW Board & are required to fulfill the obligations as contemplated in Building and other construction workers(Regulation of Employment and condition of service)Act, 1996. And further these Contractors / Sub-Contractors are required to fulfill all conditions stipulated in the above Act, for the benifits of Workers. </p>    
                    <p style="margin-bottom: 5px; margin-top: 5px;">Encl.: Annexure-I </p>
                    <p style="margin-bottom: 5px; margin-top: 5px; font-weight: bold;">(Draft approved by CO/MB) </p>
                    <div>
                        <div style="float: left; width: 70%">
                        </div>
                        <div style="margin-bottom: 5px; margin-top: 5px; font-weight: bold; float: left; width: 30%;">
                            <div style="text-align: center;">
                                <span style="display: block;">Sd/-</span>
                                <span style="display: block;">{{ isset($ree_head) ? $ree_head : ''  }}</span>
                                <span style="display: block; font-weight: bold;">Resident Executive Engineer.</span>
                                <span style="display: block; font-weight: bold;">M. H. & A. D. Board</span>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>

                <div style="margin-top: 30px; line-height: 1.5;">
                    <p style="margin-bottom: 5px; margin-top: 5px;"><span style="font-weight: bold;">Copy to The Executive
                            Engineer, </span>Building Permission Cell, Greater Mumbai, MHADA, Bandra (E),Mumbai 400 051.You
                        are requested to accept the payment of<span style="font-weight: bold"> Rs. {{($calculationData->premiumCalculationSheet != "" ? $calculationData->premiumCalculationSheet->offsite_infrastructure_charges_to_municipal_corporation : 0)}} /- </span></span>/- towards offsite infrastructure charges
                        payable to MCGM.</p>
                    <p style="margin-bottom: 5px; margin-top: 5px;"><span style="font-weight: bold;">Copy to Architect for
                            information: </span>{{($calculationData->premiumCalculationSheet != "" ? $calculationData->eeApplicationSociety->name_of_architect : '')}}, {{($calculationData->premiumCalculationSheet != "" ? $calculationData->eeApplicationSociety->architect_address : '')}} for information.</p>
                    <div style="margin-bottom: 5px; margin-top: 5px;">
                        <span style="font-weight: bold; display: block;">Copy forwarded for information and necessary
                            action in the matter to: -</span>
                        <p style="margin-bottom: 5px; margin-top: 5px;">1) Architect, Layout Cell, Mumbai Board</p>
                        <p style="margin-bottom: 0; margin-top: 15px;">2) Executive Engineer Kurla Division</p>
                        <div style="padding-left: 15px;">
                            <div style="float: left; width: 4%;">i.</div>
                            <div style="float: left; width: 96%;">He is directed to take necessary action as per
                                demarcation & as per prevailing policy of MHADA.</div>
                            <div style="clear: both;"></div>
                            <div style="float: left; width: 4%;">ii.</div>
                            <div style="float: left; width: 96%;">He is directed to recover all the dues from the society
                                concerned to Estate Department & intimate the same to this office.</div>
                            <div style="clear: both;"></div>
                            <div style="float: left; width: 4%;">iii.</div>
                            <div style="float: left; width: 96%;">He is directed to recover any dues, land revenue, audit
                                remarks concerned to Land Department if any pending with the society & intimate the same to
                                this office.</div>
                            <div style="clear: both;"></div>
                        </div>
                        <p style="margin-bottom: 0; margin-top: -10px;">3) Chief Accounts Office/M.B.
                            <div style="text-indent: 50px; margin-top: 2px;">He is directed to recover the amount of
                                offer letter on time & furnish certified copy to this office. As well as check above
                                calculation of offer letter thoroughly. If any changes/irregularities found in the said
                                offer letter intimate to this office accordingly.</div></p>
                        <p style="margin-bottom: 0; margin-top: -50px;">4) Shri. Jadhav/ Sr. Clerk for MIS record.</p>
                    </div>
                    <div>
                        <div style="float: left; width: 70%">
                        </div>
                        <div style="margin-bottom: 5px; margin-top: 5px; font-weight: bold; float: left; width: 30%;">
                            <div style="text-align: center;">
                                <span style="display: block;">Sd/-</span>
                                <span style="display: block;">{{ isset($ree_head) ? $ree_head : ''  }}</span>
                                <span style="display: block; font-weight: bold;">Resident Executive Engineer.</span>
                                <span style="display: block; font-weight: bold;">M. H. & A. D. Board</span>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>

                <!-- Annexure-I starts here -->

                <div style="margin-top: 30px; line-height: 1.5;">
                    <h3 style="text-transform: uppercase; font-weight: bold; text-align: center;">Annexure - I</h3>
                    <p style="margin-bottom: 5px; margin-top: 5px; text-indent: 5%;">The proposed work of redevelopment of
                        the existing building No.{{($calculationData->eeApplicationSociety->building_no ? $calculationData->eeApplicationSociety->building_no : '')}}, known as  ______________________________  under DCR 33(5) dated 03.07.2017 will be
                        undertaken by the society as per following terms and conditions :-</p>
                </div>

                <div style="margin-top: 30px; line-height: 1.5;">
                    <h3 style="text-transform: uppercase; font-weight: bold; text-align: center;">TERMS AND CONDITIONS</h3>
                    <div>
                        <div style="width: 4%; float: left;">1.</div>
                        <div style="width: 96%; float: left;">All the terms and conditions mentioned in the lease agreement
                            & conveyance is binding on the society.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">2.</div>
                        <div style="width: 96%; float: left;">The society will have to obtain separate P. R. card as per the approved additional area leased out by the board duly signed by S. L. R. before asking for consent letter for Occupation Certificate of EE,BP Cell, Greater Mumbai / MHADA.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">3.</div>
                        <div style="width: 96%; float: left;">This offer letter will not be misused for taking out any kind
                            of permission from any departments.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">4.</div>
                        <div style="width: 96%; float: left;">The work of the proposed demolition & reconstruction of the
                            new building will be undertaken by the society entirely at the risk and cost of the society and MHADA / MHADA will not be held responsible for any kind of damages or losses.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">5.</div>
                        <div style="width: 96%; float: left;">The society will undertake & entrust responsibility of the planning, designing approval from EE, BP Cell, Greater Mumbai / MHADA & day to day supervision of the proposed demolition and reconstruction / development of the new building by the Licensed Architect registered with the council of Architecture and licensed Structural Engineer.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">6.</div>
                        <div style="width: 96%; float: left;">The society is responsible for obtaining all necessary
                            permissions & approvals for utilization of additional BUA from the EE,BP Cell, Greater Mumbai / MHADA & other concerned authorities (such as MOEF, MCZM, forest etc) before starting of the work & MHADA is not responsible for S EE,BP Cell, Greater Mumbai / MHADA other authorities refuse to give permission for development of society's proposal.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">7.</div>
                        <div style="width: 96%; float: left;">Society will be responsible for any kind of litigation or
                            legal consequence arising an account of the proposed of the building.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">8.</div>
                        <div style="width: 96%; float: left;">All the terms & conditions mentioned in the offer letter No.
                            CO/MB/REE/NOC/F-1008/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/2018
                            is binding on the society.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">9.</div>
                        <div style="width: 96%; float: left;">Any kind of payment or constructed tenement asked by the
                            MHADA will be fulfilled by the society.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">10.</div>
                        <div style="width: 96%; float: left;">No additional FSI will be utilized by the society other than
                            permitted by the MHADA.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">11.</div>
                        <div style="width: 96%; float: left;">The work will be carried out within the land underneath and
                            appurtenant as per approved sub-divisions, demarcation and plot area allotted by the concerned
                            department of MHADA.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">12.</div>
                        <div style="width: 96%; float: left;">Responsibility of any damage or loss of adjoining properties
                            if any will vest entirely with the applicant and MHADB will not be responsible in any manner.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">13.</div>
                        <div style="width: 96%; float: left;">The user of the proposed development / redevelopment will be
                            as permitted by the MHADA.</div>
                        <div style="clear: both;"></div> 
                        <div style="width: 4%; float: left;">14.</div>
                        <div style="width: 96%; float: left;">The society will have to construct and maintain separate underground water tank, pump house and over-head tank to meet requirement of the proposed buildings and obtain separate water meter & water connection as per approvals of EE,BP Cell, Greater Mumbai / MHADA.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">15.</div>
                        <div style="width: 96%; float: left;">The Society will construct compound wall along boundary line
                            of the plot allotted by the Board and as per the demarcation given by the concerned Executive
                            Engineer / M.B.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">16.</div>
                        <div style="width: 96%; float: left;">Society will hand over the set back to MCGM at their own
                            cost.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">17.</div>
                        <div style="width: 96%; float: left;">The society at its cost will undertake up-gradation of all existing infrastructure and also carry-out laying of new infrastructural services at its cost as suggested by EE,BP Cell, Greater Mumbai / MHADA,  and any other concerned Authority.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">18.</div>
                        <div style="width: 96%; float: left;">All the terms and conditions of the layout approval of the EE,BP Cell, Greater Mumbai / MHADA will be binding on the society.</div>
                        <div style="clear: both;"></div>
                        <div style="width: 4%; float: left;">19.</div>
                        <div style="width: 96%; float: left;">MHADA reserve it's right to withdraw, change, alter, amend
                            their offer letter and conditions mentioned therein in future at any point of time without
                            giving any reason to do so.</div>
                        <div style="clear: both;"></div>                         

                        <div>
                            <div style="float: left; width: 70%">
                            </div>
                            <div style="font-weight: bold; float: left; width: 30%;">
                                <div style="text-align: center;">
                                <span style="display: block;">(Draft approved by CO/MB)</span>
                                    <span style="display: block;">Sd/-</span>
                                    <span style="display: block;">{{ isset($ree_head) ? $ree_head : ''  }}</span>
                                    <span style="display: block; font-weight: bold;">Resident Executive Engineer.</span>
                                    <span style="display: block; font-weight: bold;">M. H. & A. D. Board</span>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        </div>
                    </div>
                </div>

                <!-- Annexure-I ends here -->

            </div>
        </div>
        @endif
        

</textarea> 
        <input type="submit" id="submit" value="save" style="background-color: #f0791b;border-color: #f0791b;color: #fff !important;font-family: Poppins;cursor: pointer;display: inline-block;font-weight: 400;text-align: center;white-space: nowrap;vertical-align: middle;border: 1px solid transparent;transition: all .15s ease-in-out;border-radius: .25rem;line-height: 1.25;padding: .65rem 1.25rem;font-size: 1rem;">

    </form>
    </div>
</body>

</html>

<script src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.replace('ckeditorText', {
        height: 700,
        allowedContent: true
    });
$(document)
// $("#OfferLetterFRM").submit(function(){
//     $("#header_start").css("display","block !important");
//     alert();
// });
</script>
<script>


