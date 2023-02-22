<!DOCTYPE html>
<html>
<head>
    <title>we</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <h1>wa</h1>
    <p>wa</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua.</p>
  
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name Customer</th>
            <th>Phone</th>
            <th>Car</th>
            <th>Rent Date</th>
            <th>Return Date</th>
            <th>Actual Return Date</th>
            <th>Pay</th>
            <th>Fine</th>
            <th>Status</th>


        </tr>
        @foreach($rent_logs as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->user->username }}</td>
            <td>{{ $item->user->phone }}</td>
            <td>{{ $item->car->nama_mobil }}</td>
            <td>{{ $item->rent_date }}</td>
            <td>{{ $item->return_date }}</td>
            <td>{{ $item->actual_return_date }}</td>>
            <td> Rp number_format($item->pay, 0, ',', '.')  }}</td>
            <td> Rp number_format($item->fine, 0, ',', '.') }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </table>
  
</body>
</html>
                                