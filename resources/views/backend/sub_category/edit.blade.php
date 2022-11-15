<form method="POST" action="{{ route('subcategory.update',$subCategory->id) }}" class="formData" id="myform">
    @csrf

    @method('PUT')

    <div class="modal-body">
        <div class="form-group">
            <label for="category" class="col-form-label">Category:</label>
            <select class="form-control" name="category" id="category" required>
                <option value="">please select</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $subCategory->category_id ? "selected" : "" }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subcategory_name" class="col-form-label">Sub Category:</label>
            <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="{{ $subCategory->subcategory_name }}"
                placeholder="Enter sub category name" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
