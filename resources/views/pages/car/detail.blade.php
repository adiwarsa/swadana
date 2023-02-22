
<div class="table-responsive">
    <table class="table table-bordered customTable">
        <tr>
            <td class="fontBold">Car Name</td>
            <td>{{ $data->nama_mobil }}</td>
        </tr>
        <tr>
            <td class="fontBold">Vendor Name</td>
            <td> 
            {{ $data->vendors->name }}
            </td>
        </tr>
        <tr>
            <td class="fontBold" style="vertical-align: middle;" >Categories</td>
            <td>
            @foreach ($data->categories as $category)
                {{ strtoupper($category->name) }}<br>
            @endforeach
            </td>
        </tr>
        <tr>
            <td class="fontBold">Rental Price</td>
            <td>Rp. {{ number_format($data->harga_sewa, 0, '', '.') }}</td>
        </tr>
        <tr>
            <td class="fontBold">Fine</td>
            <td>Rp. {{ number_format($data->harga_sewa, 0, '', '.') }}</td>
        </tr>
        <tr>
            <td class="fontBold">Samsat</td>
            <td>{{ date('d-m-Y', strtotime($data->samsat)) }}</td>
        </tr>
        <tr>
            <td class="fontBold">Fuel</td>
            <td>{{ $data->bahan_bakar }}</td>
        </tr>
        <tr>
            <td class="fontBold">Seat</td>
            <td>{{ $data->jumlah_kursi }}</td>
        </tr>
        <tr>
            <td class="fontBold">Transmission</td>
                @if($data->transmisi != 'otomatis')
                <td>Manual</td>
                @else
                <td>Automatic</td>
                @endif
        </tr>
        <tr>
            <td class="fontBold">Status</td>
                @if($data->status != 'tersedia')
                <td>Not Available</td>
                @else
                <td>Available</td>
                @endif
        </tr>
        <tr>
            <td class="fontBold" style="vertical-align: middle;">Picture</td>
            <td>
                <img src="{{ asset('storage/gambar/'.$data->gambar) }}" alt="" width="250px">   
            </td>
        </tr>
    </table>
</div>
