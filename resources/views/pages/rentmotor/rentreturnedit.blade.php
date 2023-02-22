<form action="/rentmotor-returneditupdate/{{ $rent->id }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label for="user_id" class="form-label">User</label>
        <select name="user_id" id="user_id" class="form-control border border-2 p-2">
            @foreach ($user as $item)
            <option value="{{ $item->id }}" {{ $item->id == $rent->user_id ? 'selected' : '' }}>{{ $item->username }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label for="motor_id" class="form-label">Motor</label>
        <select name="motor_id" id="motor_id" class="form-control border border-2 p-2">
            @foreach ($motor as $item)
            <option value="{{ $item->id }}" {{ $item->id == $rent->motor_id ? 'selected' : '' }}>{{ $item->nama_motor }}</option>
            @endforeach
        </select>
    </div>
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label for="rent_date" class="form-label">Rent Date</label>
        <input required type="date" class="form-control border border-2 p-2" id="rent_date" name="rent_date" value="{{ $rent->rent_date }}">
    </div>
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label for="return_date" class="form-label">Return Date</label>
        <input required type="date" class="form-control border border-2 p-2" id="return_date" name="return_date" value="{{ $rent->return_date }}">
    </div>
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label for="actual_return_date" class="form-label">Actual Return Date</label>
        <input type="date" class="form-control border border-2 p-2" id="actual_return_date" name="actual_return_date" value="{{ $rent->actual_return_date }}">
    </div>
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label class="form-label">Delivery</label>
        <input type="text" class="form-control form-control border border-2 p-2" id="delivery" name="delivery" value="{{ $rent->delivery }}">
    </div>
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label class="form-label">Fine</label>
        <input type="number" class="form-control form-control border border-2 p-2" value="{{ $rent->fine }}" disabled>
    </div>
   
    <div class="mt-3">
        <button class="btn btn-success" type="submit">Update</button>
    </div>
</form>