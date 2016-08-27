<modal :show.sync="showAddPassModal" effect="fade">
    <div slot="modal-header" class="modal-header">
        <h4 v-show="modalAction == 'add'" class="modal-title">Add Pass</h4>
        <h4 v-show="modalAction == 'edit'" class="modal-title">Edit Pass</h4>
    </div>

    <div slot="modal-body" class="modal-body">
        <div class="alert alert-danger" v-show="errorMessages.length > 0">
            <span v-for="error in errorMessages">@{{ error }} <br></span>
        </div>

        <div class="form form-horizontal">
            <div class="form-group">
                <label for="pass_id" class="col-sm-3 control-label">Pass</label>
                <div class="col-sm-9">
                    <select class="form-control" v-bind:disabled="modalAction == 'edit'" v-model="selected.pass_id" name="pass_id" placeholder="Select Pass">
                        <option v-for="option in passes" v-bind:value="option.id">@{{ option.name }}</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="col-sm-3 control-label">Price:</label>
                <div class="col-sm-9">
                    <input class="form-control" type="text" v-model="selected.price" name="price" placeholder="Price">
                </div>
            </div>
        </div>

    </div>

    <div slot="modal-footer" class="modal-footer">
        <button class="btn btn-default" @click='closeModal'>Cancel</button>
        <button v-if="modalAction =='add'" class="btn btn-success" @click='addPass'>Add Pass</button>
        <button v-if="modalAction =='edit'" class="btn btn-success" @click='savePass'>Save</button>
    </div>
</modal>
