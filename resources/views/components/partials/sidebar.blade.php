<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu pt-3">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        {{-- <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="17">
            </span>
        </a> --}}
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                @foreach ($navs as $nav)
                    <li class="menu-title"><span data-key="t-menu">{{ $nav['header'] }}</span></li>
                    @foreach ($nav['submenu'] as $item)
                        @php
                            $url = explode('.', $item['url']);
                            $lastRoute = end($url);
                            $url[count($url) - 1] = '*';
                            $newUrl = implode('.', $url);
                        @endphp
                        <li class="nav-item">
                            @if (!$item['submenu'])
                                <a class="nav-link menu-link {{ request()->routeIs($newUrl) ? 'active' : '' }}"
                                    href="{{ $item['url'] }}">
                                    {!! $item['icon'] !!} <span data-key="{{ $item['title'] }}">{{ $item['title'] }}</span>
                                </a>
                            @else
                                <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                                    {!! $item['icon'] !!} <span
                                        data-key="t-multi-level">{{ $item['title'] }}</span>
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarMultilevel"></div>
                                    <ul class="nav nav-sm flex-column">
                                        @foreach ($item['submenu'] as $sub)
                                            <li class="nav-item">
                                                <a href="{{ $sub['url'] }}"
                                                    class="nav-link {{ request()->routeIs($sub['url']) ? 'active' : '' }}"
                                                    data-key="{{ $sub['title'] }}">{{ $sub['title'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach
                @endforeach
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('admin.user.*') ? 'active' : '' }}"
                        href="{{ route('admin.user.index') }}">
                        <i class="ri-user-2-line"></i> <span data-key="t-users">{{ __('vocab.user') }}</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="sidebarMultilevel">
                        <i class="ri-share-line"></i> <span data-key="t-multi-level">Multi Level</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-key="t-level-1.1"> Level 1.1 </a>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarAccount" class="nav-link" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false" aria-controls="sidebarAccount"
                                    data-key="t-level-1.2"> Level
                                    1.2
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAccount">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="#" class="nav-link" data-key="t-level-2.1">
                                                Level 2.1 </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#sidebarCrm" class="nav-link"
                                                data-bs-toggle="collapse" role="button"
                                                aria-expanded="false" aria-controls="sidebarCrm"
                                                data-key="t-level-2.2"> Level 2.2
                                            </a>
                                            <div class="collapse menu-dropdown" id="sidebarCrm">
                                                <ul class="nav nav-sm flex-column">
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link"
                                                            data-key="t-level-3.1"> Level 3.1
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a href="#" class="nav-link"
                                                            data-key="t-level-3.2"> Level 3.2
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
