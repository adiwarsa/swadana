<form action="/samsatmotor-renewupdate/{{ $samsat->id }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="input-group input-group-outline mt-3 focused is-focused">
        <label class="form-label">New Samsat Date</label>
        <input required type="date" class="form-control border border-2 p-2" id="new_samsat" name="new_samsat" value="{{ $samsat->new_samsat }}">
    </div>
    <div class="mt-3">
        <button class="btn btn-success" type="submit">Update</button>
    </div>
</form>