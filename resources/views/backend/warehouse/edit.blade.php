<form method="POST" action="{{ route('warehouse.update',$warehouse->id) }}" id="addForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $warehouse->name }}" id="name"
                placeholder="Enter warehouse name" required>
        </div>

        <div class="form-group">
            <label for="phone" class="col-form-label">Phone:</label>
            <input type="text" class="form-control" name="phone" value="{{ $warehouse->phone }}" id="phone"
                placeholder="Enter warehouse phone number" required>
        </div>

        <div class="form-group">
            <label for="address" class="col-form-label">Address:</label>
            <input type="text" class="form-control" name="address" value="{{ $warehouse->address }}" id="address"
                placeholder="Enter warehouse address" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

