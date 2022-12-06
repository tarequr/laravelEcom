<form method="POST" action="{{ route('coupon.update',$coupon->id) }}" id="editForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="form-group">
            <label for="coupon_code" class="col-form-label">Coupon Code:</label>
            <input type="text" class="form-control" name="coupon_code" id="coupon_code" value="{{ $coupon->coupon_code }}"
                placeholder="Enter coupon code" required>
        </div>

        <div class="form-group">
            <label for="type" class="col-form-label">Coupon Type:</label>
            <select name="type" id="" class="form-control" required>
                <option value="">Please select</option>
                <option value="1" {{ $coupon->type == "1" ? "selected" : "" }}>Fixed</option>
                <option value="2" {{ $coupon->type == "2" ? "selected" : "" }}>Percentage</option>
            </select>
        </div>

        <div class="form-group">
            <label for="coupon_amount" class="col-form-label">Amount:</label>
            <input type="number" class="form-control" name="coupon_amount" id="coupon_amount" value="{{ $coupon->coupon_amount }}"
                placeholder="Enter coupon amount" required>
        </div>

        <div class="form-group">
            <label for="valid_date" class="col-form-label">Valid Date:</label>
            <input type="date" class="form-control" name="valid_date" id="valid_date" required value="{{ $coupon->valid_date }}">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

