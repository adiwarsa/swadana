<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="Car Table"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Car" Pages="Vehicle"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Car table</h6>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                {{-- <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="#addnew" data-bs-target="#addnew" href="javascript:;"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Vendor</a> --}}
                                    <a class="btn bg-gradient-dark mb-0" data-bs-target="#addnew" href="{{ route('car-create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Car</a>
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
                        @include('sweetalert::alert')
                        <!-- @if (session('status'))
                        <div class="row">
                            <div class="alert alert-success alert-dismissible text-white" role="alert">
                                <span class="text-sm">{{ Session::get('status') }}</span>
                                <button type="button" class="btn-close text-lg py-3 opacity-10"
                                    data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        @endif -->
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="table">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Car Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Plat</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Vendor Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Categories</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Rental Price</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Fine</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Samsat</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Fuel</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Seat</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Transmission</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($car as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->nama_mobil }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->plat }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->vendors->name }}</p>
                                            </td>
                                            <td>
                                                @foreach ($item->categories as $category)
                                                    <p class="text-xs font-weight-bold mb-0">{{ $category->name }}<br></p>    
                                                @endforeach
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item->harga_sewa, 0, '', '.') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Rp. {{ number_format($item->denda, 0, '', '.') }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->samsat }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->bahan_bakar }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->jumlah_kursi }}</p>
                                            </td>
                                            <td>
                                                @if($item->transmisi != 'otomatis')
                                                <p class="text-xs font-weight-bold mb-0">Manual</p>
                                                @else
                                                <p class="text-xs font-weight-bold mb-0">Automatic</p>
                                                @endif   
                                            </td>
                                            <td>
                                                @if($item->status != 'tersedia')
                                                <p class="text-xs font-weight-bold mb-0">Not Available</p>
                                                @else
                                                <p class="text-xs font-weight-bold mb-0">Available</p>
                                                @endif  
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                            <a href="javascript:void(0)" class="badge badge-sm bg-gradient-info" title="Klik Untuk Melihat Detail Data"
                                            onclick="modalDetail('{{ route('car-detail', $item->id) }}', 'Car Detail', 'modal-dialog-scrollable modal-md')">Info</a>
                                                <a href="car-edit/{{$item->slug}}" class="badge badge-sm bg-gradient-success">Edit</a>
                                                <form class="delform" method="POST" action="{{ route('car-delete', $item->slug) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a type="submit" class="badge badge-sm bg-gradient-secondary"
                                                        onclick="event.preventDefault(); confirmDelete(this);">
                                                        Delete
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
