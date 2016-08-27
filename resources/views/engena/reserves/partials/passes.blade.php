<div class="form-group">
    <label for="passes" class="col-sm-2 control-label required text-right">Passes</label>

    <div class="col-sm-10">
        <div class="form-control" style="height:auto;">
            <button class="btn btn-success-outline btn-sm" v-on:click="showModal($event)">
                <i class="fa fa-plus"></i> Add Pass
            </button>
            <table v-show="selectedPasses.length > 0" class="table table-striped table-bordered table-hover" style="margin:5px 0 0 0; font-size: 13px;">
                <tr>
                    <th>Pass</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                <tr v-for="pass in selectedPasses">
                    <td class="@{{ pass.pass_id }}">
                        @{{ passes[pass.pass_id].name }}
                        <input name="passes[@{{ $index }}][pass_id]" value="@{{ pass.pass_id }}" type="hidden">
                    </td>
                    <td>
                        @{{ pass.price }}
                        <input name="passes[@{{ $index }}][price]" value="@{{ pass.price }}" type="hidden">
                    </td>
                    <td class='actions'>
                    <a v-on:click="editPass($index)" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                    <a v-on:click="removePass($index)" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
