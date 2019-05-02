        <table id="example" class="display table table-responsive table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr. No.</th>
                <th>Flat No.</th>
                <th>Saluation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Use</th>
                <th>Carpet Area</th>
                <th>Tenant Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
        <?php $row_no = 1; ?>
        @foreach($buildings as $key => $value )
            <tr> 
                <td>{{$row_no++}}</td>
                <td>{{$value->flat_no}}</td>
                <td>{{$value->salutation}}</td>
                <td>{{$value->first_name}}</td>
                <td>{{$value->middle_name}}</td>
                <td>{{$value->last_name}}</td>
                <td>{{$value->use}}</td>
                <td>{{$value->carpet_area}}</td>
                <td>
                    @foreach($tenament as $key2 => $value2)
                     {{ $value->tenant_type == $value2->id ? $value2->name : '' }} 
                    @endforeach 
                </td>
                <td>

                    {!! Form::open(['method' => 'get', 'route' => 'billing_calculations']) !!}
                    {{ Form::hidden('tenant_id', encrypt($value->id)) }}
                    {{ Form::hidden('building_id', encrypt($value->building_id)) }}
                    {{ Form::hidden('society_id', encrypt($society_id)) }}                    
                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/view-billing-details-icon.svg"></span>View Bill Details', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}
                    @if(count($value->TransBillGenerate) <= 0)
                    {!! Form::open(['method' => 'get', 'route' => 'generateTenantBill']) !!}
                    {{ Form::hidden('tenant_id', encrypt($value->id)) }}
                    {{ Form::hidden('building_id', encrypt($value->building_id)) }}
                    {{ Form::hidden('society_id', encrypt($society_id)) }}                    
                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/generate-bill-icon.svg"></span>Generate Bill', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}
                    @endif
                    <!-- <a class="btn btn-info mb-10" href="{{route('edit_tenant', [$value->id])}}">Generate Bill</a> -->

                    {!! Form::open(['method' => 'get', 'route' => 'arrears_calculations']) !!}
                    {{ Form::hidden('tenant_id', encrypt($value->id)) }}
                    {{ Form::hidden('building_id', encrypt($value->building_id)) }}
                    {{ Form::hidden('society_id', encrypt($society_id)) }}     
                    {{ Form::button('<span class="btn-icon btn-icon--edit"><img src="/img/view-arrears-calculation-icon.svg"></span>Arrear Calculation', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}
                    @if(count($value->TransBillGenerate) > 0)
                    {!! Form::open(['method' => 'get', 'route' => 'generateTenantBill']) !!}
                    {{ Form::hidden('tenant_id', encrypt($value->id)) }}
                    {{ Form::hidden('building_id', encrypt($value->building_id)) }}
                    {{ Form::hidden('society_id', encrypt($society_id)) }}                    
                    {{ Form::hidden('regenate', true) }}                    
                    {{ Form::button('<span class="btn-icon btn-icon--regenerate"><img src="/img/regenerate-bill-icon.svg"></span>Regenerate Bill', array('class'=>'btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center','type'=>'submit')) }}
                    {!! Form::close() !!}

                     {{-- <div class="d-flex btn-icon-list"> 
                        <button class="btn btn--unstyled p-0 btn--icon-wrap d-flex flex-column align-items-center">
                            <span class="btn-icon btn-icon--regenerate">
                                <img src="{{ asset('/img/regenerate-bill-icon.svg')}}">
                            </span>Regenerate Bill
                        </button>
                    </div> --}}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Sr. No.</th>
                <th>Flat No.</th>
                <th>Saluation</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Use</th>
                <th>Carpet Area</th>
                <th>Tenant Type</th>
                <th>Action</th>
            </tr>
        </tfoot>
        </table>
      