@php
    $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName();
@endphp
<div
        id="m_ver_menu"
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-aside-menu--dropdown "
        data-menu-vertical="true">
    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        @if(Auth::check())
            @if(Auth::user()->hasRole('admin'))
                <li class="m-menu__item  @if(in_array($currentRoute,['listUsers','editUsersForm','usersForm'])) m-menu__item--active @endif"
                    aria-haspopup="true">
                    <a href="{{route('listUsers')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon fa fa-users"></i>
                        <span class="m-menu__link-text">
										Users
									</span>
                    </a>
                </li>

                <li class="m-menu__item  @if(in_array($currentRoute,['listNews','editNewsForm','newsForm'])) m-menu__item--active @endif"
                    aria-haspopup="true">
                    <a href="{{route('listNews')}}" class="m-menu__link ">
                        <span class="m-menu__item-here"></span>
                        <i class="m-menu__link-icon fa fa-newspaper-o
"></i>
                        <span class="m-menu__link-text">
										News
									</span>
                    </a>
                </li>
            @endif
        @endif

    </ul>
</div>
