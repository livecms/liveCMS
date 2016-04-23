<?php

namespace App\Http\Controllers\Backend;

use App\liveCMS\Controllers\Backend\PostableController;
use App\liveCMS\Models\Permalink;
use App\Models\Client;
use App\Models\Project as Model;
use App\Models\ProjectCategory;

class ProjectController extends PostableController
{
    protected $category;
    protected $client;
    protected $permalink;

    public function __construct(Model $model, ProjectCategory $category, Client $client, $base = 'project')
    {
        parent::__construct($model, $base);

        $this->unsortables = array_merge($this->unsortables, ['client', 'category']);

        $this->category = $category;
        $this->client = $client;

        $this->formLeftWidth = 2;
        $this->breadcrumb2Icon  = 'files-o';
        $this->fields           = array_merge($this->model->getFields(), ['category' => 'Category', 'client' => 'Client']);
        
        $this->view->share();
    }

    protected function processDatatables($datatables)
    {
        $datatables = parent::processDatatables($datatables);
        
        return $datatables
            ->addColumn('category', function ($data) {
                return dataImplode($data->categories, 'category');
            })
            ->addColumn('client', function ($data) {
                return $data->client->name;
            });
    }

    protected function loadFormClasses($model)
    {
        $this->categories   = $this->category->pluck('category', 'id')->toArray();
        $this->client       = $this->client->pluck('name', 'id')->toArray();
        
        parent::loadFormClasses($model);
    }

    protected function processRequest($request)
    {
        $client_id = $request->get('client', null);

        $request->merge(compact('client_id'));

        return parent::processRequest($request);
    }

    protected function afterSaving($request)
    {
        $this->model->categories()->sync($request->get('categories', []));

        return parent::afterSaving($request);
    }
}
