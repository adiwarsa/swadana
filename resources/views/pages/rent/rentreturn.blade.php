
<form action="/rentcar-returnupdate/{{ $rent->id }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label class="form-label">Return Car</label>
        <input required type="date" class="form-control border border-2 p-2" id="actual_return_date" name="actual_return_date" value="{{ $rent->actual_return_date }}">
    </div>
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label class="form-label">Return At</label>
        <input type="text" class="form-control border border-2 p-2" id="return_at" name="return_at" value="{{ $rent->return_at }}">
    </div>
    <div class="mt-3">
        <button class="btn btn-success" type="submit">Update</button>
    </div>
</form>