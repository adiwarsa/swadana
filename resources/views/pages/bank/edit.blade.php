{{-- <x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="bank"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Bank" Pages="Data Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible text-white">
                <span class="text-sm">Data sudah ada!</span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card-body w-50">
                Form Edit Bank --}}
                <form action="/bank-update/{{ $bank->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="input-group input-group-outline mt-3 focused is-focused">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control border border-2 p-2" value="{{ $bank->nama }}" name="nama">
                    </div>
                    <div class="input-group input-group-outline mt-3 focused is-focused">
                        <label class="form-label">Bank Name</label>
                        <input type="text" class="form-control border border-2 p-2" value="{{ $bank->bank }}" name="bank">
                    </div>
                    <div class="input-group input-group-outline mt-3 focused is-focused">
                        <label class="form-label">No Rekening</label>
                        <input type="number" class="form-control border border-2 p-2" value="{{ $bank->no_rek }}" name="no_rek">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success" type="submit">Update</button>
                    </div>
                </form>
            {{-- </div>

    </main>
   

</x-layout> --}}
