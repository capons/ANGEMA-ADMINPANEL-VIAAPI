<?php

namespace App\Http\Controllers\Engena;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engena\PassTypes\CreatePassTypeRequest;
use App\Http\Requests\Engena\PassTypes\UpdatePassTypeRequest;
use App\Http\Requests\Engena\PassTypes\DeletePassTypeRequest;
use App\Models\Engena\PassType;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataForm\DataForm;

class PassTypeController extends Controller
{
    private $dataGrid;
    private $dataForm;

    public function __construct(PassType $passType)
    {
        $this->passType = $passType;
        $this->dataGrid = DataGrid::source($passType);
        $this->dataForm = DataForm::source($passType);
    }

    public function index()
    {
        $dataGrid = $this->dataGrid;
        $dataGrid->attributes(['class' => 'table table-striped table-bordered table-hover']);
        $dataGrid->paginate(10);
        $dataGrid->add('name','Name', true);
        $dataGrid->add('description','Description');
        $dataGrid->add('id','Actions')->cell(function($value) {
            $editUrl    = route('admin.pass_types.edit', ['id'=> $value]);
            $editLink   = "<a class='btn btn-xs btn-success' href='{$editUrl}'>
                            <i data-original-title='Edit' class='fa fa-pencil' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            $deleteUrl  = route('admin.pass_types.destroy', ['id'=> $value]);
            $csrfToken = csrf_token();
            $deleteLink = " <a class='btn btn-xs btn-danger' data-token='{$csrfToken}' data-method='delete' data-trans-title='Are you sure?' data-id='{$value}' href='{$deleteUrl}'>
                                <i data-original-title='Delete' class='fa fa-times' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            return $editLink . $deleteLink;
        });

        return view('engena.pass_types.index', compact('dataGrid'));
    }

    public function create()
    {
        $dataForm = $this->dataForm;
        $dataForm->attributes(['url' => route('admin.pass_types.store')]);
        $dataForm->text('name','Name')->rule('required');
        $dataForm->textarea('description','Description')->attributes(['rows' => 3]);
        $dataForm->submit('Create', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.pass_types.index'),'Cancel','BL', ['class' => 'btn btn-default btn-cancel']);

        return view('engena.pass_types.create', compact('dataForm'));
    }

    public function edit($id)
    {
        $editForm = DataForm::source($this->passType->find($id));

        $editForm->attributes(['method' => 'PUT',  'url' => route('admin.pass_types.update', ['id'=> $id]) ]);
        $editForm->hidden('id','id');
        $editForm->text('name','Name')->rule('required');
        $editForm->textarea('description','Description')->attributes(['rows' => 3]);
        $editForm->submit('Update', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $editForm->link(route('admin.pass_types.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);

        return view('engena.pass_types.edit', compact('editForm'));
    }

    public function store(CreatePassTypeRequest $request)
    {
        if (!$pass = $this->passType->addPassType()) {
            return back()->withInput();
        }
        return redirect()->route('admin.pass_types.index')
                    ->withFlashSuccess(trans('alerts.engena.passTypes.created'));
    }

    public function update(UpdatePassTypeRequest $request)
    {
        if (!$this->passType->updatePassType()) {
            return back()->withInput();
        }
        return redirect()->route('admin.pass_types.index')
                    ->withFlashSuccess(trans('alerts.engena.passTypes.updated'));
    }

    public function destroy($id, DeletePassTypeRequest $request)
    {
        if (!$this->passType->deletePassType($id)) {
            return back()->withInput();
        }
        return redirect()->route('admin.pass_types.index')
                    ->withFlashSuccess(trans('alerts.engena.passTypes.deleted'));
    }
}
