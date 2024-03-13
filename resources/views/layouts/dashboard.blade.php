<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Know Database</title>

    <meta name="description" content="Know Database - Padilo powered">
    <meta name="author" content="Padilo">
    <meta name="robots" content="index, follow">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Modules -->
    @yield('css')
    @vite(['resources/sass/main.scss', 'resources/sass/oneui/themes/modern.scss', 'resources/js/app.js'])

    <!-- Alternatively, you can also include a specific color theme after the main stylesheet to alter the default color theme of the template -->
    {{-- @vite(['resources/sass/main.scss', 'resources/sass/oneui/themes/amethyst.scss', 'resources/js/oneui/app.js']) --}}
    @yield('js')
    @livewireStyles
    @stack('css')
</head>

<body>
<!-- Page Container -->
<!--
  Available classes for #page-container:

  GENERIC

    'remember-theme'                            Remembers active color theme and dark mode between pages using localStorage when set through
                                                - Theme helper buttons [data-toggle="theme"],
                                                - Layout helper buttons [data-toggle="layout" data-action="dark_mode_[on/off/toggle]"]
                                                - ..and/or One.layout('dark_mode_[on/off/toggle]')

  SIDEBAR & SIDE OVERLAY

    'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
    'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
    'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
    'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
    'sidebar-dark'                              Dark themed sidebar

    'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
    'side-overlay-o'                            Visible Side Overlay by default

    'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

    'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

  HEADER

    ''                                          Static Header if no class is added
    'page-header-fixed'                         Fixed Header

  HEADER STYLE

    ''                                          Light themed Header
    'page-header-dark'                          Dark themed Header

  MAIN CONTENT LAYOUT

    ''                                          Full width Main Content if no class is added
    'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
    'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)

  DARK MODE

    'sidebar-dark page-header-dark dark-mode'   Enable dark mode (light sidebar/header is not supported with dark mode)
  -->
<div id="page-container"
     class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">

    <!-- Sidebar -->
    <!--
        Sidebar Mini Mode - Display Helper classes

        Adding 'smini-hide' class to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
        Adding 'smini-show' class to an element will make it visible (opacity: 1) when the sidebar is in mini mode
            If you would like to disable the transition animation, make sure to also add the 'no-transition' class to your element

        Adding 'smini-hidden' to an element will hide it when the sidebar is in mini mode
        Adding 'smini-visible' to an element will show it (display: inline-block) only when the sidebar is in mini mode
        Adding 'smini-visible-block' to an element will show it (display: block) only when the sidebar is in mini mode
    -->
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="content-header">
            <!-- Logo -->
            <a class="font-semibold text-dual" href="/">
          <span class="smini-visible">
            <i class="fa fa-circle-notch text-primary"></i>
          </span>
                <span class="smini-hide fs-5 tracking-wider">Know<span class="fw-normal">Database</span></span>
            </a>
            <!-- END Logo -->

            <!-- Extra -->
            <div>
                <!-- Dark Mode -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="btn btn-sm btn-alt-secondary" data-toggle="layout" data-action="dark_mode_toggle"
                   href="javascript:void(0)">
                    <i class="far fa-moon"></i>
                </a>
                <!-- END Dark Mode -->

                <!-- Options -->
                <div class="dropdown d-inline-block ms-1">
                    <a class="btn btn-sm btn-alt-secondary" id="sidebar-themes-dropdown" data-bs-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="fa fa-brush"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end fs-sm smini-hide border-0"
                         aria-labelledby="sidebar-themes-dropdown">
                        <!-- Sidebar Styles -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_light"
                           href="javascript:void(0)">
                            <span>{{ __('Светлая меню') }}</span>
                        </a>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="sidebar_style_dark"
                           href="javascript:void(0)">
                            <span>{{ __('Тёмное меню') }}</span>
                        </a>
                        <!-- END Sidebar Styles -->

                        <div class="dropdown-divider"></div>

                        <!-- Header Styles -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_light"
                           href="javascript:void(0)">
                            <span>{{ __('Светлое верхнее меню') }}</span>
                        </a>
                        <a class="dropdown-item fw-medium" data-toggle="layout" data-action="header_style_dark"
                           href="javascript:void(0)">
                            <span>{{ __('Тёмное верхнее меню') }}</span>
                        </a>
                        <!-- END Header Styles -->
                    </div>
                </div>
                <!-- END Options -->

                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <a class="d-lg-none btn btn-sm btn-alt-secondary ms-1" data-toggle="layout" data-action="sidebar_close"
                   href="javascript:void(0)">
                    <i class="fa fa-fw fa-times"></i>
                </a>
                <!-- END Close Sidebar -->
            </div>
            <!-- END Extra -->
        </div>
        <!-- END Side Header -->

        <!-- Sidebar Scrolling -->
        <div class="js-sidebar-scroll">
            <!-- Side Navigation -->
            <div class="content-side">
                <ul class="nav-main">
                    <li class="nav-main-item">
                        <a class="nav-main-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            <i class="nav-main-link-icon si si-cursor"></i>
                            <span class="nav-main-link-name">{{ __('Главная') }}</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">{{ __('Управление') }}</li>
                    @if(Auth::user()->isAdmin())
                        <li class="nav-main-item {{ (request()->is('dashboard/users') OR request()->is('dashboard/users/*')) ? 'open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                               aria-expanded="true" href="#">
                                <i class="nav-main-link-icon si si-user"></i>
                                <span class="nav-main-link-name">{{ __('Пользователи') }}</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link {{ request()->is('dashboard/users') ? 'active' : '' }}"
                                       href="{{ route('dashboard.users.index') }}">
                                        <i class="nav-main-link-icon fa fa-users"></i>
                                        <span class="nav-main-link-name">{{ __('Все пользователи') }}</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link {{ request()->is('dashboard/users/add') ? 'active' : '' }}"
                                       href="{{ route('dashboard.users.add') }}">
                                        <i class="nav-main-link-icon fa fa-user-plus"></i>
                                        <span class="nav-main-link-name">{{ __('Добавить пользователи') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->isRedactor())
                        <li class="nav-main-item {{ (request()->is('dashboard/posts') OR request()->is('dashboard/posts/*')) ? 'open' : '' }}">
                            <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
                               aria-expanded="true" href="#">
                                <i class="nav-main-link-icon si si-paper-clip"></i>
                                <span class="nav-main-link-name">{{ __('Посты') }}</span>
                            </a>
                            <ul class="nav-main-submenu">
                                <li class="nav-main-item">
                                    <a class="nav-main-link {{ request()->is('dashboard/posts') ? 'active' : '' }}"
                                       href="{{ route('dashboard.posts.index') }}">
                                        <i class="nav-main-link-icon fa fa-users"></i>
                                        <span class="nav-main-link-name">{{ __('Все посты') }}</span>
                                    </a>
                                </li>
                                <li class="nav-main-item">
                                    <a class="nav-main-link {{ request()->is('dashboard/posts/add') ? 'active' : '' }}"
                                       href="{{ route('dashboard.posts.add') }}">
                                        <i class="nav-main-link-icon fa fa-user-plus"></i>
                                        <span class="nav-main-link-name">{{ __('Создать пост') }}</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <li class="nav-main-heading">Разное</li>
                    <li class="nav-main-item open">
                        <a class="nav-main-link" href="{{ route('index') }}">
                            <i class="nav-main-link-icon si si-globe"></i>
                            <span class="nav-main-link-name">{{ __('Назад на сайт') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END Side Navigation -->
        </div>
        <!-- END Sidebar Scrolling -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div class="d-flex align-items-center">
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-sm btn-alt-secondary me-2 d-lg-none" data-toggle="layout"
                        data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->
            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div class="d-flex align-items-center">
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block ms-2">
                    <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <img class="rounded-circle" src="{{ asset('media/avatars/avatar10.jpg') }}" alt="Header Avatar"
                             style="width: 21px;">
                        <span class="d-none d-sm-inline-block ms-2">{{ Auth::user()->name }}</span>
                        <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
                         aria-labelledby="page-header-user-dropdown">
                        <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                            <img class="img-avatar img-avatar48 img-avatar-thumb"
                                 src="{{ asset('media/avatars/avatar10.jpg') }}" alt="">
                            <p class="mt-2 mb-0 fw-medium">{{ Auth::user()->name }}</p>
                            <p class="mb-0 text-muted fs-sm fw-medium">{{ Auth::user()->role->name }}</p>
                        </div>
                        <div class="p-2">
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a @click.prevent="$root.submit()" class="dropdown-item d-flex align-items-center justify-content-between"
                                   href="{{ route('logout') }}">
                                    <span class="fs-sm fw-medium">{{ __('Выйти') }}</span>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->
            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-body-extra-light">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-circle-notch fa-spin"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
            <div class="row fs-sm">
                <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-end">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
                                                                               href="javascript:void(0)"
                                                                               target="_blank">Padilo</a>
                </div>
                <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-start">
                    <a class="fw-semibold" href="{{ route('index') }}" target="_blank">Know Database</a> &copy;
                    <span data-toggle="year-copy"></span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->
@vite('resources/js/oneui/app.js')
@livewireScripts
@stack('js')
</body>

</html>
