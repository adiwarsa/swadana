<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <style>
        .select2-container--default .select2-selection--single{
            border: 1px solid #dee2e6 !important;
            border-width: 2px !important;
        }
    </style>
    <x-navbars.sidebar activePage="rentcar"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Rent" Pages="Rent Logs"></x-navbars.navs.auth>
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
                    Form Rent Mobil
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="user">Customer</label>
                            <select name="user_id" id="user" class="form-control border border-2 p-2 boxselect">
                                <option value="">Select Customer</option>
                                @foreach ($users as $item)
                                    <option value="{{$item->id}}">{{$item->username}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="car">Car</label>
                            <select name="car_id" id="car" class="form-control border border-2 p-2 boxselect">
                                <option value="">Select Car</option>
                                @foreach ($cars as $item)
                                    <option value="{{$item->id}}">{{$item->nama_mobil}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        {{-- <div class="form-group">
                            <label>Rent Date</label>
                            <input required type="date" class="form-control border border-2 p-2" id="rent_date" name="rent_date">
                            <input required type="date" class="form-control border border-2 p-2" id="return_date" name="return_date">
                        </div> --}}
                        <div class="row mt-2">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Rent Date</label>
                                <input required type="date" class="form-control border border-2 p-2" id="rent_date" name="rent_date">
                            </div>
                            
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Until</label>
                                <input type="date" class="form-control border border-2 p-2" id="return_date" name="return_date">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="delivery">Delivery</label>
                            <input type="text" class="form-control border border-2 p-2" id="delivery" name="delivery">
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

    </main>
    {{-- Select 2 --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.boxselect').select2();
        });
        </script>

</x-layout>
