<div class="modal fade" id="inventoryModal" tabindex="-1" aria-labelledby="inventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="inventoryModalLabel">Add Inventory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
            {{-- <input type="hidden" name="_method" id="method_field" value="POST">
                <input type="hidden" id="inventory_id" name="inventory_id"> --}}
                <div class="form-group">
                    <label for="film_id">Film</label>
                    <select class="form-control" id="film_id" name="film_id" required>
                        <option value="">Select Film</option>
                        {{-- @foreach($films as $film) --}}
                            <option value="{{ $film->id }}" {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                {{ $film->title }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="store_id">Store</label>
                    <select class="form-control" id="store_id" name="store_id" required>
                        <option value="">Select Store</option>
                        {{-- @foreach($stores as $store) --}}
                            <option value="{{ $store->id }}" {{ old('store_id') == $store->id ? 'selected' : '' }}>
                                {{ $store->name }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="last_update">Last Update</label>
                    <input type="datetime-local" class="form-control" id="last_update" name="last_update" value="{{ old('last_update') }}" required>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
