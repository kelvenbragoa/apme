<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>APME-Associado</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('template/assets/images/logos/favicon.png')}}" />
  {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link rel="stylesheet" href="{{asset('template/assets/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div id="app">
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <router-link to="/associate/dashboard" class="text-nowrap logo-img">
            <img src="{{asset('template/assets/images/logos/logo.png')}}" width="180" alt="" />
          </router-link>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <div class="brand-logo d-flex align-items-center justify-content-center">
          <strong>Associado</strong>
          </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Inicio</span>
            </li>
            
            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/dashboard" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Painel de Controlo</span>
              </router-link>
            </li>
            {{-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Usuários</span>
            </li>
            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/associates" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">associateistradores</span>
              </router-link>
            </li>
            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/managers" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Gestores</span>
              </router-link>
            </li> --}}

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Gerência</span>
            </li>
            

            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/associates" aria-expanded="false">
                <span>
                  <i class="ti ti-user"></i>
                </span>
                <span class="hide-menu">Associado</span>
              </router-link>
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Finanças</span>
            </li>

            {{-- <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/associates" aria-expanded="false">
                <span>
                  <i class="ti ti-coin"></i>
                </span>
                <span class="hide-menu">Despesas</span>
              </router-link>
            </li> --}}

            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/quotes" aria-expanded="false">
                <span>
                  <i class="ti ti-analyze"></i>
                </span>
                <span class="hide-menu">Quotas do Associado</span>
              </router-link>
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Diversos</span>
            </li>

            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/events" aria-expanded="false">
                <span>
                  <i class="ti ti-clipboard"></i>
                </span>
                <span class="hide-menu">Eventos</span>
              </router-link>
            </li>

            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/calendars" aria-expanded="false">
                <span>
                  <i class="ti ti-calendar"></i>
                </span>
                <span class="hide-menu">Calendário</span>
              </router-link>
            </li>

            {{-- <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/associates" aria-expanded="false">
                <span>
                  <i class="ti ti-activity"></i>
                </span>
                <span class="hide-menu">Relatórios</span>
              </router-link>
            </li> --}}

            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/notifications" aria-expanded="false">
                <span>
                  <i class="ti ti-bell"></i>
                </span>
                <span class="hide-menu">Notificações</span>
              </router-link>
            </li>

            {{-- <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/associates" aria-expanded="false">
                <span>
                  <i class="ti ti-message"></i>
                </span>
                <span class="hide-menu">Mensagens</span>
              </router-link>
            </li> --}}

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Autenticação</span>
            </li>

            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/configurations" aria-expanded="false">
                <span>
                  <i class="ti ti-settings"></i>
                </span>
                <span class="hide-menu">Configurações</span>
              </router-link>
            </li>



            <li class="sidebar-item">
              <form action="{{route('logout')}}" method="POST">
                @csrf
                
           
              <a class="sidebar-link" href="#" onclick="event.preventDefault(); this.closest('form').submit()" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </form>
            </li>


            {{-- <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Componentes</span>
            </li>
            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/associates" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Categorias</span>
              </router-link>
            </li>
            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/products" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Productos</span>
              </router-link>
            </li>
            <li class="sidebar-item">
              <router-link class="sidebar-link" to="/associate/expenses" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Expenses</span>
              </router-link>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Card</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Forms</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                <span>
                  <i class="ti ti-typography"></i>
                </span>
                <span class="hide-menu">Typography</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">AUTH</span>
            </li>
            <li class="sidebar-item">
              <form action="{{route('logout')}}" method="POST">
                @csrf
                
           
              <a class="sidebar-link" href="#" onclick="event.preventDefault(); this.closest('form').submit()" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Logout</span>
              </a>
            </form>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                <span>
                  <i class="ti ti-login"></i>
                </span>
                <span class="hide-menu">Login</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                <span>
                  <i class="ti ti-user-plus"></i>
                </span>
                <span class="hide-menu">Register</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">EXTRA</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                <span>
                  <i class="ti ti-mood-happy"></i>
                </span>
                <span class="hide-menu">Icons</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Sample Page</span>
              </a>
            </li> --}}
          </ul>
          <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
            <div class="d-flex">
              <div class="unlimited-access-title me-3">
                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Desenvolvido por INOVATIS MZ LTD</h6>
                <a href="https://inovatis.co.mz" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Acessar</a>
              </div>
             
            </div>
          </div>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
           
          </ul>

          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
           
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
             
              <li class="nav-item dropdown">
                <router-link class="nav-link nav-icon-hover"to="/associate/notifications" aria-expanded="false">
                
                  <i class="ti ti-bell-ringing"></i><small style="font-size:12px">{{count(Auth::user()->unreadNotifications)}}</small>
                  <div class="notification bg-primary rounded-circle"></div>
                </router-link>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop1">
                  
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('template/assets/images/logos/logo.png')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="#" class="d-flex align-items-center gap-2 dropdown-item">
                     
                      <p class="mb-0 fs-3">{{Auth::user()->name}}</p>
                    </a>
                    <hr>
                    
                      <router-link class="d-flex align-items-center gap-2 dropdown-item"  to="/associate/configurations" aria-expanded="false">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">Configurações</p>
                      </router-link>
                    
                    <form action="{{route('logout')}}" method="POST">
                      @csrf
                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit()" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>


      <!--  Header End -->
      <div  class="container-fluid">
       
        {{-- <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Sample Page</h5>
            <p class="mb-0">This is a sample page </p>
          </div>
        </div> --}}
        <router-view></router-view>
      </div>



    </div>
  </div>
</div>
  <script src="{{asset('template/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('template/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('template/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('template/assets/js/app.min.js')}}"></script>
  <script src="{{asset('template/assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
</body>

</html>