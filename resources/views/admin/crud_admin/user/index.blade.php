@extends('admin.crud_admin.app')

@section('content')
    <div class="col-md-12">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader px-0 m-subheader--top">
            <div class="d-flex align-items-center">
                <h3 class="m-subheader__title m-subheader__title--separator">User Detail</h3>
                {{ Breadcrumbs::render('user_detail') }}
                {{--<div class="btn-list text-right ml-auto">--}}
                    {{--<a href="{{route('users.index',['excel'=>'excel'])}}" name="excel" value="excel" class="btn excel-icon"><img src="{{asset('/img/excel-icon.svg')}}"></a>--}}
                    {{--<a target="_blank" href="{{route('village_detail.print')}}" class="btn print-icon"><img src="{{asset('/img/print-icon.svg')}}"></a>--}}
                {{--</div>--}}
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-portlet m-portlet--mobile">
            @if(Session::has('success'))
                <div class="alert alert-success fade in alert-dismissible show" style="margin-top:18px;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button> {{ Session::get('success') }}
                </div>
            @endif

            <div class="m-portlet__body data-table--custom data-table--icons data-table--actions">
                <!--begin: Search Form -->
            {{--<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-4">
                                    <label for="exampleSelect1">Search</label>
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input m-input--solid" placeholder="Search..."
                                            id="m_form_search">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label>Resolution Type</label>
                                        <select class="form-control m-input m-input--square" id="exampleSelect1">
                                            <option>Mhada resolutions</option>
                                            <option>MBR Resolutions</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label>From Date</label>
                                        <input type="date" class="form-control m-input m-input--solid" placeholder="From Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group m-form__group">
                                        <label>To Date</label>
                                        <input type="date" class="form-control m-input m-input--solid" placeholder="From Date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <!--end: Search Form -->
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
    /*$( function() {
        $( "#published_from_date, #published_to_date" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );*/

    //function to detele user details
    $(document).ready(function () {
        $(document).on("click", ".delete-user", function () {
            var id = $(this).attr("data-id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                data:{
                    id:id
                },
                url:"{{ route('loadDeleteUserUsingAjax') }}",
                success:function(res)
                {
                    $("#myModal").html(res);
                    $("#myModalBtn").click();
                }
            });
        });
    });

</script>
@endsection
