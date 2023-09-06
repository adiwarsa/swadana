{{-- <x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit User" Pages="User"></x-navbars.navs.auth>
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
                    Form Edit User
                </div>
                <div class="card-body"> --}}
                    <form action="/user-update/{{ $user->id }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_mobil">Username</label>
                            <input type="text" name="username" class="form-control border border-2 p-2" value="{{ $user->username }}">
                        </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control border border-2 p-2" value="{{ $user->email }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control border border-2 p-2" value="">
                            <i class="material-icons opacity-10 ps-2 pe-2 psw toggle-password" id="#password-field" style="float: right; margin-top:-30px; margin-right: 10px; cursor: pointer;">visibility</i>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="phone">Phone</label>
                            <input type="number" id="phone" onchange="valueMinus(this.value, 'phone')" name="phone" class="form-control border border-2 p-2" value="{{ $user->phone }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control border border-2 p-2" value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="role_id">Role</label>
                            <select name="role_id" id="role_id" class="form-control border border-2 p-2">
                                @foreach ($role as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $user->role_id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control border border-2 p-2">
                                <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control border border-2 p-2" name="image">
                            <label for="currentImage" style="display: block">Current Image</label>
                            @if ($user->gambar!='')
                                <img src="{{ asset('storage/profile/'.$user->gambar) }}" alt="" width="300px">   
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mt-2">Save</button>
                        </div>
                    </form>
                {{-- </div>
            </div>

    </main>
</x-layout> --}}
