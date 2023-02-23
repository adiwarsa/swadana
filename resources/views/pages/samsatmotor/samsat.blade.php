<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="samsatmotor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Samsat Motorcycle" Pages="Samsat"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Samsat table</h6>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                {{-- <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="#addnew" data-bs-target="#addnew" href="javascript:;"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Vendor</a> --}}
                                    <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="samsatmotor_add" data-bs-target="#addnew" href="javascript:void(0)"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Samsat</a>
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
                                <table class="table align-items-center mb-0" id="tablesamsat">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Code Samsat</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Motor Name</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Old Samsat </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Renew Samsat </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                New Samsat Date </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($samsat as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->code_samsat }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->motor->nama_motor }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->old_samsat }}</p>
                                            </td>
                                            <td>
                                                @if (empty($item->renew_samsat))
                                                <a href="javascript:void(0)" class="btn-edit badge badge-sm bg-gradient-success" data-attr="{{ route('samsatmotor-renew-edit', $item->id) }}">Renew</a>
                                                 @else
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->renew_samsat }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->new_samsat }}</p>
                                            </td>   
                                            <td class="align-middle text-center text-sm">
                                            <a href="javascript:void(0)" class="badge badge-sm bg-gradient-info" title="Klik Untuk Melihat Detail Data"
                                            onclick="modalDetail('{{ route('samsatmotor-detail', $item->id) }}', 'Samsat Detail', 'modal-dialog-scrollable modal-md')">Info</a>
                                                {{-- <a href="javascript:void(0){{ $item->id }}" id="edit" data-bs-toggle="modal-two"
                                                data-bs-target="edit" data-id="{{ $item->id }}" class="badge badge-sm bg-gradient-success">Edit</a> --}}
                                                <!-- <a href="javascript:void(0)" class="btn-edit badge badge-sm bg-gradient-success" data-attr="{{ route('rentcar-return-edit', $item->id) }}">Edit</a> -->
                                                <form class="delform" method="POST" action="{{ route('samsat-delete', $item->id) }}">
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

    //add modal 
    <!-- Add Modal -->
  <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form name="samsat_add" id="samsatmotor_add" class="form-horizontal" action="{{route('samsatmotor-add')}}" method="POST" enctype="multipart/form-data">
            @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Samsat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h4 class="col-lg-6">Samsat Motor</h4>
            <div class="form-group">
                <select name="motor_id" id="motor" class="form-control border border-2 p-2 boxselect">
                    <option value="">Select Motor</option>
                    @foreach ($motor as $item)
                        <option value="{{$item->id}}">{{$item->nama_motor}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

//edit modal
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Renew Samsat</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="edit-form"></div>
            </div>
        </div>
    </div>

</x-layout>
<script>
    $(document).ready(function() {
    $('#tablesamsat').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                title: 'Swadana Bali <br> Samsat Motor <hr>',
                customize: function ( win ) {
                    $(win.document.body)
                        .find('table')
                        .find('th:last-child, td:last-child')
                        .remove();
                    $(win.document.body)
                        .find('table')
                        .after('<div id="print-footer">Gianyar, ' + new Date().toLocaleDateString('id-ID', {day: 'numeric', month: 'long', year: 'numeric'}) + '<br>Owner <hr>Nyoman Suwendra</div>');
                    $(win.document.body)
                        .find('#print-footer')
                        .css({
                            'text-align': 'center',
                            'position': 'absolute',
                            'font-size': '15px',
                            'margin-top': '10px',
                            'margin-left': 'auto',
                            'margin-right': '0',
                            'padding': '10px',
                            'right' : '0'
                    });

                    $(win.document.body)
                        .find('h1')
                        .css('text-align', 'center');
                }
            }
        ]
    } );
} );
</script>
