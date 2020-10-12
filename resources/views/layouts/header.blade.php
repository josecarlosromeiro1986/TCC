<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Place your kit's code here -->
    <script src="https://kit.fontawesome.com/662f82abf9.js" crossorigin="anonymous" SameSite="none"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <div class="top-menu">
        <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-cst top-menu">
            <div class="breadcrumb-dn mr-auto">
                @guest
                @else
                    <span class="button-toggle" onclick="sideBar()">
                        <i id="btn-sideBar" class="fas fa-angle-double-left"></i>
                    </span>
                @endguest
            </div>
            <div class="d-flex justify-content-between">
                <img src="{{ asset('image/logo.png') }}" alt="">
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    @guest
                    @else
                        <li class="text-light">
                            <i class="fa fa-user"></i><span class="clearfix d-none d-sm-inline-block">&nbsp{{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                <span>
                                    <i class="fas fa-user-slash"></i>&nbspDesconectar
                                </span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </div>
            </ul>
            <div class="dropdown">
                <button class="btn btn-secondary navbar-toggler" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span>
                        <i class="fas fa-user"></i>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item " href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-user-slash"></i>&nbspDesconectar
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </nav>
    </div>
    @guest
    <div class="lateral-menu toHide"></div>
    @else
    <!-- M E N U   -   L A T E R A L -->
    <div class="lateral-menu shadow" id="menu">
        <ul class="nav flex-column">
            <li class="nav-item item-lateral-menu">
                <a class="nav-link link-lateral-menu @yield('activeOffice')" href="{{ route('office.index') }}" id="1">
                    <i class="fas fa-user-tie"></i>&nbspCargos
                </a>
            </li>
            {{-- <li class="nav-item item-lateral-menu">
                <a class="nav-link link-lateral-menu @yield('activeTypePhone')" href="{{ route('typePhone.index') }}"
                    id="1">
                    <i class="fas fa-phone-alt"></i>&nbspTipo de Telefone
                </a>
            </li> --}}
            <li class="nav-item item-lateral-menu">
                <a class="nav-link link-lateral-menu @yield('activeUser')" href="{{ route('collaborator.index') }}"
                    id="1">
                    <i class="fas fa-user-friends"></i>&nbspUsuarios
                </a>
            </li>
            <li class="nav-item item-lateral-menu">
                <a class="nav-link link-lateral-menu @yield('activeCli')" href="{{ route('client.index') }}">
                    <i class="fas fa-users"></i>&nbspClientes
                </a>
            </li>
            <li class="nav-item item-lateral-menu">
                <a class="nav-link link-lateral-menu @yield('activeCreateAtt')" href="{{ route('attendance.create') }}">
                    <i class="fas fa-clipboard-list"></i>&nbspNovo Atendimentos
                </a>
            </li>
            <li class="nav-item item-lateral-menu">
                <a class="nav-link link-lateral-menu @yield('activeAtt')" href="{{ route('attendance.index') }}">
                    <i class="fas fa-clipboard-list"></i>&nbspAtendimentos
                </a>
            </li>
            <li class="nav-item item-lateral-menu">
                <a class="nav-link link-lateral-menu @yield('activeSch')" href="{{ route('collaborators') }}">
                    <i class="far fa-calendar-alt"></i>&nbspAgenda
                </a>
            </li>
            <li class="nav-item item-lateral-menu dropdown">
                <a class="nav-link link-lateral-menu dropdown-toggle @yield('activeRep')" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-file-alt"></i>&nbspRelatórios
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{ route('reports.collaborator') }}">
                        <i class="far fa-chart-bar"></i>&nbspColaboradores
                    </a>
                    <a class="dropdown-item" href="{{ route('reports.client') }}">
                        <i class="far fa-chart-bar"></i>&nbspClientes
                    </a>
                    <a class="dropdown-item" href="{{ route('reports.attendance') }}">
                        <i class="far fa-chart-bar"></i>&nbspAtendimentos
                    </a>
                    <a class="dropdown-item" href="{{ route('reports.tatuador') }}">
                        <i class="far fa-chart-bar"></i>&nbspTatuadores
                    </a>
                </div>
            </li>
        </ul>
    </div>
    @endguest

    <!-- C O N T E U D O -->
    @guest
        <div class="content expand" id="site-content">
            <br />
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Senha') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-cst">
                                                {{ __('Entrar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="content" id="site-content">
            <div class="container">
                @yield('content')
            </div>
        </div>
    @endguest
    <script src="{{ asset('js/app.js')}} "></script>
    <script src="{{ asset('js/mask.js')}} "></script>
    <script src="{{ asset('js/custom.js')}} "></script>
</body>

</html>
