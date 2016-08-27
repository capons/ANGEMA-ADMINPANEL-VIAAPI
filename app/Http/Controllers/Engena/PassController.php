<?php

namespace App\Http\Controllers\Engena;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engena\Passes\CreatePassRequest;
use App\Http\Requests\Engena\Passes\UpdatePassRequest;
use App\Http\Requests\Engena\Passes\DeletePassRequest;
use App\Models\Engena\Pass;
use App\Models\Engena\PassType;
use App\Models\Engena\PassDuration;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataForm\DataForm;
use Zofe\Rapyd\DataEdit\DataEdit;

class PassController extends Controller
{
    private $dataGrid;

    public function __construct(Pass $pass, PassDuration $passDuration, PassType $passType)
    {
        $this->pass         = $pass;
        $this->passDuration = $passDuration;
        $this->passType     = $passType;
        $this->dataGrid     = DataGrid::source($pass->with(['passType', 'passDuration']));
        $this->dataForm     = DataForm::source($pass->with(['passType', 'passDuration']));
    }

    public function index()
    {
        $dataGrid = $this->dataGrid;
        $dataGrid->attributes(['class' => 'table table-striped table-bordered table-hover']);
        $dataGrid->paginate(10);
        $dataGrid->add('name','Name', true);
        $dataGrid->add('passType.name','Pass Type');
        $dataGrid->add('passDuration.name','Pass Duration');
        $dataGrid->add('id','Actions')->cell(function($value) {
            $editUrl    = route('admin.passes.edit', ['id'=> $value]);
            $editLink   = "<a class='btn btn-xs btn-success' href='{$editUrl}'>
                            <i data-original-title='Edit' class='fa fa-pencil' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            $deleteUrl  = route('admin.passes.destroy', ['id'=> $value]);
            $csrfToken = csrf_token();
            $deleteLink = " <a class='btn btn-xs btn-danger' data-token='{$csrfToken}' data-method='delete' data-trans-title='Are you sure?' data-id='{$value}' href='{$deleteUrl}'>
                                <i data-original-title='Delete' class='fa fa-times' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            return $editLink . $deleteLink;
        });

        return view('engena.passes.index', compact('dataGrid'));
    }

    public function create()
    {
        $passTypes     = $this->passType->lists('Name','id');
        $passDurations = $this->passDuration->lists('Name','id');

        $dataForm = $this->dataForm;
        $dataForm->attributes(['url' => route('admin.passes.store')]);
        $dataForm->select('pass_type_id','Pass Type')->options($passTypes);
        $dataForm->select('pass_duration_id','Pass Duration')->options($passDurations);
        $dataForm->text('name','Name')->rule('required');
        $dataForm->textarea('description','Description')->attributes(['rows' => 3]);
        $dataForm->submit('Create', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.passes.index'),'Cancel','BL', ['class' => 'btn btn-default btn-cancel']);

        return view('engena.passes.create', compact('dataForm'));
    }

    public function edit($id)
    {
        $passTypes     = $this->passType->lists('Name','id');
        $passDurations = $this->passDuration->lists('Name','id');

        $editForm = DataForm::source($this->pass->find($id));

        $editForm->attributes(['method' => 'PUT',  'url' => route('admin.passes.update', ['id'=> $id]) ]);
        $editForm->hidden('id','id');
        $editForm->select('pass_type_id','Pass Type')->options($passTypes);
        $editForm->select('pass_duration_id','Pass Duration')->options($passDurations);
        $editForm->text('name','Name')->rule('required');
        $editForm->textarea('description','Description')->attributes(['rows' => 3]);
        $editForm->submit('Update', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $editForm->link(route('admin.passes.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);

        return view('engena.passes.edit', compact('editForm'));
    }

    public function store(CreatePassRequest $request)
    {
        if (!$pass = $this->pass->addPass()) {
            return back()->withInput();
        }
        return redirect()->route('admin.passes.index')
                    ->withFlashSuccess(trans('alerts.engena.passes.created'));
    }

    public function update(UpdatePassRequest $request)
    {
        if (!$this->pass->updatePass()) {
            return back()->withInput();
        }
        return redirect()->route('admin.passes.index')
                    ->withFlashSuccess(trans('alerts.engena.passes.updated'));
    }

    public function destroy($id, DeletePassRequest $request)
    {
        if (!$this->pass->deletePass($id)) {
            return back()->withInput();
        }
        return redirect()->route('admin.passes.index')
                    ->withFlashSuccess(trans('alerts.engena.passes.deleted'));
    }
}
