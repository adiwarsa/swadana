<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="vendor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add Vendor" Pages="Data Master"></x-navbars.navs.auth>
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
                Form Add Vendor
                <form action="{{ route('vendor-add') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group input-group-outline mt-3">
                        <label class="form-label">Vendor Name</label>
                        <input type="text" class="form-control border border-2 p-2" name="name">
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>

    </main>
   

</x-layout>
