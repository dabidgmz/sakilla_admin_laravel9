<div class="modal fade" id="rentalModal" tabindex="-1" aria-labelledby="rentalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="rentalModalLabel">Update Rental</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="inventory_id">Inventory</label>
                    <select class="form-control" id="inventory_id" name="inventory_id" required>
                        <option value="">Select Inventory</option>
                        {{-- @foreach($inventories as $inventory) --}}
                            <option value="{{ $inventory->id }}" {{ old('inventory_id') == $inventory->id ? 'selected' : '' }}>
                                {{ $inventory->film->title }} - Store {{ $inventory->store->name }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="customer_id">Customer</label>
                    <select class="form-control" id="customer_id" name="customer_id" required>
                        <option value="">Select Customer</option>
                        {{-- @foreach($customers as $customer) --}}
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="staff_id">Staff</label>
                    <select class="form-control" id="staff_id" name="staff_id" required>
                        <option value="">Select Staff</option>
                        {{-- @foreach($staff as $staffMember) --}}
                            <option value="{{ $staffMember->id }}" {{ old('staff_id') == $staffMember->id ? 'selected' : '' }}>
                                {{ $staffMember->first_name }} {{ $staffMember->last_name }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="rental_date">Rental Date</label>
                    <input type="datetime-local" class="form-control" id="rental_date" name="rental_date" value="{{ old('rental_date') }}" required>
                </div>

                <div class="form-group">
                    <label for="return_date">Return Date</label>
                    <input type="datetime-local" class="form-control" id="return_date" name="return_date" value="{{ old('return_date') }}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
