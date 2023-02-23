<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <style>
        .select2-container--default .select2-selection--multiple{
            padding-right: 8px !important;
            padding-bottom: 8px !important;
            padding-top: 8px !important;
            border: 1px solid #dee2e6 !important;
            border-width: 2px !important;
        }
    </style>
    <x-navbars.sidebar activePage="Edit Car"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Car" Pages="Vehicle"></x-navbars.navs.auth>
        <!-- End Navbar -->
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible text-white">
                <span class="text-sm">Data sudah ada!</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Form Edit Mobil
                </div>
                <div class="card-body">
                    <form action="/car-edit/{{ $car->slug }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row mt-3">
                        <div class="mb-3 col-md-4">
                            <label for="nama_mobil">Name Car</label>
                            <input type="text" name="nama_mobil" class="form-control border border-2 p-2" value="{{ $car->nama_mobil }}">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="nama_mobil">Plat</label>
                            <input type="text" name="plat" class="form-control border border-2 p-2" value="{{ $car->plat }}">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="vendor_id">Vendor</label>
                            <select name="vendor_id" id="vendor_id" class="form-control border border-2 p-2">
                                @foreach ($vendor as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $car->vendor_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="harga_sewa">Price Rent</label>
                            <input type="number" name="harga_sewa" class="form-control border border-2 p-2" value="{{ $car->harga_sewa }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="denda">Fine</label>
                            <input type="number" name="denda" class="form-control border border-2 p-2" value="{{ $car->denda }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label>Samsat Date</label>
                            <input required type="date" class="form-control border border-2 p-2" id="samsat" name="samsat" value="{{ $car->samsat }}">
                          </div>
                        <div class="mb-3 col-md-6">
                            <label for="bahan_bakar">Fuel</label>
                            <input type="text" name="bahan_bakar" class="form-control border border-2 p-2" value="{{ $car->bahan_bakar }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="jumlah_kursi">Seat</label>
                            <input type="number" name="jumlah_kursi" class="form-control border border-2 p-2" value="{{ $car->jumlah_kursi }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="transmisi">Transmision</label>
                            <select name="transmisi" id="transmisi" class="form-control border border-2 p-2">
                                <option value="manual" {{ $car->transmisi == 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="otomatis" {{ $car->transmisi == 'otomatis' ? 'selected' : '' }}>Otomatis</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control border border-2 p-2">
                                <option value="tersedia" {{ $car->transmisi == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="tidak tersedia" {{ $car->transmisi == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="category">Category</label>
                            <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <label for="currentCategory">Current Category</label>
                            <ul>
                                @foreach ($car->categories as $category)
                                    <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="deskripsi">Description</label>
                            <textarea name="deskripsi" class="form-control border border-2 p-2" id="deskripsi" cols="30" rows="5">{{ $car->deskripsi }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control border border-2 p-2" name="image">
                        <label for="currentImage" style="display: block">Current Image</label>
                        @if ($car->gambar!='')
                            <img src="{{ asset('storage/gambar/'.$car->gambar) }}" alt="" width="300px">   
                        @endif
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

    </main>
    <!--Select 2-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
        </script>

</x-layout>
