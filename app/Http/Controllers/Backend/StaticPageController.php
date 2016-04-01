<?php

namespace App\Http\Controllers\Backend;

use App\liveCMS\Controllers\Backend\PostableController;
use App\Models\StaticPage as Model;
use Form;
use Illuminate\Http\Request;

class StaticPageController extends PostableController
{
    protected $unsortables = ['parent'];

    protected $query;
    
    public function __construct(Model $model, $base = 'staticpage')
    {
        parent::__construct($model, $base);
        $this->fields   = array_merge(['id' => 'id', 'parent' => 'parent'], array_except($this->model->getFields(), ['id', 'parent_id']));
        $this->query = request()->all();
    }

    public function index(Request $request)
    {
        $this->title        = title_case(trans('livecms.'.$this->base));
        $this->description  = trans('backend.alllist', ['list' => title_case(trans('livecms.'.$this->base))]);
        $this->breadcrumb3  = trans('backend.seeall');

        if (isset($this->query['hierarchy'])) {
            $this->fields = array_except($this->fields, ['parent']);
        }

        $this->view->share();

        return view('admin.staticpage.index'. ($request->has('hierarchy') ? 'Hierarchy' : 'All'));
    }

    protected function beforeDatatables($datas)
    {
        $datas = parent::beforeDatatables($datas);

        if (isset($this->query['id'])) {
            return $datas->where('id', $id = $this->query['id'])->orWhere('parent_id', $id)->orderBy('id', 'ASC');
        }

        if (! isset($this->query['hierarchy'])) {
            return $datas;
        }

        return $datas->whereNull('parent_id');
    }

    protected function processDatatables($datatables)
    {
        $datatables = parent::processDatatables($datatables);
        
        if (isset($this->query['hierarchy'])) {

            $key = $this->model->getKeyName();

            $hierarchy = isset($this->query['hierarchy']) ?  ['hierarchy' => 'true'] : [];

            return $datatables
                ->editColumn('menu', function ($data) use ($key, $hierarchy) {
                    return
                        '<a href="'.action($this->baseClass.'@show', [$data->{$key}]).'?'.http_build_query($hierarchy).'" 
                            class="btn btn-small btn-link">
                                <i class="fa fa-xs fa-eye"></i> 
                                Detail
                        </a> '.
                        '<a href="'.action($this->baseClass.'@edit', [$data->{$this->model->getKeyName()}]).'" 
                            class="btn btn-small btn-link">
                                <i class="fa fa-xs fa-pencil"></i> 
                                Edit
                        </a> '.
                        Form::open(['style' => 'display: inline!important', 'method' => 'delete',
                            'action' => [$this->baseClass.'@destroy', $data->{$this->model->getKeyName()}]
                        ]).
                        '  <button type="submit" onClick="return confirm(\''.trans('backend.deleteconfirmation').'\');" 
                            class="btn btn-small btn-link">
                                <i class="fa fa-xs fa-trash-o"></i> 
                                Delete
                        </button>
                        </form>';
                });
        }

        return $datatables
            ->editColumn('parent', function ($data) {
                return $data->parent ? $data->parent->title : '-';
            });
        
    }

    public function show(Request $request, $id)
    {
        $this->query = ['hierarchy' => 'true', 'id' => $id];

        return $this->index($request);
    }

    protected function loadFormClasses($model)
    {
        $parents = $this->model->whereNull('parent_id');
        
        if ($model->id) {
            $parents = $parents->where('id', '<>', $model->id);
        }
        
        $this->parents = [null => trans('backend.choose')] + $parents->pluck('title', 'id')->toArray();

        parent::loadFormClasses($model);
    }

    protected function processRequest($request)
    {
        $request = parent::processRequest($request);

        $parent_id = ($parent = $request->get('parent')) ? $parent : null;

        $request->merge(compact('parent_id'));
        
        return $request;
    }
}
