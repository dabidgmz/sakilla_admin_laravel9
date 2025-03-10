<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="customerModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="customerForm" method="POST" action="{{ route('Customers') }}">
                <div class="modal-body">
                    <input type="hidden" name="_method" id="method_field" value="POST"> 
                    @csrf
                    <div class="form-group">
                        <label for="store_id">Store ID</label>
                        <input type="text" class="form-control" id="store_id" name="store_id" placeholder="Enter Store ID" value="{{ old('store_id') }}" required>
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
                        <input type="text" class="form-control" id="address_id" name="address_id" placeholder="Enter address ID" value="{{ old('address_id') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="active">Active</label>
                        <select class="form-control" id="active" name="active">
                            <option value="1" {{ old('active') == "1" ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('active') == "0" ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <!-- Botón Save dentro del formulario -->
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
