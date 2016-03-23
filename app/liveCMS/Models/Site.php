<?php

namespace App\liveCMS\Models;

use Schema;
use App\liveCMS\Models\Users\User;
use App\liveCMS\Models\GenericSetting as Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Site extends Model
{
    protected static $current;
    
    protected static $host;
    
    protected static $domain;

    protected $fillable = ['subdomain', 'subfolder'];


    public static function init()
    {
        if (!Schema::hasTable('sites')) {
            return static::setCurrent(new Site);
        };
        
        static::$domain = $domain = config('livecms.domain');

        static::$host = $host = request()->server('HTTP_HOST');

        if (false === strpos($host, $domain) && !request()) {
            
            throw new \Exception('Anda harus men-set konfigurasi domain '.$domain);
        }

        $subdomain = rtrim(substr($host, 0, (strlen($host) - strlen($domain))), '.');

        $subfolder = request()->segment(1);

        if ($subdomain) {
            
            $findSites = static::where('subdomain', $subdomain)->get();

            if (($siteCount = count($findSites)) > 1) {

                $site = $findSites->where('subfolder', $subfolder)->first();

                if ($site) {
                    
                    return static::setCurrent($site);
                }
            }

            if ($siteCount) {
                
                $site = $findSites->first();

                return static::setCurrent($site);
            }

            return static::setCurrent(new Site);   
        }

        return static::setCurrent(new Site);
    }

    public static function setCurrent($current)
    {
        static::$current = $current;
    }

    public function getCurrent()
    {
        return static::$current;
    }

    public function getHost()
    {
        return static::$host;
    }

    public function getRootUrl()
    {
        $start = Str::startsWith(request()->root(), 'http://') ? 'http://' : 'https://';
        $subDomain = $this->subdomain ? $this->subdomain.'.' : '';
        $subFolder = $this->subfolder ? '/'.$this->subfolder : '';
        return $start.$subDomain.$this->getDomain().$subFolder;
    }

    public function getPath()
    {
        return request()->path();
    }

    public function getDomain()
    {
        return static::$domain;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function settings()
    {
        return $this->hasMany(Setting::class);
    }
}
