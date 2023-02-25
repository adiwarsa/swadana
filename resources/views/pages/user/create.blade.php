<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Add User" Pages="User"></x-navbars.navs.auth>
        <!-- End Navbar -->
            <div class="card">
                <div class="card-header">
                    Form Add User
                </div>
                <div class="card-body">
                    <form action="{{ route('user-add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @error('username')
                        <p class='text-danger inputerror'>{{ $message }} </p>
                        @enderror
                        <div class="form-group">
                            <label for="nama_mobil">Username</label>
                            <input type="text" name="username" class="form-control border border-2 p-2" value="{{ old('username') }}">
                        </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control border border-2 p-2" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control border border-2 p-2" value="">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" class="form-control border border-2 p-2" value="">
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address">Address</label>
                            <input type="text" name="address" class="form-control border border-2 p-2" value="">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="mb-3 col-md-6">
                            <label for="role_id">Role</label>
                            <select name="role_id" id="role_id" class="form-control border border-2 p-2">
                                <option value="2">Pegawai</option>
                                <option value="3">Customer</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control border border-2 p-2">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control border border-2 p-2" name="image">
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>

    </main>
</x-layout>
