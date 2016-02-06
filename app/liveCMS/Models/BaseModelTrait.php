<?php

namespace App\liveCMS\Models;

use Illuminate\Auth\Access\AuthorizationException;

trait BaseModelTrait
{
    public static function bootBaseModelTrait()
    {
        if (app(static::class)->authorize('read') === false) {
            throw new AuthorizationException('This action is unauthorized.');
        }

        static::creating(function ($model) {
            if ($model->authorize('create') === false) {
                throw new AuthorizationException('This action is unauthorized.');
            }
        });

        static::updating(function ($model) {
            if ($model->authorize('update') === false) {
                throw new AuthorizationException('This action is unauthorized.');
            }
        });

        static::deleting(function ($model) {
            if ($model->authorize('delete') === false) {
                throw new AuthorizationException('This action is unauthorized.');
            }
        });
    }

    public function authorize($method = null)
    {
        return true;
    }

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
            $theFields[$field] = isset($alias[$field]) ?  $alias[$field] : $this->snakeToStr($field);
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
        return ucwords(implode(' ', explode('_', $snake)));
    }
}
