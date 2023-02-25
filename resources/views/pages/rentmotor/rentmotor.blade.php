<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <style>
        .card .card-body{
            padding: 0 !important;
        }
        .card-body{
            padding: 0 !important;
        }
    </style>
    <x-navbars.sidebar activePage="rentmotor"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Rent Motorcycle" Pages="Rent Logs"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Rent table</h6>
                            </div>
                            <div class=" me-3 my-3 text-end">
                                {{-- <a class="btn bg-gradient-dark mb-0" data-bs-toggle="modal" id="#addnew" data-bs-target="#addnew" href="javascript:;"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Vendor</a> --}}
                                    <a class="btn bg-gradient-dark mb-0" data-bs-target="#addnew" href="{{ route('rentmotor-create') }}"><i
                                        class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                    Rent</a>
                            </div>
                        <form action="" class="form-control" method="get">
                        <div class="row mt-2">
                            <div class="mb-2 col-md-4">
                                <label for="start_date">Start</label>
                                <input type="date" class="form-control border border-2 p-2" id="start_date" name="start_date">
                
                            </div>
                                <div class="mb-2 col-md-4">
                                <label for="end_date">End</label>
                                <input type="date" class="form-control border border-2 p-2" id="end_date" name="end_date">
                            </div>
                        <div class="row mt-2">
                        <div class="mb-3 col-md-4">
                            <button class="btn btn-primary" type="submit" id="filterBtn">Filter</button>
                        </div>
                        </div>
                        </form>
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible text-white">
                            <span class="text-sm">Data sudah ada!</span>
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
                                <table class="table align-items-center mb-0" id="tablemotor">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                No Invoice</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Name Customer</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Phone </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Motor</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Rent Date</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Return Date</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Actual Return Date</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Pay</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Fine</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rent_logs as $item)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->no_invoice }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->user->username }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->user->phone }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->motor->nama_motor }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->rent_date }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $item->return_date }}</p>
                                            </td>
                                            <td>
                                                @if (empty($item->actual_return_date) && $item->status == 1)
                                                    <a href="javascript:void(0)" class="btn-return badge badge-sm bg-gradient-success" data-attr="{{ route('rentmotor-return', $item->id) }}">Return</a>
                                                @else
                                                    <p class="text-xs font-weight-bold mb-0">{{ $item->actual_return_date }}</p>
                                                @endif

                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($item->pay, 0, ',', '.')  }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">Rp {{ number_format($item->fine, 0, ',', '.') }}</p>
                                            </td>
                                            <td>
                                            @if($item->actual_return_date == '')
                                                @if($item->status == 1)
                                                    <form action="{{  route('rent-updatestatus',['id'=>$item->id,'status'=>0])}}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="id" value="{{ $item->id }}" hidden>
                                                        <button type="submit" class="btn badge badge-sm bg-gradient-success"  value="0" type="submit">Active</button>
                                                    </form>
                                                @else
                                                    <form action="{{  route('rent-updatestatus',['id'=>$item->id,'status'=>1])}}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <input type="text" name="id" value="{{ $item->id }}" hidden>
                                                        <button type="submit" class="btn badge badge-sm bg-gradient-danger"  value="1" type="submit">Pending</button>
                                                    </form>
                                                @endif
                                            @else
                                            <button class="btn badge badge-sm bg-gradient-success">Motor Returned</button>
                                            @endif
                                                {{-- <p class="text-xs font-weight-bold mb-0">{{ $item->status }}</p> --}}
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                            <a class="badge badge-sm bg-gradient-info" onclick="printInvoice({{ $item->id }})">Invoice</a>
                                            <a href="javascript:void(0)" class="badge badge-sm bg-gradient-info" title="Klik Untuk Melihat Detail Data"
                                                onclick="modalDetail('{{ route('rentmotor-detail', $item->id) }}', 'Rent Detail', 'modal-dialog-scrollable modal-md')">Info</a>
                                                <a href="javascript:void(0)" class="btn-edit badge badge-sm bg-gradient-success" data-attr="{{ route('rentmotor-return-edit', $item->id) }}">Edit</a>
                                                <form class="delform" method="POST" action="{{ route('rent-delete', $item->id) }}">
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Rent Motor</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="edit-form"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModalr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center">
                    <h5 class="modal-title" id="exampleModalLabel">Return Motor</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                </div>
                <div class="edit-return"></div>
            </div>
        </div>
    </div>

</x-layout>
<script>
// select the start date and end date input fields
const startDateInput = document.querySelector('#start_date');
const endDateInput = document.querySelector('#end_date');

// disable the end date input field initially
endDateInput.disabled = true;

// listen for changes in the start date input field
startDateInput.addEventListener('input', function() {
  // enable the end date input field if the start date is filled
  if (startDateInput.value !== '') {
    endDateInput.disabled = false;
  } else {
    endDateInput.disabled = true;
  }
});

// get the URL parameters
const urlParams = new URLSearchParams(window.location.search);

// extract the start_date and end_date parameters
const startDate = urlParams.get('start_date');
const endDate = urlParams.get('end_date');

// construct the title with the date range
let title = `Swadana Bali <br> Rent Motor Transaction <br>`;

if (startDate && endDate) {
  title = `Swadana Bali <br> Rent Motor Transaction <br> (${startDate} - ${endDate}) <hr>`;
} else if (startDate) {
  title = `Swadana Bali <br> Rent Motor Transaction <br> (${startDate}) <hr>`;
}

// update the print button configuration with the new title
$(document).ready(function() {
  $('#tablemotor').DataTable({
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    drawCallback: function() {
      const pageLength = this.fnSettings()._iDisplayLength;
      const showHideText = pageLength === -1 ? "Hide" : "Show";
      $(".show-hide").text(`${showHideText} ${pageLength}`);
    },
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'print',
        text: 'Print',
        customize: function (win) {
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
            .css('display', 'none');
          // Add header title
          $(win.document.body)
            .prepend('<div style="text-align: center;">'+
                      '<img src="{{ asset('assets') }}/img/logos/b.png" height="80px" style="position: absolute; top: 50px; left: 50px;">'+
                      '<h1 style="text-align:center;margin-top: 70px;">Swadana Bali</h1>'+
                      '<div style="margin-top: 10px; text-align: center;">'+
                        '<p>Jl. Cempaka, Mas, Ubud, Gianyar, Bali<br>'+
                        'Telp. +62 81 238 626 20 | Email: info@swadanabalirentcar.com</p>'+
                        '<h4>'+ (startDate && endDate ? 'Rent Motorcycle Transaction <br> (' + startDate + ' - ' + endDate + ')' : (startDate ? 'Rent Motorcycle Transaction <br> (' + startDate + ')' : 'Rent Motorcycle Transaction')) + '<h4>'+
                      '</div>'+
                    '</div>');
        }
      },
      {
        extend: 'pageLength',
        text: 'Show',
        titleAttr: 'Show/Hide Rows',
        className: 'show-hide'
      }
    ]
  });
});

        //Invoice Rent Print
    function printInvoice(id) {
    window.location.href = '/rent/' + id + '/print';
}

</script>