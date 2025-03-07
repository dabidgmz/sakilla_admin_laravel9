<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="customerModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
               {{-- <input type="hidden" name="_method" id="method_field" value="POST"> 
                <input type="hidden" id="customer_id" name="customer_id"> --}}

                <div class="form-group">
                    <label for="store_id">Store ID</label>
                    <select class="form-control" id="store_id" name="store_id">
                        <option value="">Select Store</option>
                        {{--@foreach($stores as $store)
                            <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                Store {{ $store->id }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="address_id">Address ID</label>
                    <select class="form-control" id="address_id" name="address_id">
                        <option value="">Select Address</option>
                        {{--@foreach($addresses as $address)
                            <option value="{{ $address->id }}" {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                {{ $address->address1 }}
                            </option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="active">Active</label>
                    <select class="form-control" id="active" name="active">
                        <option value="1" {{ old('active') == "1" ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('active') == "0" ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="create_date">Create Date</label>
                    <input type="date" class="form-control" id="create_date" name="create_date" value="{{ old('create_date') }}">
                </div>

                <div class="form-group">
                    <label for="last_update">Last Update</label>
                    <input type="datetime-local" class="form-control" id="last_update" name="last_update" value="{{ old('last_update') }}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
