<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
  <meta name="base_url" content="{{ URL::to('/') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta name="description" content="Admin, Dashboard, Bootstrap" />
	<link rel="shortcut icon" sizes="196x196" href="{{ asset('assets/images/logo.png') }}">
	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <title>{{ config('app.name', 'Bradken Admin Panel') }}</title> -->	
    <title>{{ Config::get('settings.name') }}</title>	
    <!-- Styles -->
	<link rel="stylesheet" href="{{ asset('libs/bower/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css') }}">
	<!-- build:css ../assets/css/app.min.css -->
	<link rel="stylesheet" href="{{ asset('libs/bower/animate.css/animate.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ asset('libs/bower/perfect-scrollbar/css/perfect-scrollbar.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
	<!-- endbuild -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
  <!-- Scripts -->
  <!--<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>-->
  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/common-function.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('assets/js/jquery-1.12.4.js') }}"></script>
	<script>
		Breakpoints();
	</script>
  <style type="text/css">
  .error {
    color: #f51814;
    font-weight: 500;  
  }
  </style>
</head>
	
<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<!-- Start Delete Pop-UP -->
<!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Delete item</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to delete this item ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm" onclick="return fu">Delete</button>
      </div>
    </div>
  </div>
</div>

<!-- APP NAVBAR ==========-->
<nav id="app-navbar" class="navbar navbar-inverse navbar-fixed-top primary">
  
  <!-- navbar header -->
  <div class="navbar-header">
    <button type="button" id="menubar-toggle-btn" class="navbar-toggle visible-xs-inline-block navbar-toggle-left hamburger hamburger--collapse js-hamburger">
      <span class="sr-only">Toggle navigation</span>
      <span class="hamburger-box"><span class="hamburger-inner"></span></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-more"></span>
    </button>

    <button type="button" class="navbar-toggle navbar-toggle-right collapsed" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
      <span class="sr-only">Toggle navigation</span>
      <span class="zmdi zmdi-hc-lg zmdi-search"></span>
    </button>

    <a href="{{ URL::to('home') }}" class="navbar-brand">
      <span class="brand-icon"><img src="{{ asset('assets/images/bradken-logo.png') }}"></span>
      <span class="brand-name">{{ Config::get('settings.Project.title') }}</span>
    </a>
  </div><!-- .navbar-header -->
  
  <div class="navbar-container container-fluid">
    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <ul class="nav navbar-toolbar navbar-toolbar-left navbar-left">
        <!-- <li class="hidden-float hidden-menubar-top">
          <a href="javascript:void(0)" role="button" id="menubar-fold-btn" class="hamburger hamburger--arrowalt is-active js-hamburger">
            <span class="hamburger-box"><span class="hamburger-inner"></span></span>
          </a>
        </li> -->
        <li>
          <h5 class="page-title hidden-menubar-top hidden-float"></h5>
        </li>
      </ul>

      <ul class="nav navbar-toolbar navbar-toolbar-right navbar-right">
        <!-- <li class="nav-item dropdown hidden-float">
          <a href="javascript:void(0)" data-toggle="collapse" data-target="#navbar-search" aria-expanded="false">
            <i class="zmdi zmdi-hc-lg zmdi-search"></i>
          </a>
        </li> -->

        <li class="dropdown">
          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="zmdi zmdi-hc-lg zmdi-settings"></i></a>
          <ul class="dropdown-menu animated flipInY">
            <!--<li><a href="javascript:void(0)"><i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i>Log Out</a></li>-->
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="zmdi m-r-md zmdi-hc-lg zmdi-account-box"></i> Logout
                </a>    
            </li>          
          </ul>
        </li>

        
      </ul>
    </div>
  </div><!-- navbar-container -->
</nav>
<!--========== END app navbar -->

<!-- APP ASIDE ==========-->
<aside id="menubar" class="menubar light">
  <div class="app-user">
    <div class="media">
      <div class="media-left">
        <div class="avatar avatar-md avatar-circle">
          <a href="javascript:void(0)"><img class="img-responsive" src="{{ asset('assets/images/221.jpg') }}" alt="avatar"></a>
        </div><!-- .avatar -->
      </div>
      <div class="media-body">
        <div class="foldable">
          @if(Auth::check())
          <h5><a href="javascript:void(0)" class="username">{{ ucfirst(Auth::user()->name) }}</a></h5>
          <ul>
            <!--<li class="dropdown">
              <a class="text-color" href="logout.php">
                    <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                    <span>Logout</span>
                  </a>              
            </li>-->
            <li class="dropdown">
                <a class="text-color" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                   <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                   <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
          </ul>
           @endif
        </div>
      </div><!-- .media-body -->
    </div><!-- .media -->
  </div><!-- .app-user -->

  <div class="menubar-scroll">
    <div class="menubar-scroll-inner">
      <ul class="app-menu">
        <li class="{{ request()->is('home') ? 'active open' : '' }}" class="has-submenu">
          <a href="{{ URL::to('home') }}">
            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
            <span class="menu-text">Dashboards</span>            
          </a>         
        </li>
		   <?php
         $indentorMenu = '';
         if(request()->is('indentors')) { $indentorMenu = "active open"; } elseif(request()->is('indentor/create')) { $indentorMenu = "active open"; }elseif(Request::segment(1) == "indentor") {  $indentorMenu = "active open";  }
       ?>
		<li class="{{ $indentorMenu }}" class="has-submenu">
          <a href="{{ URL::to('indentors') }}">
            <i class="menu-icon zmdi zmdi-swap-vertical-circle zmdi-hc-fw"></i>
            <span class="menu-text">Indentor Master</span>            
          </a>         
        </li>
		<?php $departmentMenu = ''; if(request()->is('departments')) { $departmentMenu = "active open"; } elseif(request()->is('department/create')) { $departmentMenu = "active open"; }elseif(Request::segment(1) == "department") {  $departmentMenu = "active open";  } ?>
    <li class="{{ $departmentMenu }}" class="has-submenu">
          <a href="{{ URL::to('departments') }}">
            <i class="menu-icon zmdi zmdi-local-convenience-store zmdi-hc-fw"></i>
            <span class="menu-text">Department Master</span>            
          </a>         
        </li>
    <?php $vendorMenu = ''; if(request()->is('vendors')) { $vendorMenu = "active open"; } elseif(request()->is('vendor/create')) { $vendorMenu = "active open"; }elseif(Request::segment(1) == "vendor") {  $vendorMenu = "active open";  } ?>
		<li class="{{ $vendorMenu }}" class="has-submenu">
          <a href="{{ URL::to('vendors') }}">
            <i class="menu-icon zmdi zmdi-accounts-outline zmdi-hc-fw"></i>
            <span class="menu-text">Vendor Master</span>            
          </a>         
        </li>
		<?php $uomMenu = ''; if(request()->is('uoms')) { $uomMenu = "active open"; } elseif(request()->is('uom/create')) { $uomMenu = "active open"; }elseif(Request::segment(1) == "uom") {  $uomMenu = "active open";  } ?>
		<li class="{{ $uomMenu }}" class="has-submenu">
          <a href="{{ URL::to('uoms') }}">
            <i class="menu-icon zmdi zmdi-ruler zmdi-hc-fw"></i>
            <span class="menu-text">UOM Master</span>            
          </a>         
        </li>		
		<!-- <li class="has-submenu">
          <a href="{{ URL::to('delivery_types') }}">
            <i class="menu-icon zmdi zmdi-truck zmdi-hc-fw"></i>
            <span class="menu-text">Delivery Type</span>            
          </a>         
        </li> -->
    <?php $deliveryNoteMenu = ''; if(request()->is('delivery_notes')) { $deliveryNoteMenu = "active open"; } elseif(request()->is('delivery_note/create')) { $deliveryNoteMenu = "active open"; }elseif(Request::segment(1) == "delivery_note") {  $deliveryNoteMenu = "active open";  } ?>    		
		<li class="{{ $deliveryNoteMenu }}" class="has-submenu">
          <a href="{{ URL::to('delivery_notes') }}">
            <i class="menu-icon zmdi zmdi-balance zmdi-hc-fw"></i>
            <span class="menu-text">Delivery Note</span>            
          </a>         
        </li>
    <?php $returnableMenu = ''; if(request()->is('delivery_notes/returnable_reports')) { $returnableMenu = "active open"; } ?>
    <li class="{{ $returnableMenu }}" class="has-submenu">
          <a href="{{ URL::to('delivery_notes/returnable_reports') }}">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Returnable Report</span>            
          </a>         
    </li>  
    <?php $nonReturnableMenu = ''; if(request()->is('delivery_notes/not_returnable_reports')) { $nonReturnableMenu = "active open"; } ?>
    <li class="{{ $nonReturnableMenu }}" class="has-submenu">
          <a href="{{ URL::to('delivery_notes/not_returnable_reports') }}">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Non-Returnable Report</span>            
          </a>         
    </li> 
    <?php $deliveryReportMenu = ''; if(request()->is('delivery_notes/deliver_note_report')) { $deliveryReportMenu = "active open"; } ?>
    <li class="{{ $deliveryReportMenu }}" class="has-submenu">
          <a href="{{ URL::to('delivery_notes/deliver_note_report') }}">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Delivery Note Report</span>            
          </a>         
    </li>    
		
		<!-- <li class="has-submenu">
          <a href="javascript:void(0)" class="submenu-toggle">
            <i class="menu-icon zmdi zmdi-file-text zmdi-hc-lg"></i>
            <span class="menu-text">Reports</span>
            <i class="menu-caret zmdi zmdi-hc-sm zmdi-chevron-right"></i>
          </a>
          <ul class="submenu">
            <li><a href="{{ URL::to('delivery_note/returnable_reports') }}"><span class="menu-text">Returnable Report</span></a></li>
            <li><a href="{{ URL::to('delivery_note/not_returnable_reports') }}"><span class="menu-text">Non-Returnable Report</span></a></li>
			      <li><a href="{{ URL::to('delivery_note/deliver_note_report') }}"><span class="menu-text">Delivery Note Report</span></a></li>
          </ul>
    </li> -->		
      </ul><!-- .app-menu -->
    </div><!-- .menubar-scroll-inner -->
  </div><!-- .menubar-scroll -->
</aside>
<!--========== END app aside -->

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
  <div class="wrap">
    <section class="app-content">
      <div class="row">

          @yield('content')

      </div> <!-- row -->
    </section>
  </div>
<!-- APP FOOTER -->
  <div class="wrap p-t-0">
    <footer class="app-footer">
      <div class="clearfix">        
        <div class="copyright pull-left">Copyright &copy; 2017 <a href="" target="_blank">Bradken Pvt. Ltd,.</a> Crafted by:<a href="http://www.agnaindia.com" target="_blank">Agna India</a> </div>
      </div>
    </footer>
  </div>
  <!-- /#app-footer -->
</main>
<!--========== END app main -->

	<!-- APP CUSTOMIZER -->
	<!-- <div id="app-customizer" class="app-customizer">
		<a href="javascript:void(0)" 
			class="app-customizer-toggle theme-color" 
			data-toggle="class" 
			data-class="open"
			data-active="false"
			data-target="#app-customizer">
			<i class="fa fa-gear"></i>
		</a>
		<div class="customizer-tabs">
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active"><a href="#menubar-customizer" aria-controls="menubar-customizer" role="tab" data-toggle="tab">Menubar</a></li>				
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane in active fade" id="menubar-customizer">
					<div class="hidden-menubar-top hidden-float">
						<div class="m-b-0">
							<label for="menubar-fold-switch">Fold Menubar</label>
							<div class="pull-right">
								<input id="menubar-fold-switch" type="checkbox" data-switchery data-size="small" />
							</div>
						</div>
						<hr class="m-h-md">
					</div>
					<div class="radio radio-default m-b-md">
						<input type="radio" id="menubar-light-theme" name="menubar-theme" data-toggle="menubar-theme" data-theme="light">
						<label for="menubar-light-theme">Light</label>
					</div>
					<div class="radio radio-inverse m-b-md">
						<input type="radio" id="menubar-dark-theme" name="menubar-theme" data-toggle="menubar-theme" data-theme="dark">
						<label for="menubar-dark-theme">Dark</label>
					</div>
				</div>				
			</div>
		</div>
		<hr class="m-0">
	</div> -->	

	<!-- build:js ./assets/js/core.min.js -->
	<script src="{{ asset('libs/bower/jquery/dist/jquery.js') }}"></script>
	<script src="{{ asset('libs/bower/jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('libs/bower/jQuery-Storage-API/jquery.storageapi.min.js') }}"></script>
	<script src="{{ asset('libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js') }}"></script>
	<script src="{{ asset('libs/bower/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset('libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
	<script src="{{ asset('libs/bower/PACE/pace.min.js') }}"></script>
	<!-- endbuild -->

	<!-- build:js ../assets/js/app.min.js -->
	<script src="{{ asset('assets/js/library.js') }}"></script>
	<script src="{{ asset('assets/js/plugins.js') }}"></script>
	<script src="{{ asset('assets/js/app.js') }}"></script>
	<!-- endbuild -->
	<script src="{{ asset('libs/bower/moment/moment.js') }}"></script>
	<script src="{{ asset('libs/bower/fullcalendar/dist/fullcalendar.min.js') }}"></script>
	<script src="{{ asset('assets/js/fullcalendar.js') }}"></script>
</body>
</html>
