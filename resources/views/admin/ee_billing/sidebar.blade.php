<!-- BEGIN: Left Aside -->
@php
$route="";
$route=\Request::route()->getName();
@endphp
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    @php
    $land_permission = ['village_detail.index', 'village_detail.create', 'village_detail.edit',
    'village_detail.update', 'village_detail.destroy',
    'loadDeleteVillageUsingAjax', 'village_detail.store', 'society_detail.index', 'society_detail.create',
    'society_detail.store',
    'lease_detail.index', 'lease_detail.create', 'lease_detail.store', 'renew-lease.renew', 'renew-lease.update-lease'
    ];
    @endphp

    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " m-menu-vertical="1"
        m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow">
            @if(in_array('resolution.index', session()->get('permission')))
            <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{ url('/resolution') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Resolution Listing
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif



            @if(in_array('rti_applicants', session()->get('permission')))
            <li class="m-menu__item">
                <a href="{{url('/rti_applicants')}}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                RTI Applicants
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif

            @php
            $hearing_permission = ['hearing.show', 'hearing.index', 'hearing.store', 'hearing.create',
            'hearing.destroy', 'hearing.update', 'hearing.edit', 'loadDeleteReasonOfHearingUsingAjax',
            'schedule_hearing.add', 'schedule_hearing.store',
            'fix_schedule.add', 'fix_schedule.store', 'fix_schedule.edit', 'fix_schedule.update',
            'upload_case_judgement.add', 'upload_case_judgement.store', 'upload_case_judgement.edit',
            'upload_case_judgement.update',
            'forward_case.create', 'forward_case.store', 'forward_case.edit', 'forward_case.update',
            'send_notice_to_appellant.create', 'send_notice_to_appellant.store', 'send_notice_to_appellant.edit',
            'send_notice_to_appellant.update',
            ];
            @endphp
            {{-- @if(!empty(array_intersect($hearing_permission, session()->get('permission'))))--}}
            @if(in_array('hearing.index', session()->get('permission')))
            <li class="m-menu__item">
                <a href="{{ url('hearing') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Listing
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item">
                <a href="{{route('hearing.create')}}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                <span class="m-menu__link-wrap">
                    <span class="m-menu__link-text">
                        Add Hearing
                    </span>
                </span>
            </span>
                </a>
            </li>
            @endif



            {{-- @if(!empty(array_intersect($land_permission, session()->get('permission'))))--}}
            @if(in_array('village_detail.index', session()->get('permission')))
            <li class="m-menu__item" data-toggle="collapse" data-target="#village-actions">
                <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Land
                            </span>
                            <i class="m-menu__ver-arrow la la-angle-right"></i>
                        </span>
                    </span>
                </a>
                <!-- <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">

                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                    src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Land Detail
                                    {{$route}}</span></i></a>
                        </li>
                        <li class="m-menu__item m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                            <a href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle"><img class="radio-icon"
                                    src="{{ asset('/img/radio-icon.svg')}}"><span class="m-menu__link-text">Society
                                    Detail</span></i></a>
                        </li>
                    </ul>
                </div> -->
            </li>

            <li id="village-actions" class="collapse show">
                <ul class="list-unstyled">

                    <li class="m-menu__item m-menu__item--submenu {{($route=='village_detail.index' || $route=='village_detail.edit'|| $route=='village_detail.show')?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{url('/village_detail')}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Land Detail</span></i></a>
                    </li>
                    <li class="m-menu__item m-menu__item--submenu {{($route=='society_detail.index' || $route=='society_detail.show' || $route=='society_detail.edit')?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{route('society_detail.index')}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Society Detail</span></i></a>
                    </li>
                    @if(\Illuminate\Support\Facades\Request::is('village_detail') ||
                    \Illuminate\Support\Facades\Request::is('village_detail/*'))
                    <li class="m-menu__item m-menu__item--submenu {{$route=='village_detail.create'?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{route('village_detail.create')}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Add Land</span></i></a>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Request::is('society_detail') ||
                    \Illuminate\Support\Facades\Request::is('society_detail/*'))
                    <li class="m-menu__item m-menu__item--submenu {{$route=='society_detail.create'?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{route('society_detail.create')}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Add Society</span></i></a>
                    </li>
                    @endif
                    @if((\Illuminate\Support\Facades\Request::is('society_detail/*') ||
                    \Illuminate\Support\Facades\Request::is('lease_detail/*') ||
                    \Illuminate\Support\Facades\Request::is('lease_detail/create/*')) &&
                    (\Illuminate\Support\Facades\Request::is('lease_detail/create') ||
                    \Illuminate\Support\Facades\Request::is('lease_detail/*')))
                    @if((\Illuminate\Support\Facades\Request::is('lease_detail/*') && (isset($count) && ($count == 0)))
                    || \Illuminate\Support\Facades\Request::is('lease_detail/create/*') || \Illuminate\Support\Facades\Request::is('lease_detail/view-lease/*') || \Illuminate\Support\Facades\Request::is('lease_detail/edit-lease/*'))
                    @php $id = collect(request()->segments())->last(); @endphp
                    <li class="m-menu__item m-menu__item--submenu {{($route=='lease_detail.index' || $route=='view-lease.view' || $route=='edit-lease.edit')?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.index', $id)}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Lease Details</span></i></a>
                    </li>

                    <li class="m-menu__item m-menu__item--submenu {{$route=='lease_detail.create'?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.create', $id)}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Add Lease</span></i></a>
                    </li>
                    @else
                    @php $id = collect(request()->segments())->last(); @endphp
                    <li class="m-menu__item m-menu__item--submenu {{$route=='lease_detail.index'?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{route('lease_detail.index', $id)}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Lease Details</span></i></a>
                    </li>
                    <li class="m-menu__item m-menu__item--submenu {{$route=='renew-lease.renew'?'m-menu__item--active':''}}">
                        <a class="m-menu__link m-menu__toggle" href="{{route('renew-lease.renew', $id)}}" class="m-menu__link m-menu__toggle">
                            <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                                <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                                    fill="#FFF" />
                            </svg>
                            <span class="m-menu__link-text">Renew Lease</span></i></a>
                    </li>
                    @endif
                    @endif

                </ul>
            </li>
            @endif
            <!-- <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Dashboard
                            </span>
                        </span>
                    </span>
                </a>
            </li> -->

            {{--<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="{{url('/application')}}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Application
                            </span>
                        </span>
                    </span>
                </a>
            </li>--}}

            {{--<li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                <a href="" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Profile
                            </span>
                        </span>
                    </span>
                </a>
            </li>--}}

            @if(in_array('vp.index', session()->get('permission')) || in_array('ee.index',
            session()->get('permission')) || in_array('dyce.index', session()->get('permission')) ||
            in_array('ree_applications.index', session()->get('permission')) || in_array('co.index',
            session()->get('permission')) || in_array('cap.index', session()->get('permission')) ||
            in_array('society_offer_letter.index', session()->get('permission')))
            <li class="m-menu__item {{($route=='society_detail.index' || $route=='village_detail.index' || $route=='ee.index' || $route=='dyce.index' || $route=='ree_applications.index' || $route=='co.index' || $route=='cap.index' || $route=='vp.index' || $route=='society_offer_letter.index' || $route=='society_offer_letter_dashboard' || $route=='documents_uploaded' || $route=='documents_upload')?'m-menu__item--active':''}}">
                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Listing
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @if(Session::all()['role_name'] == 'society')
            @if(isset($ol_application_count))
            @if($ol_application_count == 0)
            <li class="m-menu__item">
                <a href="{{route('society_detail.application')}}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Apply for Offer Letter
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif
            @endif
            @endif
            @endif


            @if(in_array('architect_application', session()->get('permission')) ||
            in_array('view_architect_application',
            session()->get('permission')) || in_array('evaluate_architect_application', session()->get('permission'))
            ||
            in_array('shortlisted_architect_application', session()->get('permission')) ||
            in_array('final_architect_application',
            session()->get('permission')) || in_array('save_evaluate_marks', session()->get('permission')) ||
            in_array('generate_certificate', session()->get('permission')) ||
            in_array('forward_application', session()->get('permission')) ||
            in_array('finalCertificateGenerate', session()->get('permission')) ||
            in_array('tempCertificateGenerate', session()->get('permission')) ||
            in_array('postfinalCertificateGenerate', session()->get('permission')) ||
            in_array('architect.edit_certificate', session()->get('permission')) ||
            in_array('architect.update_certificate', session()->get('permission'))||
            in_array('architect.post_final_signed_certificate', session()->get('permission')))
            <li class="m-menu__item {{($route=='architect_application')?'m-menu__item--active':''}}" aria-haspopup="true">
                <a href="{{ url(session()->get('redirect_to')) }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Architect Applications 
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            <li class="m-menu__item {{($route=='architect_layout.index')?'m-menu__item--active':''}}" aria-haspopup="true">
                <a href="{{ route('architect_layout.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-icon flaticon-line-graph"></i>
                    <span class="m-menu__link-title">
                        <span class="m-menu__link-wrap">
                            <span class="m-menu__link-text">
                                Architect Layouts
                            </span>
                        </span>
                    </span>
                </a>
            </li>
            @endif

            <!-- <li class="m-menu__item m-menu__item--active m-menu__item--submenu" id="sub-menu" aria-haspopup="true"
                m-menu-submenu-toggle="hover">
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
                <div class="m-menu__submenu" m-hidden-height="160" style=""><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        @yield('actions')       
                    </ul>
                </div>
            </li> -->

            @yield('actions')

            <!-- <li class="m-menu__item m-menu__item--active" aria-haspopup="true">
                    <a href="{{ route('society_offer_letter_dashboard') }}" class="m-menu__link ">
                        <i class="m-menu__link-icon flaticon-line-graph"></i>
                        <span class="m-menu__link-title">
                            <span class="m-menu__link-wrap">
                                <span class="m-menu__link-text">
                                    Offer Letter Dashboard
                                </span>
                            </span>
                        </span>
                    </a>
                </li> -->
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
@section('js')
@endsection
