<?php

namespace App\Http\Controllers\Engena;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engena\PassDurations\CreatePassDurationRequest;
use App\Http\Requests\Engena\PassDurations\UpdatePassDurationRequest;
use App\Http\Requests\Engena\PassDurations\DeletePassDurationRequest;
use App\Models\Engena\PassDuration;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataForm\DataForm;

class PassDurationController extends Controller
{
    private $dataGrid;
    private $durationMetrics = [ 'day' => 'day', 'week' => 'week', 'month' => 'month', 'year' => 'year' ];

    public function __construct(PassDuration $passDuration)
    {
        $this->passDuration = $passDuration;
        $this->dataGrid     = DataGrid::source($passDuration);
        $this->dataForm     = DataForm::source($passDuration);
    }

    public function index()
    {
        $dataGrid = $this->dataGrid;
        $dataGrid->attributes(['class' => 'table table-striped table-bordered table-hover']);
        $dataGrid->paginate(10);
        $dataGrid->add('name','Name', true);
        $dataGrid->add('duration','Duration');
        $dataGrid->add('duration_metric','Duration Metric');
        $dataGrid->add('id','Actions')->cell(function($value) {
            $editUrl    = route('admin.pass_durations.edit', ['id'=> $value]);
            $editLink   = "<a class='btn btn-xs btn-success' href='{$editUrl}'>
                            <i data-original-title='Edit' class='fa fa-pencil' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            $deleteUrl  = route('admin.pass_durations.destroy', ['id'=> $value]);
            $csrfToken = csrf_token();
            $deleteLink = " <a class='btn btn-xs btn-danger' data-token='{$csrfToken}' data-method='delete' data-trans-title='Are you sure?' data-id='{$value}' href='{$deleteUrl}'>
                                <i data-original-title='Delete' class='fa fa-times' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            return $editLink . $deleteLink;
        });

        return view('engena.pass_durations.index', compact('dataGrid'));
    }

    public function create()
    {
        $dataForm = $this->dataForm;
        $dataForm->attributes(['url' => route('admin.pass_durations.store')]);
        $dataForm->text('duration','Duration')->rule('required');
        $dataForm->select('duration_metric','Duration Metric')->options($this->durationMetrics)->rule('required');
        $dataForm->text('name','Name')->rule('required');
        $dataForm->textarea('description','Description')->attributes(['rows' => 2]);
        $dataForm->submit('Create', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.pass_durations.index'),'Cancel','BL',['class' =>'btn btn-default btn-cancel']);

        return view('engena.pass_durations.create', compact('dataForm'));
    }

    public function edit($id)
    {
        $dataForm = DataForm::source($this->passDuration->find($id));

        $dataForm->attributes(['method' => 'PUT',  'url' => route('admin.pass_durations.update', ['id'=> $id]) ]);
        $dataForm->hidden('id','id');
        $dataForm->text('duration','Duration')->rule('required');
        $dataForm->select('duration_metric','Duration Metric')->options($this->durationMetrics)->rule('required');
        $dataForm->text('name','Name')->rule('required');
        $dataForm->textarea('description','Description')->attributes(['rows' => 2]);
        $dataForm->submit('Update', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.pass_durations.index'),'Cancel','BL',['class' =>'btn btn-default btn-cancel']);

        return view('engena.pass_durations.edit', compact('dataForm'));
    }

    public function store(CreatePassDurationRequest $request)
    {
        if (!$pass = $this->passDuration->addPassDuration()) {
            return back()->withInput();
        }
        return redirect()->route('admin.pass_durations.index')
                    ->withFlashSuccess(trans('alerts.engena.passDurations.created'));
    }

    public function update(UpdatePassDurationRequest $request)
    {
        if (!$this->passDuration->updatePassDuration()) {
            return back()->withInput();
        }
        return redirect()->route('admin.pass_durations.index')
                    ->withFlashSuccess(trans('alerts.engena.passDurations.updated'));
    }

    public function destroy($id, DeletePassDurationRequest $request)
    {
        if (!$this->passDuration->deletePassDuration($id)) {
            return back()->withInput();
        }
        return redirect()->route('admin.pass_durations.index')
                    ->withFlashSuccess(trans('alerts.engena.passDurations.deleted'));
    }
}
