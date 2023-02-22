
<div class="table-responsive">
    <table class="table table-bordered customTable">
        <tr>
            <td class="fontBold">Code Samsat</td>
            <td>{{ $data->code_samsat }}</td>
        </tr>
        <tr>
            <td class="fontBold">Nama Mobil</td>
            <td> 
            {{ $data->car->nama_mobil }}
            </td>
        </tr>
            <td class="fontBold">Old Samsat</td>
            <td>{{ date('d-m-Y', strtotime($data->old_samsat)) }}</td>
        </tr>
        </tr>
            <td class="fontBold">New Samsat</td>
            <td> 
                @if($data->new_samsat != '')
                    {{ date('d-m-Y', strtotime($data->new_samsat)) }}
                @else
                    -
                @endif
            </td>
        </tr>
        </tr>
            <td class="fontBold">Renew Samsat</td>
            <td>
                @if($data->new_samsat != '')
                    {{ date('d-m-Y', strtotime($data->renew_samsat)) }}
                @else
                    -
                @endif 
            </td>
        </tr>
    </table>
</div>
