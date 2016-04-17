<?php

namespace App\liveCMS\Models;

use Validator;
use App\liveCMS\Models\Contracts\BaseModelInterface as BaseModelContract;
use App\liveCMS\Models\Traits\BaseModelTrait;
use App\liveCMS\Models\Traits\ModelAuthorizationTrait;
use App\liveCMS\Models\Traits\SuperModelTrait;

class SiteModel extends Site implements BaseModelContract
{
    use BaseModelTrait, ModelAuthorizationTrait, SuperModelTrait {
        SuperModelTrait::allowsUserAccess insteadof BaseModelTrait;
        SuperModelTrait::allowsUserRead insteadof BaseModelTrait;
        SuperModelTrait::allowsUserCreate insteadof BaseModelTrait;
        SuperModelTrait::allowsUserUpdate insteadof BaseModelTrait;
        SuperModelTrait::allowsUserDelete insteadof BaseModelTrait;
    }

    protected $table = 'sites';

    protected $aliases = ['site' => 'sitename'];

    protected $dependencies = ['admins'];

    protected $useAuthorization = false;
    // protected $appends = ['type'];

    public function users()
    {
        return $this->hasMany(User::class, 'site_id');
    }

    public function admins()
    {
        return $this->users()->whereHas('roles', function ($query) {
            $query->where('role', 'admin');
        });
    }

    public function rules()
    {
        $this->slugify('subdomain', 'subdomain');
        $this->slugify('subfolder', 'subfolder');

        $request = request()->all();

        $emailRules = 'required|email';

        $useEmail = request()->isMethod('post');

        if (isset($request['emails'])) {

            foreach ($request['emails'] as $key => $email) {
                $validator = Validator::make(compact('email'), ['email' => $emailRules]);
                if ($validator->fails()) {
                    request()->merge(compact('email'));
                    $useEmail = true;
                    break;
                }
            }
        }

        return [
            'sitename' => 'required|'.$this->uniqify('site'),
            'subdomain' => 'required_without:subfolder|'.$this->uniqify('subdomain', ''),
            'subfolder' => 'required_without:subdomain|'.$this->uniqify('subfolder', ''),
            'email' => $useEmail ? $emailRules : '',
            'passwordprivilege' => request()->isMethod('post') ? '' : $this->validPrivilege('passwordprivilege'),
        ];
    }

    public function newQuery()
    {
        $this->firstAuthorization();

        return parent::newQuery()->with($this->dependencies());
    }

    public function save(array $options = [])
    {
        return parent::save($options);
    }
}
