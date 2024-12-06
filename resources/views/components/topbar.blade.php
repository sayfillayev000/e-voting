<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    @cannot('is-voter')
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" aria-label="Toggle Sidebar">
            <i class="fa fa-bars"></i>
        </button>
    @endcannot

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <div style="display: grid; grid-template-columns: 1fr auto; max-width: 300px;">
                    <span class="mr-3 mt-2 d-lg-inline text-gray-600 small"
                        style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        Assalumu aleykum {{ auth()->user()->name ?? '' }}
                    </span>
                    <img class="img-profile rounded-circle" alt="profile icon"
                        src="{{ asset('template/img/undraw_profile.svg') }}">
                </div>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Tizimdan chiqish
                </a>
            </div>
        </li>
    </ul>

</nav>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
    aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">O'qib ko'ring</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Siz Rostandanham Tizimdan chiqmoqchisizmi?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Orqaga</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Chiqsh</button>
                </form>
            </div>
        </div>
    </div>
</div>
