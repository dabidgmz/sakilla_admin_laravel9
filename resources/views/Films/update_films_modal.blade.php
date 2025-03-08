<div class="modal fade" id="filmsModal" tabindex="-1" aria-labelledby="filmsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="filmsModalLabel">Update Film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{-- <input type="hidden" name="_method" id="method_field" value="PUT">
                <input type="hidden" id="film_id" name="film_id"> --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" value="{{ old('title') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter Description" required>{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="release_year">Release Year</label>
                    <input type="number" class="form-control" id="release_year" name="release_year" placeholder="Enter Year" value="{{ old('release_year') }}" required>
                </div>

                <div class="form-group">
                    <label for="language_id">Language</label>
                    <select class="form-control" id="language_id" name="language_id">
                        <option value="">Select Language</option>
                        {{-- @foreach($languages as $language) --}}
                            <option value="{{ $language->id }}" {{ old('language_id') == $language->id ? 'selected' : '' }}>
                                {{ $language->name }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="original_language_id">Original Language</label>
                    <select class="form-control" id="original_language_id" name="original_language_id">
                        <option value="">Select Original Language</option>
                        {{-- @foreach($languages as $language) --}}
                            <option value="{{ $language->id }}" {{ old('original_language_id') == $language->id ? 'selected' : '' }}>
                                {{ $language->name }}
                            </option>
                        {{-- @endforeach --}}
                    </select>
                </div>

                <div class="form-group">
                    <label for="rental_duration">Rental Duration (days)</label>
                    <input type="number" class="form-control" id="rental_duration" name="rental_duration" value="{{ old('rental_duration') }}" required>
                </div>

                <div class="form-group">
                    <label for="rental_rate">Rental Rate</label>
                    <input type="number" step="0.01" class="form-control" id="rental_rate" name="rental_rate" value="{{ old('rental_rate') }}" required>
                </div>

                <div class="form-group">
                    <label for="length">Length (minutes)</label>
                    <input type="number" class="form-control" id="length" name="length" value="{{ old('length') }}">
                </div>

                <div class="form-group">
                    <label for="replacement_cost">Replacement Cost</label>
                    <input type="number" step="0.01" class="form-control" id="replacement_cost" name="replacement_cost" value="{{ old('replacement_cost') }}" required>
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="">Select Rating</option>
                        <option value="G" {{ old('rating') == 'G' ? 'selected' : '' }}>G</option>
                        <option value="PG" {{ old('rating') == 'PG' ? 'selected' : '' }}>PG</option>
                        <option value="PG-13" {{ old('rating') == 'PG-13' ? 'selected' : '' }}>PG-13</option>
                        <option value="R" {{ old('rating') == 'R' ? 'selected' : '' }}>R</option>
                        <option value="NC-17" {{ old('rating') == 'NC-17' ? 'selected' : '' }}>NC-17</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="special_features">Special Features</label>
                    <input type="text" class="form-control" id="special_features" name="special_features" value="{{ old('special_features') }}">
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
