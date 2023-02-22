
@props(['bodyClass'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Swadana Bali
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.css?v=3.0.0" rel="stylesheet" />
    <!-- Bundle Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- CSS Datatables-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
     <!--Select 2 -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="{{ asset('assets') }}/css/dataTables.material.min.css"> -->
    <link rel="stylesheet" href="{{ asset('assets') }}/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <style>

        @media print {
        .dataTables_wrapper table thead tr th {
            text-align: center !important;
            }
        }

        div.dt-buttons{
            padding: 11px !important;
        }
        .dt-button{
            color: #fff !important;
            border-radius: 6px !important;
            background-color: #e91e63 !important;
            padding: 11px;
        }
        
        .modal-header button{
            border: none;
            background: white;
        }
        .fontBold{
            font-weight: bold;
        }
        .centered{
            text-align: center;
        }
        .delform{
            display: inline-block;
        }
    </style>
    
</head>
<body class="{{ $bodyClass }}">
@include('sweetalert::alert')
<div class="modal fade text-left" id="modalDetail" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">

                            </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="material-icons" data-feather="x">close</i>
                            </button>
                        </div>
                        <div class="modal-body" id="modalBodyDetail">

                        </div>
                    </div>
                </div>
            </div>
{{ $slot }}

<script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
<!--Datatables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<!--Select2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


@stack('js')
<script>

    //Delete alert
    function confirmDelete(button) {
    const form = button.parentElement;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
        form.submit(); // submit the form after the confirmation
        }
    });
    }

    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
// Datatable query js
    $(document).ready(function () {
        $('#table').DataTable();
    });


    $(document).ready(function () {
        $('#tablebank').DataTable();
    });
        $('#tablebank').DataTable({
            "bPaginate": false, //hide pagination
            "bFilter": false, //hide Search bar
            "bInfo": false, // hide showing entries
        })


    $(document).on('click', '.btn-edit', function(event) {
  event.preventDefault();
  let href = $(this).attr('data-attr');
  $.ajax({
      url: href,
      success: function(response) {
        $('#editModal').modal("show");
          $('.edit-form').html('');
          $('.edit-form').append(response);
      }
  })
});

//show password
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("psw");
        var input = $("#password");
        if (input.attr("type") === "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }

        });
//modal detail
function modalDetail(href, title, size) {
        $.get(href, {}, function(data, status) {
            $("#modalBodyDetail").html(data);
            var modal = $("#modalDetail").modal('show');
            modal.find('.modal-title').text(title);
            modal.find('.modal-dialog').addClass(size);
        });
    }

    // //filter
    //     $(document).ready(function() {
    //         $('#filterBtn').click(function() {
    //             var start_date = $('#start_date').val();
    //             var end_date = $('#end_date').val();

    //             $.ajax({
    //             type: 'GET',
    //             url: '/rentcar',
    //             data: {
    //                 start_date: start_date,
    //                 end_date: end_date
    //             },
    //             success: function(data) {
    //                 $('#table tbody').empty();
    //             // Loop through the filtered data and build the rows of the table
    //             $.each(data, function(index, rentlog) {
    // // Append a new row to the table for each rent log
    //                 $('#table tbody').append(`
    //                 <tr>
    //                     <td>${rentlog.id}</td>
    //                     <td>${rentlog.user.username}</td>
    //                     <td>${rentlog.user.phone}</td>
    //                     <td>${rentlog.car.nama_mobil}</td>
    //                     <td>${rentlog.rent_date}</td>
    //                     <td>${rentlog.return_date}</td>
    //                     <td>${rentlog.actual_return_date}</td>
    //                     <td>${rentlog.pay}</td>
    //                     <td>${rentlog.fine}</td>
    //                 </tr>
    //                 `);
    //             });
    //                         }
    //         });
    //     });
    //     });

</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>
</body>
</html>
