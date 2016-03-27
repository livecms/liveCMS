<?php

namespace App\liveCMS\Models\Traits;

use App\Models\Site;

trait BaseModelTrait
{
    public function dependencies()
    {
        return $this->dependencies;
    }

    public function rules()
    {
        return $this->rules;
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
        return array_flip(array_except(array_flip($this->getFillable()), $this->getHidden()));
    }

    public function snakeToStr($snake)
    {
        return snakeToStr($snake);
    }

    public function newQuery()
    {
        $query = parent::newQuery();

        return $query->where('site_id', site()->getCurrent()->id);
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
}
