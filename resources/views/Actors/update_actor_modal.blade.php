<div class="modal fade" id="actorModal" tabindex="-1" aria-labelledby="actorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="actorModalLabel">Update Actor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

          {{--  <!-- <form id="actorForm" method="PUT" action="{{ route('actors.store') }}"> --> --}}
                <input type="hidden" name="_method" id="method_field" value="PUT"> 
                <input type="hidden" id="actor_id" name="actor_id"> 

                <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name">Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Ingrese el nombre" value="{{ old('first_name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Lastname</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese el apellido" value="{{ old('last_name') }}" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            <!-- </form> -->
        </div>
    </div>
</div>
