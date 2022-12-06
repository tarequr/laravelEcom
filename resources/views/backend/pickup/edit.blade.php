<form method="POST" action="{{ route('pickup.update',$pickup->id) }}" id="editForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="form-group">
            <label for="name" class="col-form-label">Pickup Name:</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $pickup->name }}"
                placeholder="Enter pickup name" required>
        </div>

        <div class="form-group">
            <label for="address" class="col-form-label">Pickup Address:</label>
            <input type="text" class="form-control" name="address" id="address" value="{{ $pickup->address }}"
                placeholder="Enter pickup address" required>
        </div>

        <div class="form-group">
            <label for="phone" class="col-form-label">Pickup Phone:</label>
            <input type="text" class="form-control" name="phone" id="phone" value="{{ $pickup->phone }}"
                placeholder="Enter pickup phone" required>
        </div>

        <div class="form-group">
            <label for="phone_two" class="col-form-label">Pickup Phone Two:</label>
            <input type="text" class="form-control" name="phone_two" id="phone_two" value="{{ $pickup->phone_two }}"
                placeholder="Enter pickup phone two" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

