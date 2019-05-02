@php
	$route="";
    $route=\Request::route()->getName();
$status = isset($noc_applications->nocApplicationStatus[0]->status_id)?$noc_applications->nocApplicationStatus[0]->status_id:4;
@endphp
<li class="m-menu__item">
	<a class="m-menu__link m-menu__toggle" title="List of Applications" href="{{ route('society_offer_letter_dashboard') }}">
		<i class="m-menu__link-icon flaticon-line-graph"></i>
		<span class="m-menu__link-text">List of Applications</span>
	</a>
</li>
<li class="m-menu__item" data-toggle="collapse" onload="action_dropmenu()" data-target="#ree-actions">
	<a href="javascript:void(0);" class="m-menu__link m-menu__toggle">
		<i class="m-menu__link-icon flaticon-line-graph"></i>
		<span class="m-menu__link-title">
            <span class="m-menu__link-wrap">
                <span class="m-menu__link-text">
                    Actions
                </span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </span>
        </span>
	</a>
</li>

<li id="ree-actions" class="collapse show">
	<ul class="list-unstyled">
		@if($status == '4' || $status == '3')
		@if(isset($applicationCount) && $applicationCount <= 0)
		<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society_noc_edit')?'m-menu__item--active':''}}">
			<a class="m-menu__link m-menu__toggle" title="Edit Application" href="{{ route('society_noc_edit',encrypt($noc_applications->id)) }}">
				<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
					<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
						  fill="#FFF" />
				</svg>
				<span class="m-menu__link-text">Edit Application</span>
			</a>
		</li>
		@endif
		<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society_noc_preview')?'m-menu__item--active':''}}">
			<a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('society_noc_preview',encrypt($noc_applications->id)) }}">
				<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
					<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
						  fill="#FFF" />
				</svg>
				<span class="m-menu__link-text">View Application</span>
			</a>
		</li>
		@if(isset($applicationCount) && $applicationCount <= 0)
		<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='documents_upload_noc')?'m-menu__item--active':''}}">
			<a class="m-menu__link m-menu__toggle" title="Upload Documents" href="{{ route('documents_upload_noc',encrypt($noc_applications->id)) }}">
				<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
					<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
						  fill="#FFF" />
				</svg>
				<span class="m-menu__link-text">Upload Documents</span>
			</a>
		</li>
		@endif
		@if($check_upload_avail == 1)
		<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='upload_noc_application')?'m-menu__item--active':''}}">
			<a class="m-menu__link m-menu__toggle" title="Upload Signed Application for Offer Letter" href="{{ route('upload_noc_application',encrypt($noc_applications->id)) }}">
				<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
					<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
						  fill="#FFF" />
				</svg>
				<span class="m-menu__link-text">Upload Signed Application for Noc</span>
			</a>
		</li>
		@endif
		@endif
		@if($status == '2' || $status == '7')
			<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society_noc_preview')?'m-menu__item--active':''}}">
				<a class="m-menu__link m-menu__toggle" title="View Application" href="{{ route('society_noc_preview',encrypt($noc_applications->id)) }}">
					<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
						<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
							  fill="#FFF" />
					</svg>
					<span class="m-menu__link-text">View Application</span>
				</a>
			</li>
			<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='documents_uploaded_noc')?'m-menu__item--active':''}}">
				<a class="m-menu__link m-menu__toggle" title="View Documents" href="{{ route('documents_uploaded_noc',encrypt($noc_applications->id)) }}">
					<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
						<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
							  fill="#FFF" />
					</svg>
					<span class="m-menu__link-text">View Documents</span>
				</a>
			</li>
			<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='show_noc_sign_application')?'m-menu__item--active':''}}">
				<a class="m-menu__link m-menu__toggle" title="Signed Application for Offer Letter" href="{{ route('show_noc_sign_application',encrypt($noc_applications->id)) }}" rel="noopener">
					<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
						<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
							  fill="#FFF" />
					</svg>
					<span class="m-menu__link-text">Signed Application for Noc</span>
				</a>
			</li>
			@endif
			@if($status == '7')
			<li class="m-menu__item m-menu__item--submenu m-menu__item--level-2 {{($route=='society_noc_application_download')?'m-menu__item--active':''}}">
				<a class="m-menu__link m-menu__toggle" title="Download Issued NOC" href="{{ config('commanConfig.storage_server').'/'.$noc_applications->final_draft_noc_path }}" target="_blank" rel="noopener">
					<svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
						<path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
							  fill="#FFF" />
					</svg>
					<span class="m-menu__link-text">Download Issued NOC</span>
				</a>
			</li>
			@endif
	</ul>
</li>

{{--<div class="d-flex btn-icon-list">--}}
	{{--<a class="d-flex flex-column align-items-center" title="View Documents" href="{{ route('documents_uploaded') }}"><span--}}
    {{--class="btn-icon btn-icon--view"><img src="{{ asset('/img/view-icon.svg')}}"></span>View</a>--}}
	{{--<a class="d-flex flex-column align-items-center" title="Application Download" href="{{ route('society_offer_letter_application_download') }}"--}}
    {{--target="_blank" rel="noopener"><span class="btn-icon btn-icon--delete"><img src="{{ asset('/img/download-icon.svg')}}"></span>Application Download</a>--}}
    {{--@if($ol_applications->olApplicationStatus[0]->status_id == '3' ||--}}
    {{--$ol_applications->olApplicationStatus[0]->status_id == '4')--}}
		{{--<a class="d-flex flex-column align-items-center" title="Edit Documents" href="{{ route('documents_upload') }}"><span--}}
        {{--class="btn-icon btn-icon--edit"><img src="{{ asset('/img/view-icon.svg')}}"></span>Edit</a>--}}
    {{--@endif--}}
    {{--@if($ol_applications->olApplicationStatus[0]->status_id == '7')--}}
	    {{--<a class="d-flex flex-column align-items-center" title="Offer Letter Download" href="{{ config('commanConfig.storage_server').'/'.$ol_applications->offer_letter_document_path }}"--}}
	    {{--target="_blank" rel="noopener"><span class="btn-icon btn-icon--delete"><img src="{{ asset('/img/download-icon.svg')}}"></span>Offer Letter Download</a>--}}
    {{--@endif--}}
{{--</div>--}}
@section('js')
<script>
	$(document).ready(function(){
		$('#society_ol_sidebar').hide();
        $('#conveyance').hide();
        $('#renewal').hide();
        $('#architect').hide();
        $('#revalidation').hide();
        $('#apply_sc').hide();
		$('#estate_conveyances').hide();
    });
</script>
@endsection