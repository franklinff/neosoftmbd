@php
$route="";
$route=\Request::route()->getName();
@endphp
<!-- <li class="m-menu__item" data-toggle="collapse" data-target="#ee-actions">
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
</li> -->
<!-- <li id="ee-actions" class="collapse show">
    <ul class="list-unstyled">
       <li class="m-menu__item m-menu__item--submenu {{($route=='rc.index')?'m-menu__item--active':''}}">
           <a class="m-menu__link m-menu__toggle" title="view_Application" href="{{route('rc.index')}}">
               <svg class="radio-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 510 510">
                   <path d="M255 127.5c-71.4 0-127.5 56.1-127.5 127.5S183.6 382.5 255 382.5 382.5 326.4 382.5 255 326.4 127.5 255 127.5zM255 0C114.75 0 0 114.75 0 255s114.75 255 255 255 255-114.75 255-255S395.25 0 255 0zm0 459c-112.2 0-204-91.8-204-204S142.8 51 255 51s204 91.8 204 204-91.8 204-204 204z"
                       fill="#FFF" />
               </svg>
               <span class="m-menu__link-text">View Applications</span>
           </a>
       </li>
    </ul>
</li> -->