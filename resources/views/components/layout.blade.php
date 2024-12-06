<!DOCTYPE html>
<html lang="en">

<x-header>{{ $title }}</x-header>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">
            <div class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard"
                aria-label="E-Voting Dashboard">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-vote-yea fa-2x text-white"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-white">E-Ovoz</div>
            </div>

            <hr class="sidebar-divider my-0">

            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="">
                        <i class="fas fa-fw fa-chart-area fa-lg text-white"></i>
                        <span class="sidebar-text text-white">Dashboard</span>
                    </a>
                </li>
            </ul>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('candidate.index') }}">
                    <i class="fas fa-users fa-lg text-white"></i>
                    <span class="sidebar-text text-white">Nomzodlar</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('voter.index') }}">
                    <i class="fas fa-person-booth fa-lg text-white"></i>
                    <span class="sidebar-text text-white">Ovoz berganlar</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0 text-white" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <x-topbar></x-topbar>

                <div class="container-fluid">
                    {{ $slot }}
                </div>

            </div>

            <x-footer></x-footer>

        </div>
    </div>

    <script src={{ asset('template/vendor/jquery/jquery.min.js') }}></script>
    <script src={{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

    <script src={{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}></script>

    <script src={{ asset('template/js/sb-admin-2.min.js') }}></script>
</body>

</html>
