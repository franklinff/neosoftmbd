@extends('admin.layouts.app')
@section('content')
<div>
    <div>
        <h3>Bill for {{date('F', mktime(0, 0, 0, $bill->bill_details->bill_month, 10))}}, {{$bill->bill_details->bill_year}}</h3>
        <h3 style="text-decoration: underline; text-align: center;">Receipt for {{date('F', mktime(0, 0, 0, $bill->bill_details->bill_month, 10))}}, {{$bill->bill_details->bill_year}}</h3>
    </div>
    <div>
        <div style="width: 100%; margin-top: 30px;">
            <div style="width: 100%; float: left; margin-bottom: 20px;">
                <div style="width: 30%; float: left;">Consumer No:</div>
                <div style="width: 70%; float: left;">TN-{{$consumer_number}}</div>
            </div>
            <div style="clear:both;"></div>
            <div style="width: 100%;float: left; margin-bottom: 20px;">
                <div style="width: 30%; float: left;">Bill No:</div>
                <div style="width: 70%; float: left;">{{$bill->bill_no}}</div>
            </div>
            <div style="clear:both;"></div>
            <div style="width: 100%; float: left; margin-bottom: 20px;">
                <div style="width: 30%; float: left;">Room No:</div>
                <div style="width: 70%; float: left;">{{$tenant->flat_no}}</div>
            </div>
            <div style="clear:both;"></div>
            <div style="width: 100%;float: left; margin-bottom: 20px;">
                <div style="width: 30%; float: left;">Tenant Name:</div>
                <div style="width: 70%; float: left;">{{$tenant->first_name}} {{$tenant->last_name}}</div>
            </div>
            <div style="clear:both;"></div>
        </div>
    </div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <tbody>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Building name:</td>
                                <td valign="top" style="text-align: right;">{{$building->name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Bill Period:</td>
                                <td valign="top" style="text-align: right;">{{$bill->from_date}} to {{$bill->to_date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Society Name:</td>
                                <td valign="top" style="text-align: right;">{{$society->society_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Bill Date:</td>
                                <td valign="top" style="text-align: right;">{{$bill->bill_details->bill_date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td rowspan="2" valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Address:</td>
                                <td valign="top" style="text-align: right;">{{$society->society_address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Payment Date:</td>
                                <td valign="top" style="text-align: right;">{{date('d-m-Y', strtotime($bill->created_at))}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Late Fee Charge:</td>
                                <td valign="top" style="text-align: right;">{{$bill->bill_details->late_fee_charge}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Amount Paid:</td>
                                <td valign="top" style="text-align: right;">{{$bill->amount_paid}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">
                    <table>
                        <tbody>
                            <tr>
                                <td valign="top" style="font-weight: bold;">Payment Mode:</td>
                                <td valign="top" style="text-align: right;">{{$bill->mode_of_payment}}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="border: 2px solid #000; padding: 5px; margin-top: 30px;"><h3 style="text-align: center;">Bill Summary for {{date('F', mktime(0, 0, 0, $bill->bill_details->bill_month, 10))}}, {{$bill->bill_details->bill_year}} </h3></div>
    <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
        <thead>
            <tr>
                <th valign="top" style="border: 1px solid #000; padding: 5px; width: 40%;">Payment Details</th>
                <th valign="top" style="border: 1px solid #000; padding: 5px; width: 60%;">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Payment Mode:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;"> {{$bill->mode_of_payment}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Amount Paid By:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill->paid_by}}</td>
            </tr>
            @if(isset($bill->dd_details->dd_no))
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">DD/Cheque No:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill->dd_details->dd_no}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Bank Name:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill->dd_details->bank_name}}</td>
            </tr>
            @endif
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Amount Paid:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill->amount_paid}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Payment made for months:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill->from_date}} to {{$bill->to_date}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Balance Amount:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{$bill->balance_amount}}</td>
            </tr>
            <tr>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">Credit Amount:</td>
                <td valign="top" style="border: 1px solid #000; padding: 5px;">{{ $bill->credit_amount}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection