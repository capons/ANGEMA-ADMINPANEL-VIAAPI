<?php

namespace App\Http\Controllers\Engena;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engena\Trails\CreateTrailRequest;
use App\Http\Requests\Engena\Trails\UpdateTrailRequest;
use App\Http\Requests\Engena\Trails\DeleteTrailRequest;
use App\Models\Engena\Activity;
use App\Models\Engena\Reserve;
use App\Models\Engena\Trail;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataForm\DataForm;

class TrailController extends Controller
{
    private $dataGrid;
    private $dataForm;

    public function __construct(Activity $activity, Reserve $reserve, Trail $trail)
    {
        $this->activity = $activity;
        $this->reserve  = $reserve;
        $this->trail    = $trail;

        $this->dataGrid = DataGrid::source($trail->with('reserve', 'activity'));
        $this->dataForm = DataForm::source($trail);
    }

    public function index()
    {
        $dataGrid = $this->dataGrid;
        $dataGrid->attributes(['class' => 'table table-striped table-bordered table-hover']);
        $dataGrid->paginate(10);
        $dataGrid->add('TrailName','Trail Name', true);
        $dataGrid->add('TrailDescription','Description');
        $dataGrid->add('reserve.ReserveName','Reserve');
        $dataGrid->add('activity.Activity','Activity');
        $dataGrid->add('TrailMapURL','Map URL')->cell(function($value) {
            $stripped_url = str_limit($value, 40);
            return "<a href='{$value}' target='_blank'>{$stripped_url}</a>";
        });

        $dataGrid->add('ID','Actions')->cell(function($value) {
            $editUrl    = route('admin.trails.edit', ['id'=> $value]);
            $editLink   = "<a class='btn btn-xs btn-success' href='{$editUrl}'>
                            <i data-original-title='Edit' class='fa fa-pencil' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            $deleteUrl  = route('admin.trails.destroy', ['id'=> $value]);
            $csrfToken = csrf_token();
            $deleteLink = " <a class='btn btn-xs btn-danger' data-token='{$csrfToken}' data-method='delete' data-trans-title='Are you sure?' href='{$deleteUrl}'>
                                <i data-original-title='Delete' class='fa fa-times' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            return $editLink . $deleteLink;
        });

        return view('engena.trails.index', compact('dataGrid'));
    }

    public function create()
    {
        $reserves   = $this->reserve->lists('ReserveName','ID');
        $activities = $this->activity->lists('Activity','ID');

        $dataForm = $this->dataForm;
        $dataForm->select('ReserveID','Reserve')->options($reserves);
        $dataForm->select('ActivityID','Activity')->options($activities);
        $dataForm->text('TrailName','Trail Name')->rule('required');
        $dataForm->text('TrailDescription','Trail Description')->rule('required');
        $dataForm->textarea('TrailMapURL','Map URL')->attributes(['rows' => 2]);
        // $dataForm->file('RouteFile','Route File')->attributes(['class' => 'file', 'data-show-preview' => 'false', 'data-browse-class' => 'btn btn-default', 'data-show-upload' => 'false']);
        $dataForm->submit('Create', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.trails.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);
        $dataForm->attributes(['url' => route('admin.trails.store')]);

        return view('engena.trails.create', compact('dataForm'));
    }

    public function edit($id)
    {

        $reserves   = $this->reserve->lists('ReserveName','ID');
        $activities = $this->activity->lists('Activity','ID');

        $dataForm = DataForm::source($this->trail->find($id));
        $dataForm->hidden('ID','ID');
        $dataForm->select('ReserveID','Reserve')->options($reserves);
        $dataForm->select('ActivityID','Activity')->options($activities);
        $dataForm->text('TrailName','Trail Name')->rule('required');
        $dataForm->text('TrailDescription','Trail Description')->rule('required');
        $dataForm->textarea('TrailMapURL','Map URL')->attributes(['rows' => 2]);
        // $dataForm->file('RouteFile','Route File')->attributes(['class' => 'file', 'data-show-preview' => 'false', 'data-browse-class' => 'btn btn-default', 'data-show-upload' => 'false']);

        $dataForm->submit('Update', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.trails.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);
        $dataForm->attributes(['method' => 'PUT',  'url' => route('admin.trails.update', ['id'=> $id]) ]);

        return view('engena.trails.edit', compact('dataForm'));
    }

    public function store(CreateTrailRequest $request)
    {
        if (!$trail = $this->trail->addTrail()) {
            return back()->withInput();
        }
        return redirect()->route('admin.trails.index')
                    ->withFlashSuccess(trans('alerts.engena.trails.created'));
    }

    public function update($id, UpdateTrailRequest $request)
    {
        if (!$this->trail->updateTrail()) {
            return back()->withInput();
        }

        return redirect()->route('admin.trails.index')
                    ->withFlashSuccess(trans('alerts.engena.trails.updated'));
    }

    public function destroy($id, DeleteTrailRequest $request)
    {
        if (!$this->trail->deleteTrail($id)) {
            return back()->withInput();
        }

        return redirect()->route('admin.trails.index')
                    ->withFlashSuccess(trans('alerts.engena.trails.deleted'));
    }
}
