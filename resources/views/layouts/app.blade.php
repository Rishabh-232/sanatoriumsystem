<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sanatorium System</title>
    
    <!-- Styles -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/logo/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('assets/images/logo/safari-pinned-tab.svg') }}" color="#5bbad5">
    
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <!-- <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('/') }}/assets/css/jquery.datetimepicker.min.css">

    <link rel="stylesheet" href="//rawcdn.githack.com/nextapps-de/spotlight/0.7.8/dist/css/spotlight.min.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <style type="text/css">
        
        .layout-horizontal .main-navbar ul .menu-link span {
            height: 22px !important;
        }

    </style>

</head>

<body class="sidebar-menu-hide">
    <div id="app">
        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
        <div id="sidebar" class="">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <div>
                                <h1 class="logo-title">Sanatorium System</h1>
                            </div>
                        <!-- <img id="imglogo2" alt="Logo" srcset="" style="height: 55px; width: 200px; margin: 0; object-fit: contain;">
                        <h6 class="modal-title" id="textLogo2"  style="font-size: 1.2rem; color:#fff"></h6> -->
                        </div>
                        <!-- <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" >
                                <label class="form-check-label" ></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
                        </div> -->
                        <div class="sidebar-toggler x">
                            <a href="javascript:void(0)" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <!-- <li class="sidebar-title">Menu</li> -->
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                        <li class="sidebar-item {{ Request::is('home*') ? 'active' : '' }}">
                            <a href="{{ route('home') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                        <li class="sidebar-item {{ Request::is('patientlist*') ? 'active' : '' }}">
                            <a href="{{ route('patientlist') }}" class='sidebar-link'>
                                <i class="fa-fw select-all fas"></i>
                                <span>Patient List</span>
                            </a>
                        </li>
                        @endif
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                        <li class="sidebar-item has-sub js-sub-menu {{ Request::is('quotelist*') ? 'active' : '' }}">
                            @if (strpos($package[0]['access_to_page'], 'Patients') !== false)
                            <a href="javascript:void(0)" class='sidebar-link'>
                                <i class="fa-fw select-all fas"></i>
                                <span>Patients Details</span>
                            </a>
                            @endif
                            <div class="submenu">
                                <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                <div class="submenu-group-wrapper">
                                    <ul class="submenu-group">
                                        <!--@if (strpos($package[0]['access_to_page'], 'Patient List') !== false)-->
                                        <!--<li class="submenu-item ">-->
                                        <!--    <i class="fas fa-solid fa-chevron-right"></i>-->
                                        <!--    <a href="{{ route('patientlist') }}" class='submenu-link'>Patient List</a>-->
                                        <!--</li>-->
                                        <!--@endif-->
                                        @if (strpos($package[0]['access_to_page'], 'Quote Plan List') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('quotelist') }}" class='submenu-link'>Treatment Plan List</a>
                                        </li>
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Insurance') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('claimlist') }}" class='submenu-link'>Insurance</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endif
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                            @if (strpos($package[0]['access_to_page'], 'Appointments') !== false)   
                            <li class="sidebar-item {{ Request::is('addappontment*') ? 'active' : '' }}">
                                <a href="{{ url('addappontment') }}" class='sidebar-link'>
                                    <i class="fa-fw select-all fas fa-calendar-check"></i>
                                    <span>Appointments</span>
                                </a>
                            </li>
                            @endif
                        @endif
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                            @if (strpos($package[0]['access_to_page'], 'Doctors') !== false)   
                            <li class="sidebar-item {{ Request::is('doctorlist*') ? 'active' : '' }}">
                                <a href="{{ url('doctorlist') }}" class='sidebar-link'>
                                    <i class="fa-fw select-all fas"></i>
                                    <span>Doctors</span>
                                </a>
                            </li>
                            @endif
                        @endif
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                            @if (strpos($package[0]['access_to_page'], 'Treatments') !== false)   
                            <li class="sidebar-item {{ Request::is('ref_treatments*') ? 'active' : '' }}">
                                <a href="{{ url('ref_treatments') }}" class='sidebar-link'>
                                    <i class="fa-fw select-all fas fa-calendar-check"></i>
                                    <span>Treatments</span>
                                </a>
                            </li>
                            @endif
                        @endif
                        <!-- @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3))
                            @if (strpos($package[0]['access_to_page'], 'Inventory') !== false)
                            <li class="sidebar-item {{ Request::is('inventorylist*') ? 'active' : '' }}">
                                <a href="{{ url('inventorylist') }}" class='sidebar-link'>
                                    <i class="fa-fw select-all fas"></i>
                                    <span>Inventory</span>
                                </a>
                            </li>
                            @endif
                            @if (strpos($package[0]['access_to_page'], 'Accounts') !== false)
                            <li class="sidebar-item {{ Request::is('accountlist*') ? 'active' : '' }}">
                                <a href="{{ url('accountlist') }}" class='sidebar-link'>
                                    <i class="fa fa-user"></i>
                                    <span>Accounts</span>
                                </a>
                            </li>
                            @endif
                            @if (strpos($package[0]['access_to_page'], 'Billing') !== false)
                            <li class="sidebar-item {{ Request::is('billing*') ? 'active' : '' }}">
                                <a href="{{ url('billing') }}" class='sidebar-link'>
                                    <i class="fa-fw select-all fas"></i>
                                    <span>Billing</span>
                                </a>
                            </li>
                            @endif
                        @endif 
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                        <li class="sidebar-item has-sub js-sub-menu {{ Request::is('homemanage*','labnotelist*','report*','lablist*','notelist*','TOWlist*','shadelist*') ? 'active' : '' }}">
                            @if (strpos($package[0]['access_to_page'], 'Lab Management') !== false)
                            <a href="javascript:void(0)" class='sidebar-link'>
                                <i class="fa-fw select-all fas"></i>
                                <span>Lab Management</span>
                            </a>
                            @endif
                            <div class="submenu">
                                <div class="submenu-group-wrapper">
                                    <ul class="submenu-group">
                                    @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                                        @if (strpos($package[0]['access_to_page'], 'Dashboard') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('homemanage') }}" class='submenu-link'>Dashboard</a>
                                        </li>
                                        @endif
                                    @endif
                                    @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4)
                                        @if (strpos($package[0]['access_to_page'], 'Lab Note') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('labnotelist') }}" class='submenu-link'>Lab Note</a>
                                        </li>
                                        @endif
                                    @endif
                                    @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3)
                                        @if (strpos($package[0]['access_to_page'], 'Report') !== false)
                                        <li class="submenu-item">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('report') }}" class='submenu-link'>Report</a>
                                        </li>
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Lab Master') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ url('/lablist') }}" class='submenu-link'>Lab Master</a>
                                        </li>
                                        @endif
                                    @endif
                                    @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4)
                                        @if (strpos($package[0]['access_to_page'], 'Instructions Master') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ url('/notelist') }}" class='submenu-link'>Instructions Master</a>
                                        </li>
                                        @endif
                                    @endif
                                    @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3)
                                        @if (strpos($package[0]['access_to_page'], 'Work Master') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ url('/TOWlist') }}" class='submenu-link'>Work Master</a>
                                        </li>
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Shades Master') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('shadelist') }}" class='submenu-link'>Shades Master</a>
                                        </li>
                                        @endif
                                    @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endif 
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3))
                        <li class="sidebar-item has-sub js-sub-menu {{ Request::is('grossincomereport*') ? 'active' : '' }}">
                            @if (strpos($package[0]['access_to_page'], 'Reports') !== false)
                            <a href="javascript:void(0)" class='sidebar-link'>
                                <i class="fa-fw select-all fas fa-envelope"></i>
                                <span>Reports</span>
                            </a>
                            @endif
                            <div class="submenu ">
                                <div class="submenu-group-wrapper">
                                    <ul class="submenu-group">
                                        @if (strpos($package[0]['access_to_page'], 'Gross Income Report') !== false)
                                        <li class="submenu-item  ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('grossincomereport') }}" class='submenu-link'>Gross Income Report</a>
                                        </li>
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Patient Report') !== false)
                                        <li class="submenu-item  ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ URL('patientreport') }}" class='submenu-link'>Patient Report</a>
                                        </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endif -->
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3))
                        <li class="sidebar-item has-sub js-sub-menu {{ Request::is('medicines*','userslist*','/ download*','planlist*') ? 'active' : '' }}">
                            @if (strpos($package[0]['access_to_page'], 'Settings') !== false)
                            <a href="javascript:void(0)" class='sidebar-link'>
                                <i class="fa fa-cog fa-1x"></i>
                                <span>Settings</span>
                            </a>
                            @endif
                            <div class="submenu">
                                <!-- Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it. -->
                                <div class="submenu-group-wrapper">
                                    <ul class="submenu-group">
                                        @if (strpos($package[0]['access_to_page'], 'Doctors') !== false)
                                        <li class="submenu-item">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('doctorlist') }}" class='submenu-link'>Doctors</a>
                                        </li>
                                        @endif
                                         @if (strpos($package[0]['access_to_page'], 'Treatments') !== false)
                                        <li class="submenu-item ">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ route('ref_treatments') }}" class='submenu-link'>Treatments</a>
                                        </li>
                                        @endif
                                         @if (strpos($package[0]['access_to_page'], 'Medicines') !== false)
                                        <li class="submenu-item">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ url('medicines') }}" class='submenu-link'>Medicines</a>
                                        </li>
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Consent-Master') !== false)
                                            <li class="submenu-item">
                                                <i class="fas fa-solid fa-chevron-right"></i>
                                                <a href="{{ url('consentmasterlist') }}" class='submenu-link'>Consent Master</a>
                                            </li>
                                            @endif
                                        @if(Auth::check() && (Auth::user()->roleNo == 1))
                                            @if (strpos($package[0]['access_to_page'], 'Plans') !== false)
                                            <li class="submenu-item">
                                                <i class="fas fa-solid fa-chevron-right"></i>
                                                <a href="{{ url('planlist') }}" class='submenu-link'>Plans</a>
                                            </li>
                                            @endif
                                            @if (strpos($package[0]['access_to_page'], 'Users') !== false)
                                            <li class="submenu-item">
                                                <i class="fas fa-solid fa-chevron-right"></i>
                                                <a href="{{ url('/userslist') }}" class='submenu-link'>Users</a>
                                            </li>
                                            @endif
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Server Backup') !== false)
                                        <li class="submenu-item">
                                            <i class="fas fa-solid fa-chevron-right"></i>
                                            <a href="{{ url('/download') }}" data-bs-toggle="modal" data-bs-target="#confirmDB_download" class='submenu-link'>Server Backup</a>
                                        </li> 
                                        @endif                    
                                    </ul>
                                </div>
                            </div> 
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <div id="main" class="layout-horizontal">
            <header class="">
                <div class="header-top">
                    <div class="container">
                        <a href="javascript:void(0)" class="side-menu-icon">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                        <div class="logo">
                            <img id="imglogo" alt="Logo" srcset="">
                            <h6 class="modal-title" id="textLogo"  style="font-size: 1.8rem;"></h6>
                        </div>
                        <div class="header-top-right">
                            <div class="dropdown">
                                <a href="#" id="topbarUserDropdown" class="user-dropdown d-flex align-items-center dropend dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="avatar avatar-md2" >
                                        <img src="{{ asset('assets/images/faces/docs.avif') }}" alt="Avatar">
                                    </div>
                                    <div class="text">
                                        @auth
                                        <h6 class="user-dropdown-name">{{ Auth::user()->name }}</h6>
                                        <p class="user-dropdown-status text-sm text-muted"></p>
                                        <!-- <p class="user-dropdown-status text-sm text-muted">{{ Auth::user()->email }}</p> -->
                                        @endauth
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                                  	<li>
                                      <a href="{{ route('changepassword') }}?Value=1" class="dropdown-item">
			                                <i class="fa-fw select-all fas"></i>
			                                <span>Edit Profile</span>
			                            </a>
			                        </li>
                                  	<li><hr class="dropdown-divider"></li>
                                    <!-- <li>
                                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2 justify-content-center">
                                            <span>Menu Top</span>
                                            <div class="form-check form-switch fs-6">
                                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark">
                                                <label class="form-check-label" ></label>
                                            </div>
                                            <span>Menu Left</span>
                                        </div>
                                    </li>
                                    <li><hr class="dropdown-divider"></li> -->
                                  	<li>
                                  		<a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
			                                <span>Logout</span>

			                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
			                                    @csrf
			                                </form>
			                            </a>
			                        </li>
                                </ul>
                            </div>

                            <!-- Burger button responsive -->
                            <a href="#" class="burger-btn d-block d-xl-none">
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <nav class="main-navbar">
                    <div class="container">
                        <ul class="menu">
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))

                            <li class="menu-item active "><a href="{{ route('home') }}" class='menu-link'><i class="bi bi-grid-fill" style="height: auto;"></i><span>Dashboard</span></a>
	                        </li>
                        @endif
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))

                            <li
                                class="menu-item  has-sub">
                                @if (strpos($package[0]['access_to_page'], 'Patients') !== false)
                                <a href="#" class='menu-link'>
                                <i class="fa-fw select-all fas"></i>
                                    <span>Patients</span>
                                </a>
                                @endif
                                <div
                                    class="submenu ">
                                    Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it.
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                        @if (strpos($package[0]['access_to_page'], 'Patient List') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="{{ route('patientlist') }}"
                                                    class='submenu-link'>Patient List</a>
                                            </li>
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Quote Plan List') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="{{ route('quotelist') }}"
                                                    class='submenu-link'>Quote Plan List</a>
                                            </li>
                                        @endif
                                        @if (strpos($package[0]['access_to_page'], 'Insurance') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="{{ route('claimlist') }}"
                                                    class='submenu-link'>Insurance</a>
                                            </li>
                                        @endif
                                        </ul>
                                </div>
                            </li>
                        @endif


                            @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                                @if (strpos($package[0]['access_to_page'], 'Appointments') !== false)   
                                <li
                                    class="menu-item ">
                                    <a href="{{ route('addappontment') }}" class='menu-link'>
                                        <i class="fa-fw select-all fas fa-calendar-check"></i>
                                        <span>Appointments</span>
                                    </a>
                                </li>
                                @endif
                            @endif

                            @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3))
                                @if (strpos($package[0]['access_to_page'], 'Inventory') !== false)
                                <li
                                    class="menu-item ">
                                    <a href="{{ route('inventorylist') }}" class='menu-link'>
                                        <i class="fa-fw select-all fas"></i>
                                        <span>Inventory</span>
                                    </a>
                                </li>
                                @endif

                            @if (strpos($package[0]['access_to_page'], 'Accounts') !== false)
                                <li class="menu-item">
                                    <a href="{{ route('accountlist') }}" class='menu-link'>
                                        <i class="fa fa-user"></i>
                                        <span>Accounts</span>
                                    </a>
                                </li>
                            @endif
                            @if (strpos($package[0]['access_to_page'], 'Billing') !== false)

                            <li
	                            class="menu-item ">
	                            <a href="{{ route('billing') }}" class='menu-link'>
                                    <i class="fa-fw select-all fas"></i>
	                                <span>Billing</span>
	                            </a>
	                        </li>
                            @endif
                            
                            @endif
                            @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))

                            <li
                                class="menu-item  has-sub">
                                @if (strpos($package[0]['access_to_page'], 'Lab Management') !== false)
                                <a href="#" class='menu-link'>
                                    <i class="fa-fw select-all fas fa-envelope"></i>
                                    <span>Lab Management</span>
                                </a>
                                @endif
                                <div
                                    class="submenu ">
                                    Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it.
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4 || Auth::user()->roleNo == 5))
                                                @if (strpos($package[0]['access_to_page'], 'Dashboard') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ route('homemanage') }}"
                                                        class='submenu-link'>Dashboard</a>
                                                </li>
                                                @endif
                                            @endif
                                            @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4)
                                                @if (strpos($package[0]['access_to_page'], 'Lab Note') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ route('labnotelist') }}"
                                                        class='submenu-link'>Lab Note</a>
                                                </li>
                                                @endif
                                            @endif
                                            @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3)
                                                @if (strpos($package[0]['access_to_page'], 'Report') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ route('report') }}"
                                                        class='submenu-link'>Report</a>
                                                </li>
                                                @endif
                                                @if (strpos($package[0]['access_to_page'], 'Lab Master') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ url('/lablist') }}"
                                                        class='submenu-link'>Lab Master</a>
                                                </li>
                                                @endif
                                            @endif
                                            @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3 || Auth::user()->roleNo == 4)
                                                @if (strpos($package[0]['access_to_page'], 'Instructions Master') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ url('/notelist') }}"
                                                        class='submenu-link'>Instructions Master</a>
                                                </li>
                                                @endif
                                            @endif
                                            @if(Auth::user()->roleNo == 1  || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3)
                                                @if (strpos($package[0]['access_to_page'], 'Work Master') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ url('/TOWlist') }}"
                                                        class='submenu-link'>Work Master</a>
                                                </li>
                                                @endif
                                                @if (strpos($package[0]['access_to_page'], 'Shades Master') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ url('/shadelist') }}"
                                                        class='submenu-link'>Shades Master</a>
                                                </li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endif

                            @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3))


                            <li
                                class="menu-item  has-sub">
                                @if (strpos($package[0]['access_to_page'], 'Reports') !== false)
                                <a href="#" class='menu-link'>
                                    <i class="fa-fw select-all fas fa-envelope"></i>
                                    <span>Reports</span>
                                </a>
                                @endif
                                <div
                                    class="submenu ">
                                    Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it.
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                            @if (strpos($package[0]['access_to_page'], 'Gross Income Report') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="{{ route('grossincomereport') }}"
                                                    class='submenu-link'>Gross Income Report</a>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endif

                        
                        </ul>
                        @if(Auth::check() && (Auth::user()->roleNo == 1 || Auth::user()->roleNo == 2 || Auth::user()->roleNo == 3))

                        <ul>
                            <li class="menu-item  has-sub sub-menu-left">
                                @if (strpos($package[0]['access_to_page'], 'Settings') !== false)
                                <a href="#" class='menu-link'>
                                    <i class="fa fa-cog fa-1x"></i>
                                    <span>Settings</span>
                                </a>
                                @endif
                                <div class="submenu">
                                    Wrap to submenu-group-wrapper if you want 3-level submenu. Otherwise remove it.
                                    <div class="submenu-group-wrapper">
                                        <ul class="submenu-group">
                                        @if (strpos($package[0]['access_to_page'], 'Doctors') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="{{ route('doctorlist') }}"
                                                    class='submenu-link'>Doctors</a>
                                            </li>
                                            @endif
                                            @if (strpos($package[0]['access_to_page'], 'Treatments') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="{{ route('ref_treatments') }}"
                                                    class='submenu-link'>Treatments</a>
                                            </li>
                                            @endif
                                            @if (strpos($package[0]['access_to_page'], 'Medicines') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="{{ url('/medicines') }}"
                                                    class='submenu-link'>Medicines</a>
                                            </li>
                                            @endif
                                            @if (strpos($package[0]['access_to_page'], 'Concent Master') !== false)
                                            <li class="submenu-item">
                                                <a href="{{ url('consentmasterlist') }}" class='submenu-link'>Concent Master</a>
                                            </li>
                                            @endif
                                            @if(Auth::check() && (Auth::user()->roleNo == 1))
                                                @if (strpos($package[0]['access_to_page'], 'Plans') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ url('/planlist') }}"
                                                        class='submenu-link'>Plans</a>
                                                </li>
                                                @endif
                                                @if (strpos($package[0]['access_to_page'], 'Users') !== false)
                                                <li
                                                    class="submenu-item  ">
                                                    <a href="{{ url('/userslist') }}"
                                                        class='submenu-link'>Users</a>
                                                </li>
                                                @endif
                                            @endif
                                            @if (strpos($package[0]['access_to_page'], 'Server Backup') !== false)
                                            <li
                                                class="submenu-item  ">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#confirmDB_download"
                                                    class='submenu-link'>Server Backup</a>
                                            </li> 
                                            @endif                    
                                        </ul>
                                    </div>
                                </div> 
                            </li>                     
                        </ul>
                        @endif

                    </div>
                </nav> -->
            </header>
            <div class="modal fade text-left" id="confirmDB_download" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Are You Really Want to Download Backup Database</h4>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">No</span>
                                </button>
                                <button type="button" onclick=downloadDB() class="btn btn-primary ml-1"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Yes</span>
                                </button>
                            </div>
                    </div>
                </div>
            </div>
            <div class="container">
	            @yield('content')
	        </div>
            <!-- <footer>
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2021 &copy; Mazer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="https://saugi.me">Saugi</a></p>
                        </div>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>
    
    <!--<div class="color-customize-section">-->
    <!--    <div class="customize-btn">-->
    <!--        <a href="javascript:void(0)">-->
    <!--            <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M7 0.25C3.2725 0.25 0.25 3.2725 0.25 7C0.25 10.7275 3.2725 13.75 7 13.75C7.6225 13.75 8.125 13.2475 8.125 12.625C8.125 12.3325 8.0125 12.07 7.8325 11.8675C7.66 11.6725 7.5475 11.41 7.5475 11.125C7.5475 10.5025 8.05 10 8.6725 10H10C12.07 10 13.75 8.32 13.75 6.25C13.75 2.935 10.7275 0.25 7 0.25ZM2.875 7C2.2525 7 1.75 6.4975 1.75 5.875C1.75 5.2525 2.2525 4.75 2.875 4.75C3.4975 4.75 4 5.2525 4 5.875C4 6.4975 3.4975 7 2.875 7ZM5.125 4C4.5025 4 4 3.4975 4 2.875C4 2.2525 4.5025 1.75 5.125 1.75C5.7475 1.75 6.25 2.2525 6.25 2.875C6.25 3.4975 5.7475 4 5.125 4ZM8.875 4C8.2525 4 7.75 3.4975 7.75 2.875C7.75 2.2525 8.2525 1.75 8.875 1.75C9.4975 1.75 10 2.2525 10 2.875C10 3.4975 9.4975 4 8.875 4ZM11.125 7C10.5025 7 10 6.4975 10 5.875C10 5.2525 10.5025 4.75 11.125 4.75C11.7475 4.75 12.25 5.2525 12.25 5.875C12.25 6.4975 11.7475 7 11.125 7Z" fill="#2563EB"></path></svg>-->
    <!--            Customize-->
    <!--        </a>-->
    <!--    </div>-->
    <!--    <div class="color-customize-holder">-->
    <!--        <div class="color-customize">-->
    <!--            <a href="javascript:void(0)" style="background-color: rgb(8, 172, 242);" class="color1 color-select" data-theme="color-blue"></a>-->
    <!--            <a href="javascript:void(0)" style="background-color: rgb(0, 172, 151);" class="color2 color-select" data-theme="color-green"></a>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/app.js') }}"></script> -->
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/pages/horizontal-layout.js') }}"></script>
    <script src="{{ url('/') }}/assets/js/jquery.datetimepicker.js"></script>

    <script src="https://rawcdn.githack.com/nextapps-de/spotlight/0.7.8/dist/js/spotlight.min.js"></script>

	<!-- <script src="assets/extensions/apexcharts/apexcharts.min.js"></script> -->
	<!-- <script src="assets/js/pages/dashboard.js"></script> -->
    <script>
        // function hideDiv() {
	    //     $("#toggle-dark").change(function () {
        //         $("body").stop(function(){
        //             sessionStorage.setItem("sidebar-menu-show", $("body").css("display"));
        //             console.log(sessionStorage.getItem("sidebar-menu-show"))
        //         });
	    //     });
        //     if (sessionStorage.getItem("sidebar-menu-show")) {
        //         $("body").css("display", sessionStorage.getItem("sidebar-menu-show"));
        //     }
        // }       

         $(document).ready(function() {
            $('#toggle-dark').change(function() {
                if($(this).is(":checked")) {
                    $('body').addClass('sidebar-menu-show');
                    $('body').removeClass('sidebar-menu-hide');
                    sessionStorage.setItem("sidebar-menu-show", "Hello");
                } else {
                    $('body').removeClass('sidebar-menu-show');
                    $('body').addClass('sidebar-menu-hide');
                    sessionStorage.removeItem("sidebar-menu-show", "Hello");
                }
                console.log(sessionStorage.getItem("sidebar-menu-show"));
            });
            $('.side-menu-icon').click(function() {
                $('#sidebar').addClass('active');
            });
            $('.sidebar-toggler').click(function() {
                $('#sidebar').removeClass('active');
            });

            // if (sessionStorage.getItem("sidebar-menu-show")) {
                $('body').addClass('sidebar-menu-show');
                $('body').removeClass('sidebar-menu-hide');
                $('#toggle-dark').attr('checked', true);
            // }

            // hideDiv();

                // $("#toggle-dark").change(function() {
                //     //set sessionStorage on click
                //     sessionStorage.setItem("sidebar-menu-show", "Hello");
                //     //$("#Notice").remove();
                //     $('body').addClass('sidebar-menu-show');
                //     $('body').removeClass('sidebar-menu-hide');
                //     console.log(sessionStorage.getItem("sidebar-menu-show"))
                // });
                // if (sessionStorage.getItem("sidebar-menu-show"))
                // //When sessionStorage is set Do stuff...
                // $('body').addClass('sidebar-menu-show'); 
                // $('body').removeClass('sidebar-menu-hide');     
                
            // function change_menu() {
            //     sessionStorage.setItem("sidebar-menu-show", "Hello");
            //     sessionStorage.setItem("sidebar-menu-hide", "Helloo");
            //     console.log(sessionStorage.getItem("sidebar-menu-show"));
            // }
            
            // $("#toggle-dark").click(function() {
            //     change_menu();
            // });
            
            $('.color-select').click(function(){
                var color = $(this).attr("data-theme");
                $('html').removeClass(color).addClass(color);
            });

            $('.js-sub-menu').click(function() {
                $(this).toggleClass('submenu-active');
                $(this).children('.submenu').toggleClass('submenu-show');
            });

        });


    </script>
    <script>
        function downloadDB(){
            window.location.href = "{{ url('/download') }}";
        }
    </script>
     <script>
        $(document).ready(function () {
            // Function to hide .main-navbar based on screen width
            function hideNavbarBasedOnScreenWidth() {
                var screenWidth = $(window).width(); // Get the current screen width
                if (screenWidth <= 1200) {
                    $('.main-navbar').hide(); // Hide .main-navbar if screen width is less than or equal to 1200 pixels
                } else {
                    $('.main-navbar').show(); // Show .main-navbar if screen width is greater than 1200 pixels
                }
            }

            // Initial call to the function on page load
            hideNavbarBasedOnScreenWidth();

            // Listen for window resize events
            $(window).resize(function () {
                // Call the function whenever the window is resized
                hideNavbarBasedOnScreenWidth();
            });
        });
    </script>
    <script>
		var textLogo = '{{ env('TEXT_LOGO') }}';
		var imgLogo = '{{ env('IMG_LOGO') }}';
        var imgElement = document.getElementById('imglogo');
        imgElement.src = imgLogo;
        var imgEle = document.getElementById('imglogo2');
        imgEle.src = imgLogo;
        $('#textLogo').text(textLogo);
        $('#textLogo2').text(textLogo);


        if (textLogo && textLogo.trim() !== '') {
        // If textLogo is not empty, hide the image elements
            imgElement.style.display = 'none';
            imgEle.style.display = 'none';
        } else {
            // If textLogo is empty or null, display the image elements
            imgElement.src = imgLogo;
            imgEle.src = imgLogo;
        }
	</script>

	@yield('jsscript')
</body>

</html>
