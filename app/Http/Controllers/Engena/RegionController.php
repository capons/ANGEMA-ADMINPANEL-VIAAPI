<?php

namespace App\Http\Controllers\Engena;

use App\Http\Controllers\Controller;
use App\Http\Requests\Engena\Regions\CreateRegionRequest;
use App\Http\Requests\Engena\Regions\UpdateRegionRequest;
use App\Http\Requests\Engena\Regions\DeleteRegionRequest;
use App\Models\Engena\Region;
use Zofe\Rapyd\DataGrid\DataGrid;
use Zofe\Rapyd\DataForm\DataForm;
use Zofe\Rapyd\DataEdit\DataEdit;

class RegionController extends Controller
{
    private $dataGrid;

    public function __construct(Region $region)
    {
        $this->region   = $region;
        $this->dataGrid = DataGrid::source($region);
        $this->dataForm = DataForm::source($region);
    }

    public function index()
    {
        $dataGrid = $this->dataGrid;
        $dataGrid->attributes(['class' => 'table table-striped table-bordered table-hover']);
        $dataGrid->paginate(10);
        $dataGrid->add('Region','Region', true);
        $dataGrid->add('Country','Country');
        $dataGrid->add('StateProvince','State Province');
        $dataGrid->add('enabled','Status', true)->cell(function($value) {
            return ($value == 1) ? "Active" : "Disabled";
        });
        $dataGrid->add('ID','Actions')->cell(function($value) {
            $editUrl    = route('admin.regions.edit', ['id'=> $value]);
            $editLink   = "<a class='btn btn-xs btn-success' href='{$editUrl}'>
                            <i data-original-title='Edit' class='fa fa-pencil' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            $deleteUrl  = route('admin.regions.destroy', ['id'=> $value]);
            $csrfToken = csrf_token();
            $deleteLink = " <a class='btn btn-xs btn-danger' data-token='{$csrfToken}' data-method='delete' data-trans-title='Are you sure?' data-id='{$value}' href='{$deleteUrl}'>
                                <i data-original-title='Delete' class='fa fa-times' data-toggle='tooltip' data-placement='top' title=''></i>
                        </a>";
            return $editLink . $deleteLink;
        });
        $dataGrid->row(function ($row) {
           if ($row->cell('enabled')->value == 'Disabled') {
               $row->style("color:#888; ");
           }
        });

        return view('engena.regions.index', compact('dataGrid'));
    }

    public function create()
    {
        $dataForm = $this->dataForm;
        $dataForm->attributes(['url' => route('admin.regions.store')]);
        $dataForm->text('Country','Country')->rule('required');
        $dataForm->text('StateProvince','State Province')->rule('required');
        $dataForm->text('Region','Region')->rule('required');
        $dataForm->select('enabled','Status')->options([1=>'Active',0=>'Inactive']);
        $dataForm->submit('Create', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $dataForm->link(route('admin.regions.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);

        return view('engena.regions.create', compact('dataForm'));
    }

    public function edit($id)
    {
        $editForm = DataForm::source($this->region->find($id));

        $editForm->attributes(['method' => 'PUT',  'url' => route('admin.regions.update', ['id'=> $id]) ]);
        $editForm->hidden('ID','ID');
        $editForm->text('Country','Country')->rule('required');
        $editForm->text('StateProvince','State Province')->rule('required');
        $editForm->text('Region','Region')->rule('required');
        $editForm->select('enabled','Status')->options([1=>'Active',0=>'Inactive']);
        $editForm->submit('Update', 'BL', ['class' => 'btn btn-success btn-save col-sm-4']);
        $editForm->link(route('admin.regions.index'), 'Cancel',  'BL', ['class' => 'btn btn-default btn-cancel']);

        return view('engena.regions.edit', compact('editForm'));
    }

    public function store(CreateRegionRequest $request)
    {
        if (!$region = $this->region->addRegion()) {
            return back()->withInput();
        }
        return redirect()->route('admin.regions.index')
                    ->withFlashSuccess(trans('alerts.engena.regions.created'));
    }

    public function update(UpdateRegionRequest $request)
    {
        if (!$this->region->updateRegion()) {
            return back()->withInput();
        }
        return redirect()->route('admin.regions.index')
                    ->withFlashSuccess(trans('alerts.engena.regions.updated'));
    }

    public function destroy($id, DeleteRegionRequest $request)
    {
        if (!$this->region->deleteRegion($id)) {
            return back()->withInput();
        }
        return redirect()->route('admin.regions.index')
                    ->withFlashSuccess(trans('alerts.engena.regions.deleted'));
    }
}
