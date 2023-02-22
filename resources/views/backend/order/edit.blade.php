<form method="POST" action="{{ route('order.update',$order->id) }}" id="addForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="form-group">
            <label for="c_name" class="col-form-label">Name</label>
            <input type="text" class="form-control" name="c_name" id="c_name" value="{{ $order->c_name }}" placeholder="Enter name" required>
        </div>

        <div class="form-group">
            <label for="c_phone" class="col-form-label">Phone</label>
            <input type="text" class="form-control" name="c_phone" id="c_phone" value="{{ $order->c_phone }}" placeholder="Enter phone" required>
        </div>

        <div class="form-group">
            <label for="c_address" class="col-form-label">Address</label>
            <input type="text" class="form-control" name="c_address" id="c_address" value="{{ $order->c_address }}" placeholder="Enter address" required>
        </div>

        <div class="form-group">
            <label for="status" class="col-form-label">Order Status</label>
            <select class="form-control" name="status" id="status" required>
                <option value="">Please select</option>
                <option value="0" {{ $order->status == 0 ? "selected" : "" }}>Pending</option>
                <option value="1" {{ $order->status == 1 ? "selected" : "" }}>Received</option>
                <option value="2" {{ $order->status == 2 ? "selected" : "" }}>Shipping</option>
                <option value="3" {{ $order->status == 3 ? "selected" : "" }}>Done</option>
                <option value="4" {{ $order->status == 4 ? "selected" : "" }}>Return</option>
                <option value="5" {{ $order->status == 5 ? "selected" : "" }}>Cancle</option>
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

