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

    public function useAuthorization()
    {
        return $this->useAuthorization;
    }

    protected function firstAuthorization()
    {
        if (static::$usePolicy && auth()->check()) {

            if ($this->useAuthorization) {

                Gate::authorize('access', $this);
            }
        }
    }

    public function selfPost($bool = true)
    {
        $this->selfPost = $bool;
        return $this;
    }

    public function newQuery()
    {
        $this->firstAuthorization();

        $query = parent::newQuery()->with($this->dependencies());

        if (auth()->check() && $this->selfPost) {
            $query = $query->where('author_id', auth()->user()->id);
        }

        if ($this->allSites) {
            return $query;
        }

        return $query->where('site_id', site()->getCurrent()->id);
    }

    public function scopeWithDependencies($query)
    {
        return $query->with($this->dependencies());
    }

    public function save(array $options = [])
    {
        if (!$this->allSites) {
            $this->site_id = site()->id;
        }

        return parent::save($options);
    }

    public function setAllSites($value)
    {
        $this->allSites = $value;

        return $this;
    }

    protected function slugify($field, $target = 'slug')
    {
        $request = request();

        $slug = str_slug($request->has($target) ? $request->get($target) : $request->get($field));

        $request->merge([$target => $slug]);
    }

    protected function uniqify($field, $additional = 'required')
    {
        $id = $this->id == null ? 'NULL' : $this->id;
        
        $rules = $additional.'|unique:'.$this->getTable().','.$field.','.$id;
            
        if ($this->allSites) {
            return $rules;
        }

        $siteId = site()->id == null ? 'NULL' : site()->id;
        
        return $rules.',id,site_id,'.$siteId;
    }

    protected function validPrivilege($field)
    {
        if (!($privilege = request()->get($field, null))) {
            return 'required';
        }

        if (! \Hash::check($privilege, auth()->user()->password)) {

            $userPasswordField = trans('livecms.yourpassword');

            $privilege = [$userPasswordField => ''];

            request()->merge($privilege);

            return 'same:'.$userPasswordField;
        }

        return 'required';
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
        return $this->author_id && $this->author_id == $user->id;
    }
}
