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
    <x-navbars.sidebar activePage="Add Car"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Car" Pages="Vehicle"></x-navbars.navs.auth>
        <!-- End Navbar -->
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible text-white">
                <span class="text-sm">Data already exists!</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-header">
                    Form Add Car
                </div>
                <div class="card-body">
                    <form action="{{ route('car-add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="row mt-3">
                        <div class="mb-3 col-md-4">
                            <label for="nama_mobil">Name Car</label>
                            <input type="text" name="nama_mobil" class="form-control border border-2 p-2" value="{{ old('nama_mobil') }}" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="nama_mobil">Plat</label>
                            <input type="text" name="plat" class="form-control border border-2 p-2" value="{{ old('plat') }}" required autocomplete="off">
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="vendor_id">Vendor</label>
                            <select name="vendor_id" id="vendor_id" class="form-control border border-2 p-2">
                                @foreach ($vendor as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="harga_sewa">Price Rent</label>
                            <input type="number" id="rupiah" name="harga_sewa" onchange="valueMinus(this.value, 'rupiah')" class="form-control border border-2 p-2" value="{{ old('harga_sewa') }}" required>
                            <label for="rupiah">*</label>
                        </div>
                        <div class="col-md-6">
                            <label for="denda">Fine</label>
                            <input type="number" id="rupiahdenda" name="denda" onchange="valueMinus(this.value, 'rupiahdenda')" class="form-control border border-2 p-2" value="{{ old('denda') }}" required>
                            <label for="rupiahdenda">*</label>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label>Samsat Date</label>
                            <input required type="date" class="form-control border border-2 p-2" id="samsat" name="samsat">
                          </div>
                        <div class="mb-3 col-md-6">
                            <label for="bahan_bakar">Fuel</label>
                            <input type="text" name="bahan_bakar" class="form-control border border-2 p-2" value="{{ old('bahan_bakar') }}" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="jumlah_kursi">Seat</label>
                            <input type="number" id="jumlah_kursi" onchange="valueMinus(this.value, 'jumlah_kursi')" name="jumlah_kursi" class="form-control border border-2 p-2" value="{{ old('jumlah_kursi') }}" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="transmisi">Transmision</label>
                            <select name="transmisi" id="transmisi" class="form-control border border-2 p-2">
                                <option value="manual">Manual</option>
                                <option value="otomatis">Otomatis</option>
                            </select>
                        </div>
                    <div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control border border-2 p-2">
                                <option value="tersedia">Tersedia</option>
                                <option value="tidak tersedia">Tidak Tersedia</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="category">Category</label>
                            <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="deskripsi">Description</label>
                            <textarea name="deskripsi" class="form-control border border-2 p-2" id="deskripsi" cols="30" rows="5">{{ old('deskripsi') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control border border-2 p-2" name="image" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
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
        
        //Label Price Rupiah
        var rupiahInput = document.querySelector('#rupiah');
        var rupiahLabel = document.querySelector('label[for="rupiah"]');

        rupiahInput.addEventListener('input', function(e) {
        // Format the input value and update the label text content
        rupiahLabel.textContent = '*'+ formatRupiah(this.value, 'Rp. ');
        });

        //Label Denda Rupiah
        var rupiahdendaInput = document.querySelector('#rupiahdenda');
        var rupiahdendaLabel = document.querySelector('label[for="rupiahdenda"]');

        rupiahdendaInput.addEventListener('input', function(e) {
        // Format the input value and update the label text content
        rupiahdendaLabel.textContent = '*'+ formatRupiah(this.value, 'Rp. ');
        });
    </script>

</x-layout>
