<link rel="stylesheet" href="{{ asset('landingpage/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('landingpage/assets/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('landingpage/favicon.svg') }}" type="image/svg+xml">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="monitoringmotor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Monitoring Motorcycle" Pages="Monitoring"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Monitoring Motor Rent</h6>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                {{-- <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="#addnew" data-bs-target="#addnew" href="javascript:;"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Vendor</a> --}}
                                    <!-- <a class="btn bg-gradient-dark mb-0" data-bs-target="#addnew" href="{{ route('rentcar-create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Rent</a> -->
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible text-white">
                            <span class="text-sm">Data sudah ada!</span>
                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        @endif
                        @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif
                        <section class="section featured-car" id="featured-car">
                            <div class="container">
                                <ul class="featured-car-list">
                                    @foreach ($motor as $item)
                                        <li>
                                            <div class="featured-car-card">

                                                <figure class="card-banner">

                                                    <img src="{{ asset('storage/gambar/' . $item->motor->gambar) }}" loading="lazy" width="440"
                                                        height="300" class="w-100">
                                                </figure>
                                                <div class="card-content">
                                                    <div class="card-title-wrapper">
                                                        <h3 class="h3 card-title">
                                                            <a href="#">{{ $item->motor->nama_motor }}</a>
                                                        </h3>
                                                        @if($item->daysfine == '')
                                                        <p class="year">Late : - </p>
                                                        @else
                                                        <p class="year">Late : {{ $item->daysfine }} days</p>
                                                        @endif
                                                    </div>

                                                    <ul class="card-list">

                                                        <li class="card-list-item">
                                                            <span class="card-item-text">Rent Date: {{ $item->rent_date }}</span>
                                                        </li>

                                                        <li class="card-list-item">
                                                            <span class="card-item-text">Return Date: {{ $item->return_date }}</span>
                                                        </li>

                                                        <li class="card-list-item">
                                                            <span class="card-item-text">Fine : Rp.{{ number_format($item->denda) }}</span>
                                                        </li>

                                                        <li class="card-list-item">
                                                            @foreach ($item->motor->categories as $category)
                                                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                                                <span class="card-item-text">{{ ucfirst($category->name) }}</span>
                                                            @endforeach
                                                        </li>

                                                        <li class="card-list-item">
                                                            <span class="card-item-text">Plat : {{ $item->motor->plat }}</span>
                                                        </li>

                                                    </ul>

                                                    <div class="card-price-wrapper">

                                                        <p class="card-price">
                                                            <strong>{{ ucfirst($item->user->username) }}</strong> / {{ $item->user->phone }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-layout>
