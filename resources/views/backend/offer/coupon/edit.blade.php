<form method="POST" action="{{ route('brand.update',$brand->id) }}" id="addForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="form-group">
            <label for="brnad_name" class="col-form-label">Brand:</label>
            <input type="text" class="form-control" name="brnad_name" id="brnad_name" value="{{ $brand->brnad_name }}"
                placeholder="Enter brand name" required>
        </div>

        <div class="form-group">
            <label for="brand_logo" class="col-form-label ">Brand Logo:</label>
            <input type="file" class="form-control dropify" name="brand_logo" id="brand_logo">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

