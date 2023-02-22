
<div class="table-responsive">
    <table class="table table-bordered customTable">
        <tr>
            <td class="fontBold">Nama Motor</td>
            <td>{{ $data->nama_motor }}</td>
        </tr>
        <tr>
            <td class="fontBold">Nama Vendor</td>
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
            <td class="fontBold">Harga Sewa</td>
            <td>Rp. {{ number_format($data->harga_sewa, 0, '', '.') }}</td>
        </tr>
        <tr>
            <td class="fontBold">Harga Denda</td>
            <td>Rp. {{ number_format($data->harga_sewa, 0, '', '.') }}</td>
        </tr>
        <tr>
            <td class="fontBold">Samsat</td>
            <td>{{ date('d-m-Y', strtotime($data->samsat)) }}</td>
        </tr>
        <tr>
            <td class="fontBold">Bahan Bakar</td>
            <td>{{ $data->bahan_bakar }}</td>
        </tr>
        <tr>
            <td class="fontBold">Transmisi</td>
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
            <td class="fontBold" style="vertical-align: middle;">Gambar</td>
            <td>
                <img src="{{ asset('storage/gambar/'.$data->gambar) }}" alt="" width="250px">   
            </td>
        </tr>
    </table>
</div>
