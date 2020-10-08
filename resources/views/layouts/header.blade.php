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
                <span class="button-toggle" onclick="sideBar()">
                    <i id="btn-sideBar" class="fas fa-angle-double-left"></i>
                </span>
            </div>
            <div class="d-flex justify-content-between">
                <img src="{{ asset('image/logo.png') }}" alt="">
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i><span class="clearfix d-none d-sm-inline-block">&nbspConta</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#"><i class="fas fa-user-edit">
                                </i>&nbspEditar Perfil
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span>
                                <i class="fas fa-user-slash"></i>&nbspDesconectar
                            </span>
                        </a>
                    </li>
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
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-edit"></i>&nbspEditar Perfil
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user-slash"></i>&nbspDesconectar
                    </a>
                </div>
            </div>
        </nav>
    </div>

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
                </div>
            </li>
        </ul>
    </div>

    <!-- C O N T E U D O -->
    <div class="content" id="site-content">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('js/app.js')}} "></script>
    <script src="{{ asset('js/mask.js')}} "></script>
    <script src="{{ asset('js/custom.js')}} "></script>
</body>

</html>
