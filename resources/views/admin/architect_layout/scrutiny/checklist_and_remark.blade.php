<div class="loader" style="display:none;"></div>
@if($read_only!=1)
<form action="{{$post_route_name}}" id="forwardApplication" method="post">
    @csrf
@endif
    <input type="hidden" id="upload_file_route_name" name="upload_file_route_name" value="{{$upload_file_route_name}}">
    <input type="hidden" id="architect_layout_id" name="architect_layout_id" value="{{$ArchitectLayout->id}}">
    <div class="optionBox mhada-optionbox">

        @php $j=0; @endphp
        @foreach ($check_list_and_remarks as $item)
        <div class="block">
            <input type="hidden" name="report_id[]" id="report_id_{{$j}}" value="{{$item->id}}">
            @if($item->question!="")
            <p style="font-size: 16px" class="mhada-optionbox-p"><strong>{{$j+1}} . {{$item->question->title}}</strong></p>
            @if($item->question->is_options==1)
            <p class="mhada-optionbox-radio">
                <input {{$read_only!=0?'disabled':''}} type="radio" name="lable[{{$j}}]" value="1" {{$item->label1==1?'checked':''}}>{{$item->question->label1}}
                <input {{$read_only!=0?'disabled':''}} type="radio" name="lable[{{$j}}]" value="2" {{$item->label2==1?'checked':''}}>{{$item->question->label2}}
            </p>
            @endif
            @endif
            <div class="m-form__group row mhada-optionbox-rows">
                <div class="col-lg-2 form-group mb-0 mhada-optionbox-br">
                    <label for="Upload_Cts_Plan">Remark</label>
                </div>
                <div class="col-lg-7 form-group mb-0 mhada-optionbox-bl">
                    <div class="custom-file mb-0 ">
                        <textarea {{$read_only!=0?'disabled':''}} type="text" name="remark[]" id="remark" class="form-control form-control--custom form-control--fixed-height">{{$item->remark }}</textarea>
                        @if ($errors->has('remark'))
                        <span class="error">{{ $errors->first('remark') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-form__group row mhada-optionbox-rows">
                <div class="col-lg-2 form-group mb-0 mhada-optionbox-br mhada-optionbox-br-ur">
                    <label for="Upload_Cts_Plan">Upload Report</label>
                </div>
                <div class="col-lg-7 form-group mb-0 mhada-optionbox-bl mhada-optionbox-br-down">
                    <div class="custom-file">
                        <input {{$read_only!=0?'disabled':''}} class="custom-file-input" name="report[]" type="file" id="report_file_{{$j}}" onchange="upload_report(this.id,'report_id_{{$j}}','report_file_{{$j}}','report_file_link_{{$j}}')">
                        <label class="custom-file-label" for="report_file_{{$j}}">Choose file...</label>
                        <input type="hidden" name="report_file_name[]" id="report_file_{{$j}}" value="">
                        <a  target="_blank" class="btn-link" id="report_file_link_{{$j}}" href="{{config('commanConfig.storage_server').'/'.$item->file}}"
                            style="display:{{$item->file!=''?'block':'none'}}">download</a>
                    </div>
                </div>
            </div>

        </div>
        @php $j++; @endphp
        @endforeach
    </div>
    <div class="row">
        @if($read_only!=1)
        <div class="col-sm-12">
            <a class="btn--add-delete add_report">add more </a>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-3">
                    @if($read_only!=1)
                    <button type="submit" class="btn btn-primary btn-custom" id="uploadBtn">Save</Button>
                    @endif
                <a href="{{ url()->previous() }}" class="btn btn-primary btn-custom">Back</a>
            </div>
        </div>
    </div>
@if($read_only!=1)
</form>
@endif
