<?php

namespace App\liveCMS\Models;

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

    public function newQuery()
    {
        return parent::newQuery()->with($this->dependencies());
    }

    protected function buildFields()
    {
        return array_flip(array_except(array_flip($this->getFillable()), $this->getHidden()));
    }

    public function snakeToStr($snake)
    {
        return snakeToStr($snake);
    }
}
