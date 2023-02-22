@props(['activePage'])
<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href=" {{ route('dashboard') }} ">
            <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-2 font-weight-bold text-white">{{ ucfirst(Auth::user()->roles->name)}} Rent</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    @if (Auth::user()->role_id == '1')
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Dashboard</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">User</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-management' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('user-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;" class="fas fa-lg fa-list-ul ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Management</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Vehicle</h6>
            </li>
        
            <li class="nav-item" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <div class="nav-link text-white {{ $activePage == 'Car Table' || $activePage == 'Edit Car' || $activePage == 'Add Car' || $activePage == 'category' || $activePage == 'vendor' ? ' active bg-gradient-primary' : '' }}" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Car</span>
                    @if ($activePage == 'Edit Car' || $activePage == 'Car Table' || $activePage == 'Add Car' || $activePage == 'category' || $activePage == 'vendor')
                      <span class="nav-link-text ms-1"> > {{ ucfirst($activePage) }}</span>
                    @endif
                </div>
            </li>
                <div class="ms-3 collapse {{ $activePage == 'Car Table' || $activePage == 'category' || $activePage == 'vendor' ? 'show' : '' }}" id="collapseExample">
                    <a class="nav-link text-white {{ $activePage == 'Car Table' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('car-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Car Table</span>
                    </a>

                    <a class="nav-link text-white {{ $activePage == 'category' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('category-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Category</span>
                    </a>
                   
                    <a class="nav-link text-white {{ $activePage == 'vendor' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('vendor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Vendor</span>
                    </a>
                    
                    <!-- <a class="nav-link text-white {{ $activePage == 'bank' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('bank-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Bank</span>
                    </a> -->
                </div>

            <li class="nav-item" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                <div class="nav-link text-white {{ $activePage == 'Motor Table' || $activePage == 'Edit Motor' || $activePage == 'Add Motor' || $activePage == 'Category Motor' || $activePage == 'Vendor Motor' ? ' active bg-gradient-primary' : '' }}" href="#">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Motor</span>
                    @if ($activePage == 'Edit Motor' || $activePage == 'Motor Table' || $activePage == 'Motor Car' || $activePage == 'Category Motor' || $activePage == 'Vendor Motor')
                      <span class="nav-link-text ms-1"> > {{ ucfirst($activePage) }}</span>
                    @endif
                </div>
            </li>
                <div class="ms-3 collapse {{ $activePage == 'Vendor Motor' || $activePage == 'Motor Table' || $activePage == 'Category Motor' ? 'show' : '' }}" id="collapseExample2">
                    <a class="nav-link text-white {{ $activePage == 'Motor Table' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('motor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Motor Table</span>
                    </a>

                    <a class="nav-link text-white {{ $activePage == 'Category Motor' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('categorymotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Category</span>
                    </a>
                   
                    <a class="nav-link text-white {{ $activePage == 'Vendor Motor' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('vendormotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Vendor</span>
                    </a>
                    
                    <!-- <a class="nav-link text-white {{ $activePage == 'bank' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('bank-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Bank</span>
                    </a> -->
                </div>
            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Rent Logs</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rentcar' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('rentcar-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Rent Car</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rentmotor' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('rentmotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Rent Motor</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Samsat</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'samsat' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('samsat-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Samsat Car</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'samsatmotor' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('samsatmotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Samsat Motor</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Monitoring</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'monitoringcar' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('monitoringcar-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10 ps-2 pe-2">directions_car</i>
                    </div>
                    <span class="nav-link-text ms-1">Monitoring Car</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'monitoringmotor' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('monitoringmotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">motorcycle</i>
                    </div>
                    <span class="nav-link-text ms-1">Monitoring Motor</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">More</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'bank' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('bank-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">account_balance_wallet</i>
                    </div>
                    <span class="nav-link-text ms-1">Bank</span>
                </a>
            </li>
                @else
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Dashboard</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">User</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'user-profile' ? 'active bg-gradient-primary' : '' }} "
                    href="{{ route('user-profile') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1.2rem;" class="fas fa-user-circle ps-2 pe-2 text-center"></i>
                    </div>
                    <span class="nav-link-text ms-1">User Profile</span>
                </a>
                <div class="ms-3 collapse {{ $activePage == 'Vendor Motor' || $activePage == 'Motor Table' || $activePage == 'Category Motor' ? 'show' : '' }}" id="collapseExample2">
                    <a class="nav-link text-white {{ $activePage == 'Motor Table' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('motor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Motor Table</span>
                    </a>

                    <a class="nav-link text-white {{ $activePage == 'Category Motor' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('categorymotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Category</span>
                    </a>
                   
                    <a class="nav-link text-white {{ $activePage == 'Vendor Motor' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('vendormotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Vendor</span>
                    </a>
                    
                    <!-- <a class="nav-link text-white {{ $activePage == 'bank' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('bank-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">table_view</i>
                    </div>
                    <span class="nav-link-text ms-1">Bank</span>
                    </a> -->
                </div>
            
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Rent Logs</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rentcar' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('rentcar-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Rent Car</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'rentmotor' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('rentmotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Rent Motor</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Samsat</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'samsat' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('samsat-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Samsat Car</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'samsatmotor' ? ' active bg-gradient-primary' : '' }}  "
                    href="{{ route('samsatmotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">receipt_long</i>
                    </div>
                    <span class="nav-link-text ms-1">Samsat Motor</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder opacity-8">Monitoring</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'monitoringcar' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('monitoringcar-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="material-icons opacity-10 ps-2 pe-2">directions_car</i>
                    </div>
                    <span class="nav-link-text ms-1">Monitoring Car</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'monitoringmotor' ? ' active bg-gradient-primary' : '' }} "
                    href="{{ route('monitoringmotor-index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10 ps-2 pe-2">motorcycle</i>
                    </div>
                    <span class="nav-link-text ms-1">Monitoring Motor</span>
                </a>
            </li>
                @endif
        </ul>
    </div>
</aside>
