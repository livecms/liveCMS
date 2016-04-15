<?php

namespace App\liveCMS\Models\Traits;

use App\Models\Site;
use Gate;

trait BaseModelTrait
{
    protected static $usePolicy = true;

    public function dependencies()
    {
        return $this->dependencies;
    }

    public function rules()
    {
        return $this->rules;
    }

    public function exceptFields()
    {
        return (array) $this->excepts;
    }

    public function mergeBeforeFields()
    {
        return (array) $this->mergesBefore;
    }

    public function mergeAfterFields()
    {
        return (array) $this->mergesAfter;
    }

    public function getFields()
    {
        $fields = $this->buildFields();

        $alias = $this->aliases;

        $theFields = [];

        foreach ($fields as $field) {
            $theFields[$field] = isset($alias[$field]) ?  $alias[$field] : title_case($this->snakeToStr($field));
        }

        $keyName = $this->getKeyName();

        return (! array_key_exists($keyName, $theFields)) ? [$keyName => $this->snakeToStr($keyName)] + $theFields : $theFields;

    }

    protected function buildFields()
    {
        $fillable = array_flip($this->getFillable());

        $fields = array_merge($this->mergeBeforeFields(), array_except($fillable, $this->exceptFields()), $this->mergeAfterFields());
        
        return array_flip(array_except($fields, $this->getHidden()));
    }

    public function snakeToStr($snake)
    {
        return snakeToStr($snake);
    }

    public function turnOnPolicy()
    {
        static::$usePolicy = true;
    }

    public function turnOffPolicy()
    {
        static::$usePolicy = false;
    }

    public function newQuery()
    {
        if (static::$usePolicy && auth()->check()) {

            Gate::authorize('access', $this);
        }

        $query = parent::newQuery();

        return $query->where('site_id', site()->getCurrent()->id);
    }

    public function scopeWithDependencies($query)
    {
        return $query->with($this->dependencies());
    }

    public function save(array $options = [])
    {
        $this->site_id = site()->id;

        return parent::save($options);
    }

    protected function slugify($field)
    {
        $request = request();

        $slug = str_slug($request->has('slug') ? $request->get('slug') : $request->get($field));

        $request->merge(compact('slug'));
    }

    protected function uniqify($field)
    {
        $id = $this->id == null ? 'NULL' : $this->id;
        $siteId = site()->id == null ? 'NULL' : site()->id;
        return 'required|unique:'.$this->getTable().','.$field.','.$id.',id,site_id,'.$siteId;
    }

    public function allowsUserAccess($user)
    {
        return true;
    }

    public function allowsUserRead($user)
    {
        return true;
    }

    public function allowsUserCreate($user)
    {
        return true;
    }

    public function allowsUserUpdate($user)
    {
        return true;   
    }

    public function allowsUserDelete($user)
    {
        return true;
    }
}
