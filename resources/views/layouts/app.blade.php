<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{App\User::getAppName()}}</title>

    <!-- Styles -->
    @if(App\User::getAppTheme() == false)
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/dark-app.css') }}" rel="stylesheet">
    @endif
    <!-- SB CSS -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <script>
  function markAsRead(id) 
  {
    $.ajax({
      type:'POST',
      url:'/markAsRead',
      data:{"id":id},
      success:function(data)
      {
        $('#not'+id+' #notifications span').text('U markua si e lexuar');
        $('#not'+id+' #notifications span').addClass('text-success');
        $('#not-number').text($('#not-number').text() - 1 );
        setTimeout(function(){
          $('#not'+id).remove();
        }, 1000);
      }
    });
  } 
  </script>
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
          <img src="{{App\User::getLogo()}}" class="img-fluid"/>
        </div>
        <div class="sidebar-brand-text mx-3">{{App\User::getAppName()}}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item @yield('dashboard')">
        <a class="nav-link " href="/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Kryefaqja</span></a>
      </li>

      <li class="nav-item  @yield('calendar')">
        <a class="nav-link" href="/calendar">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Kalendari</span></a>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

     
      
      <!-- Nav Item - Charts -->
      <li class="nav-item  @yield('appointment')">
        <a class="nav-link" href="/appointment">
          <i class="fas fa-fw fa-calendar"></i>
          <span>Terminet</span></a>
      </li>

    

      <li class="nav-item  @yield('pacient')">
        <a class="nav-link" href="/pacient">
          <i class="fas fa-fw fa-user"></i>
          <span>Pacientet</span></a>
      </li>

      <li class="nav-item  @yield('visit')">
        <a class="nav-link" href="/visit">
          <i class="fas fa-fw fa-eye"></i>
          <span>Vizita</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item  @yield('treatment')">
        <a class="nav-link" href="/treatment">
          <i class="fas fa-fw fa-syringe"></i>
          <span>Trajtimi</span></a>
      </li>
      <li class="nav-item  @yield('report')">
        <a class="nav-link" href="/report">
          <i class="fas fa-fw fa-scroll"></i>
          <span>Raporti</span></a>
      </li>
      <li class="nav-item  @yield('service')">
        <a class="nav-link" href="/services">
          <i class="fas fa-fw fa-list"></i>
          <span>Sherbimet</span></a>
      </li>
      <li class="nav-item  @yield('debt') @yield('bill')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa- fw fa-money-bill"></i>
          <span>Shpenzimet</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/bill">Faturat</a>
            <a class="collapse-item" href="/debt">Borgjet</a>
          </div>
        </div>
      </li>
      <li class="nav-item  @yield('settings')">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa- fw fa-cog"></i>
          <span>Aranzhimi</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/user">Përdoruesit</a>
            <a class="collapse-item" href="/role">Rolet</a>
          </div>
        </div>
      </li>
    
      
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" class="@if(App\User::getAppTheme() == true) bg-secondary @else bg-white @endif ">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light @if(App\User::getAppTheme() == true) bg-dark @else bg-white @endif topbar mb-4 static-top shadow">

              <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

          @if(Auth::check())
          <!-- Topbar Search -->
          <form method="GET" action="{{ url('search') }}" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group mb-3">
            <input type="text" class="form-control bg-light " placeholder="Kërko..." name="search" value="@if(isset($keyword)) {{$keyword}} @endif" id="search" aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary btn-sm px-3" >
                  <i class="fa fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
          @else 
          @endif

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            @if(Auth::check())
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search" method="GET" action="{{ url('search') }}" >
                  <div class="input-group">
                      <input type="text" class="form-control bg-light " placeholder="Kërko..." name="search" value="@if(isset($keyword)) {{$keyword}} @endif" id="search" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm px-3" type="submit">
                        <i class="fa fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                @if(App\Notifications::getNotificationsNumber() > 0)
                <span id="not-number" class="badge badge-danger badge-counter">{{App\Notifications::getNotificationsNumber()}}</span>
                @else 
                @endif
                
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right keep-open-on-click shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Njoftimet
                </h6>
                <ul id="notifications-list" class="list-group">
                @if(App\Notifications::getNotificationsNumber() === 0)
                <li class="list-group-item p-0">
                <a class="dropdown-item d-flex align-items-center" href="/notifications">
                  <div class="mr-3">
                  </div>
                  <div>
                    <span>Nuk ka njoftime</span>
                  </div>
                </a>
                </li>
                @else
                
                @foreach(App\Notifications::getNotifications() as $not)
              <li id="not{{$not->id}}" class="list-group-item p-0">
                <div class="dropdown-item d-flex align-items-center" >
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div id="notifications">
                    <div class="small text-gray-500">{{$not->created_at}}</div>
                    <span class="font-weight-bold">{{$not->description}}!</span>
                  </div>
                  <div class="float-right">
                      <a class="close" href="#" id="deleteNotification" onclick ="markAsRead({{$not->id}})" >
                          <span>&times;</span>
                      </a>
                  </div>
                </div>
              </li>
                @endforeach
                
                </ul>
                @endif
                <a class="dropdown-item text-center small text-gray-500" href="/notifications">Shiko të gjitha njoftimet</a>
              </div>
            </li>

            

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{auth()->user()->name}}</span>
                <i class="fas fa-fw fa-user rounded-circle"></i>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="/user/{{Auth::user()->id}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profili
                </a>
                <a class="dropdown-item" href="/settings">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Aranzhimi
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Dil
                </a>
              </div>
               <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Dëshironi të dilni?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
        </div>
        <div class="modal-body">A jeni i sigurtë që dëshironi të dilni?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Jo</button>
          
            <button type="submit" class="btn btn-primary" >Dil</button>
           </form>
        </div>
      </div>
    </div>
  </div>

            </li>
            @else 
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link text-secondary @yield('login')" href="/login" id="userDropdown">
              Log in
              </a>
              <!-- Dropdown - User Information -->
            </li>

          </ul>
       
        @endif

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        @if(session('error'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gabim</strong>  {{session('error')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              
        @endif
              @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses</strong>  {{session('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
		            
	            
            @endif

            @yield('content')
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer @if(App\User::getAppTheme() == true) bg-dark @else bg-white @endif ">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Kreative Programming Team 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 
    
  
    <!-- Scripts -->
    <script src="{{ asset('js/app.js')}}"></script>
</html>
