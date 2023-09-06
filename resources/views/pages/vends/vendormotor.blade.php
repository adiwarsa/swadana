<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="Vendor Motor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Vendor Motor" Pages="Vehicle"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Vendor table</h6>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                {{-- <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="#addnew" data-bs-target="#addnew" href="javascript:;"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Vendor</a> --}}
                                    <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="vendormotor_add" data-bs-target="#addnew" href="javascript:void(0)"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Vendor</a>
                            </div>
                        </div>
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible text-white">
                            <span class="text-sm">Data already exists!</span>
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
                                                Vendor Name</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendor as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->name }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="javascript:void(0)" class="btn-edit badge badge-sm bg-gradient-success" data-attr="{{ route('vendor-edit', $item->slug) }}">Edit</a>
                                                <form class="delform" method="POST" action="{{ route('vendor-delete', $item->slug) }}">
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

    {{-- Add Modal --}}
  <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form name="vendormotor_add" id="vendormotor_add" class="form-horizontal" action="{{route('vendormotor-add')}}" method="POST" enctype="multipart/form-data">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Vendor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 class="col-lg-6">Vendor</h4>
            <div class="input-group input-group-outline mt-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="name">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  {{-- Edit Modal--}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Vendor</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="edit-form"></div>
            </div>
        </div>
    </div>

  {{-- Edit Modal--}}
  {{-- <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form name="edit" class="form-horizontal" action="{{route('vendor-update', $item->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Vendor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="input-group input-group-outline mt-3">
                <h4 class="col-lg-6">Vendor</h4>
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $item->name }}">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>  --}}

</x-layout>


