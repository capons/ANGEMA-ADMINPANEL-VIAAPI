<?php

namespace App\Http\Controllers\Engena;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engena\Reserves\CreateReserveRequest;
use App\Http\Requests\Engena\Reserves\UpdateReserveRequest;
use App\Http\Requests\Engena\Reserves\DeleteReserveRequest;
use App\Models\Engena\Activity;
use App\Models\Engena\Pass;
use App\Models\Engena\Region;
use App\Models\Engena\Reserve;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataForm\DataForm;

class ReserveController extends Controller
{
    private $dataGrid;
    private $dataForm;

    public function __construct(Activity $activity, Pass $pass, Region $region, Reserve $reserve)
    {
        $this->activity     = $activity;
        $this->pass         = $pass;
        $this->region       = $region;
        $this->reserve      = $reserve;
        $this->dataGrid     = DataGrid::source($reserve->with(['region', 'passes']));
        $this->dataForm     = DataForm::source($reserve->with('region'));
    }

    public function index()
    {
        $dataGrid = $this->dataGrid;
        $dataGrid->attributes(['class' => 'table table-striped table-bordered table-hover']);
        $dataGrid->paginate(10);
        $dataGrid->add('ReserveName','Reserve Name', true);
        $dataGrid->add('region.Region','Region');
        $dataGrid->add('Admin_Email','Admin Email');
        $dataGrid->add('activities','Activities')->cell(function($value) {
            return $value->implode('Activity', '<br>');
        });
        $dataGrid->add('passes','Pass - Price')->cell(function($value) {
            $passes = '<table class="pass-prices">';
            foreach($value as $reservePass) {
                $passes .= "<tr>
                            <td class='pass-name'> {$reservePass->pass->name} </td>
                            <td> {$reservePass->price} </td>
                        </tr>";
            }
            $passes .= "</table>";
            return $passes;
        });

        $dataGrid->add('ID','Actions')->cell(function($value) {
            $editUrl    = route('admin.reserves.edit', ['id'=> $value]);
            $editLink   = "<a class='btn btn-xs btn-success' href='{$editUrl}'>
                            <i data-original-title='Edit' class='fa fa-pencil' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            $deleteUrl  = route('admin.reserves.destroy', ['id'=> $value]);
            $csrfToken = csrf_token();
            $deleteLink = " <a class='btn btn-xs btn-danger' data-token='{$csrfToken}' data-method='delete' data-trans-title='Are you sure?' href='{$deleteUrl}'>
                                <i data-original-title='Delete' class='fa fa-times' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            return $editLink . $deleteLink;
        });

        return view('engena.reserves.index', compact('dataGrid'));
    }

    public function create()
    {
        $regions       = $this->region->lists('Region','ID');
        $activities    = $this->activity->lists('Activity','ID');
        $passes        = $this->pass->select(['id', 'name'])->get()->keyBy('id')->toArray();

        $dataForm = $this->dataForm;
        $dataForm->select('RegionID','Region')->options($regions);
        $dataForm->text('ReserveName','Reserve Name')->rule('required');
        $dataForm->text('Admin_Email','Admin Email')->rule('required');
        $dataForm->multiselect('activities','Activities')->options($activities);
        $dataForm->submit('Create', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.reserves.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);
        $dataForm->attributes(['url' => route('admin.reserves.store')]);
        $dataForm->build();

        $selectedPasses = (sizeof(app('request')->old('passes')) > 0) ? app('request')->old('passes') : [];
        javascript()->put(compact('passes', 'selectedPasses'));
        return view('engena.reserves.create', compact('dataForm'));
    }

    public function edit($id)
    {
        $reserve        = $this->reserve->findOrFail($id);
        $activities     = $this->activity->lists('Activity','ID');
        $regions        = $this->region->lists('Region','ID');
        $passes         = $this->pass->select(['id', 'name'])->get()->keyBy('id')->toArray();

        $selectedPasses = $reserve->passes()->select(['pass_id', 'price'])->get()->toArray();
        $selectedPasses = (sizeof(app('request')->old('passes')) >0) ? app('request')->old('passes') : $selectedPasses;

        javascript()->put(compact('passes', 'selectedPasses'));

        $editForm = DataForm::source($reserve);
        $editForm->hidden('ID','ID');
        $editForm->select('RegionID','Region')->options($regions);
        $editForm->text('ReserveName','Reserve Name')->rule('required');
        $editForm->text('Admin_Email','Admin Email')->rule('required');
        $editForm->multiselect('activities','Activities')->options($activities);
        $editForm->submit('Update', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $editForm->link(route('admin.reserves.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);
        $editForm->attributes(['method' => 'PUT',  'url' => route('admin.reserves.update', ['id'=> $id]) ]);
        $editForm->build();

        return view('engena.reserves.edit', compact('editForm'));
    }

    public function store(CreateReserveRequest $request)
    {
        if (!$reserve = $this->reserve->addReserve()) {
            return back()->withInput();
        }
        return redirect()->route('admin.reserves.index')
                    ->withFlashSuccess(trans('alerts.engena.reserves.created'));
    }

    public function update(UpdateReserveRequest $request)
    {
        if (!$this->reserve->updateReserve()) {
            return back()->withInput();
        }
        return redirect()->route('admin.reserves.index')
                    ->withFlashSuccess(trans('alerts.engena.reserves.updated'));
    }

    public function destroy($id, DeleteReserveRequest $request)
    {
        if (!$this->reserve->deleteReserve($id)) {
            return back()->withInput();
        }
        return redirect()->route('admin.reserves.index')
                    ->withFlashSuccess(trans('alerts.engena.reserves.deleted'));
    }
}
