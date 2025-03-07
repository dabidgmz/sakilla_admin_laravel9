<div class="modal fade" id="actorModal" tabindex="-1" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="actorModalLabel">Add Address</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{--  <!-- <form id="actorForm" method="POST" action="{{ route('') }}"> --> --}}
                <input type="hidden" name="_method" id="method_field" value="POST"> 
                <input type="hidden" id="address_id" name="address_id">
            <div class="modal-body">
                <div class="form-group">
                    <label for="first_name">Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Ingrese el nombre" value="{{ old('first_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Lastname</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese el apellido" value="{{ old('last_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="address_id">Address ID</label>
                    <select class="form-control" id="address_id" name="address_id" disabled>
                        <option value="">Select Address</option>
                        {{--@foreach($addresses as $address)
                            <option value="{{ $address->id }}" {{ old('address_id') == $address->id ? 'selected' : '' }}>
                                {{ $address->address1 }} 
                            </option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="address1">Address 1</label>
                    <input type="text" class="form-control" id="address1" name="address1" value="{{ old('address1') }}">
                </div>

                <div class="form-group">
                    <label for="address2">Address 2</label>
                    <input type="text" class="form-control" id="address2" name="address2" value="{{ old('address2') }}">
                </div>

                <div class="form-group">
                    <label for="district">District</label>
                    <input type="text" class="form-control" id="district" name="district" value="{{ old('district') }}">
                </div>

                <div class="form-group">
                    <label for="city_id">City ID</label>
                    <select class="form-control" id="city_id" name="city_id" disabled>
                        <option value="">Select City</option>
                         {{--@foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }} 
                            </option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="postal_code">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
