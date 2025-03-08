<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="paymentModalLabel">Add Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
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
                    <label for="rental_id">Rental</label>
                    <select class="form-control" id="rental_id" name="rental_id" required>
                        <option value="">Select Rental</option>
                        {{-- @foreach($rentals as $rental) --}}
                            <option value="{{ $rental->id }}" {{ old('rental_id') == $rental->id ? 'selected' : '' }}>
                                Rental #{{ $rental->rental_id }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                </div>

                <div class="form-group">
                    <label for="payment_date">Payment Date</label>
                    <input type="datetime-local" class="form-control" id="payment_date" name="payment_date" value="{{ old('payment_date') }}" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
