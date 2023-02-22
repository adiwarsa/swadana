
<div class="table-responsive">
    <table class="table table-bordered customTable">
        <tr>
            <td colspan="3" class="fontBold centered">Customer</td>
        </tr>
        <tr>
            <td class="fontBold centered">Nama</td>
            <td class="fontBold centered">Phone</td>
            <td class="fontBold centered">Email</td>
        </tr>
            <tr>
                <td>{{ $data->user->username }}</td>
                <td class="centered">{{ $data->user->phone }}</td>
                <td>{{ $data->user->email }}</td>
            </tr> 
        <tr>
            <td colspan="3" class="fontBold centered">Rent Detail</td>
        </tr>
            <tr>
            <td class="fontBold">Car Name</td>
            <td colspan="2">{{ $data->car->nama_mobil }}</td>
        </tr>
        <tr>
            <td class="fontBold">Rent Date</td>
            <td colspan="2"> 
                {{ $data->rent_date }}
            </td>
        </tr>
        <tr>
            <td class="fontBold">Delivery to</td>
            <td colspan="2"> 
                {{ $data->delivery }}
            </td>
        </tr>
        <tr>
            <td class="fontBold">Return Date</td>
            <td colspan="2">
            @if ($data->return_date != '')
                    {{ $data->return_date }}
                @else
                        -
                @endif
            </td>
        </tr>
        <tr>
            <td class="fontBold">Returned at</td>
            <td colspan="2"> 
                @if ($data->status != '0')
                    @if ($data->actual_return_date != '')
                        {{ $data->return_at }}    
                    @else
                        Car still on rent
                    @endif
                @else
                Car didnt rent yet.
                @endif
            </td>
        </tr>
        <tr>
            <td class="fontBold">Actual Return Date</td>
            <td colspan="2">@if ($data->actual_return_date != '')
                    {{ $data->actual_return_date }}
                @else
                        -
                @endif
            </td>
        </tr>
        <tr>
            <td class="fontBold">Pay</td>
            <td colspan="2"> Rp {{ number_format($data->pay, 0, ',', '.')  }}</td>
        </tr>
        <tr>
            <td class="fontBold">Fine</td>
            <td colspan="2">Rp {{ number_format($data->fine, 0, ',', '.') }}</td> 
        </tr>
        <tr>
            <td class="fontBold">Rent Status</td>
            <td colspan="2">
            @if ($data->status == '1')
                <a class="badge badge-sm bg-gradient-success">Active</a>
            @else
            <a class="badge badge-sm bg-gradient-danger">Pending</a>
            @endif
            </td>
        </tr>
        <tr>
            <td class="fontBold">Car Status</td>
            <td colspan="2">
            @if ($data->status == '1')
                @if ($data->actual_return_date == '')
                    <a class="badge badge-sm bg-gradient-danger">Rent</a>
                @else
                <a class="badge badge-sm bg-gradient-success">Returned</a>
                @endif</td> 
            @else
                -
            @endif
        </tr>
    </table>
</div>
