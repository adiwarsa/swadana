<x-landingpage bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.navs.navbar></x-navbars.navs.navbar>
    <style>
        a{
        text-decoration: none !important;
      }
    </style>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Rent Logs Motorcycle</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <a href="{{ route('cus-dashboard') }}" class="btn btn-primary mb-2">Car</a>
            <div class="row justify-content-center">
                <div class="table-responsive p-0">
                    <table class="table align-items-center">
                        <thead>
                            <tr>
                                <th
                                    class="text-uppercase text-center">
                                    No</th>
                                <th
                                    class="text-uppercase text-center">
                                    No Invoice</th>
                                <th
                                    class="text-uppercase text-center">
                                    Motor</th>
                                <th
                                    class="text-uppercase text-center">
                                    Rent Date</th>
                                <th
                                    class="text-uppercase text-center">
                                    Return Date</th>
                                <th
                                    class="text-uppercase text-center">
                                    Actual Return Date</th>
                                <th
                                    class="text-uppercase text-center">
                                    Status</th>
                                <th
                                    class="text-uppercase text-center">
                                    Pay</th>
                                <th
                                    class="text-uppercase text-center">
                                    Fine</th>
                                <th
                                    class="text-center text-uppercase">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                            <tr>
                                <td>
                                    <p class="text-xs font-weight-bold text-center">{{ $loop->iteration }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center">{{ $item->no_invoice }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center">{{ $item->motor->nama_motor }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center">{{ $item->rent_date }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center">{{ $item->return_date }}</p>
                                </td>
                                <td>
                                    @if (empty($item->actual_return_date))
                                        <p class="text-xs font-weight-bold text-center"> - </p>
                                    @else
                                        <p class="text-xs font-weight-bold text-center">{{ $item->actual_return_date }}</p>
                                    @endif

                                </td>
                                <td>
                                @if (empty($item->actual_return_date))
                                    @if($item->status == 1)
                                    <p class="text-xs font-weight-bold text-center">Active</p>
                                    @else
                                    <p class="text-xs font-weight-bold text-center">Pending</p>
                                    @endif
                                @else
                                <p class="text-xs font-weight-bold text-center">Returned</p>
                                @endif  
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center">Rp {{ number_format($item->pay, 0, ',', '.')  }}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold text-center">Rp {{ number_format($item->fine, 0, ',', '.') }}</p>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    @if($item->status != 0)
                                    <a style="cursor: pointer; text-decoration: none;" class="badge badge-sm bg-gradient-info" onclick="printInvoice({{ $item->id }})">Invoice</a>
                                    @else
                                    <p>-</p>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
  
</x-landingpage>
<script>
    //Invoice Rent Print
    function printInvoice(id) {
    window.open('/cart/' + id + '/print', '_blank');
}
</script>




