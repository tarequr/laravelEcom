<form method="POST" action="{{ route('childcategory.update',$childCategory->id) }}" id="addForm">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="form-group">
            <label for="category" class="col-form-label">Category / Sub Category:</label>
            <select class="form-control select2" name="subcategory_id" id="category" required>
                <option value="">Please select</option>
                @foreach ($categories as $category)
                    @php
                        $subCategories = App\Models\SubCategory::where('category_id',$category->id)->get();
                    @endphp
                    <option value="" disabled>{{ $category->name }}</option>

                        @foreach ($subCategories as $subCategor)
                        <option value="{{ $subCategor->id }}" {{ $subCategor->id == $childCategory->subcategory_id ? "selected" : "" }}> ~~~~~ {{ $subCategor->subcategory_name }}</option>
                        @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="childcategory_name" class="col-form-label">Child Category:</label>
            <input type="text" class="form-control" name="childcategory_name" value="{{ $childCategory->childcategory_name }}" id="childcategory_name"
                placeholder="Enter child category name" required>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

