
<div class="table-responsive">
    <table class="table table-bordered customTable">
        <tr>
            <td class="fontBold">Username</td>
            <td>{{ $data->username }}</td>
        </tr>
        <tr>
            <td class="fontBold">Email</td>
            <td> 
                {{ $data-> email }}
            </td>
        </tr>
        <tr>
            <td class="fontBold">Phone</td>
            <td>
                @if ($data->phone != '')
                    {{ $data->phone }}
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <td class="fontBold">Address</td>
            <td>@if ($data->address != '')
                    {{ $data->address }}
                @else
                        -
                @endif
            </td>
        </tr>
        <tr>
            <td class="fontBold">Role</td>
            <td> {{ $data->roles->name }}</td>
        </tr>
        <tr>
            <td class="fontBold">Status</td>
            <td> @if ($data->status == 'active')
                <a class="badge badge-sm bg-gradient-success">{{ $data->status }}</a>
            @else
            <a class="badge badge-sm bg-gradient-danger">{{ $data->status }}</a>
            @endif</td>
            
        </tr>
        <tr>
            <td class="fontBold" style="vertical-align: middle;">Gambar</td>
            <td>
            @if ($data->gambar != '')
                <img src="{{ asset('storage/profile/'.$data->gambar) }}" alt="" width="250px"> 
            @else
                    -
            @endif
                  
            </td>
        </tr>
    </table>
</div>
