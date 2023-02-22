<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User" Pages="User"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">User table</h6>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                {{-- <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="#addnew" data-bs-target="#addnew" href="javascript:;"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Vendor</a> --}}
                                    <a class="btn bg-gradient-dark mb-0" data-bs-target="#addnew" href="{{ route('user-create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    User</a>
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
                                                Photo</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Phone</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Address</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Role</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if ($item->gambar!='')
                                                        <img src="{{ asset('storage/profile/'.$item->gambar) }}" 
                                                        class="avatar avatar-sm me-3" alt="">
                                                        @else
                                                        <img src="{{ 'assets' }}/img/team-3.jpg" 
                                                        class="avatar avatar-sm me-3" alt="">
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->username  }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->email }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->phone }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->address }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->roles->name}}</p>
                                            </td>
                                            <td> @if($item->status == 'active')
                                                <form action="{{  route('user-updatestatus',['id'=>$item->id,'status'=>'inactive'])}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <input type="text" name="id" value="{{ $item->id }}" hidden>
                                                    <button type="submit" class="btn badge badge-sm bg-gradient-success"  value="inactive" type="submit">Active</button>
                                                </form>
                                            @else
                                                <form action="{{  route('user-updatestatus',['id'=>$item->id,'status'=>'active'])}}" method="POST">
                                                    @csrf
                                                    @method('put')
                                                    <input type="text" name="id" value="{{ $item->id }}" hidden>
                                                    <button type="submit" class="btn badge badge-sm bg-gradient-danger"  value="active" type="submit">Inactive</button>
                                                </form>
                                            @endif
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="javascript:void(0)" class="badge badge-sm bg-gradient-info" title="Klik Untuk Melihat Detail Data"
                                                onclick="modalDetail('{{ route('user-detail', $item->id) }}', 'User Detail', 'modal-dialog-scrollable modal-md')">Info</a>
                                                <a href="javascript:void(0)" class="btn-edit badge badge-sm bg-gradient-success" data-attr="{{ route('user-edit', $item->id) }}">Edit</a>
                                                <form class="delform" method="POST" action="{{ route('user-delete', $item->id) }}">
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
  
{{-- Edit Modal--}}
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="edit-form"></div>
        </div>
    </div>
</div>

</x-layout>


