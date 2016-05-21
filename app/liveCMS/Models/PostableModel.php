<?php

namespace App\liveCMS\Models;

use App\liveCMS\Models\Users\User as UserModel;
use App\liveCMS\Models\Traits\ImagableTrait;
use Carbon\Carbon;
use Mrofi\VideoInfo\VideoInfo;
use Mrofi\VideoInfo\Youtube;
use Symfony\Component\DomCrawler\Crawler;

class PostableModel extends BaseModel
{
    use ImagableTrait;

    protected $fillable = ['title', 'site_id', 'slug', 'content', 'author_id', 'picture', 'published_at'];

    protected $appends = ['url', 'highlight'];

    protected $dependencies = ['permalink', 'author'];

    protected $dates = ['published_at'];

    protected $prefixSlug = '';

    protected $aliases = ['author_id' => 'Author'];

    protected static $picturePath = 'files';
 
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function rules()
    {
        $this->slugify('title');

        $published_at = $this->published_at ?: Carbon::now();

        $author_id = $this->author_id ?: auth()->user()->id;

        request()->merge(compact('published_at', 'author_id'));

        return [
            'title' => $this->uniqify('title'),
            'slug' => $this->uniqify('slug'),
            'content' => 'required',
            'picture' => 'image|max:5120',
            'published_at' => 'required',
        ];
    }

    public function author()
    {
        return $this->belongsTo(UserModel::class, 'author_id');
    }

    public function permalink()
    {
        return $this->morphOne(Permalink::class, 'postable');
    }

    public function children()
    {
        //
    }

    public function getUrlAttribute()
    {
        if ($this->permalink && $this->permalink->permalink) {

            return url($this->permalink->permalink);
        }

        if ($this->slug != null) {
            
            return url($this->prefixSlug.'/'.$this->slug);
        }

        return url($this->prefixSlug);
    }

    public function getPicturePath()
    {
        return static::$picturePath;
    }

    public function getPictureAttribute($picture)
    {
        return $picture ? asset($this->getPicturePath().'/'.$picture) : null;
    }

    public function getHighlightAttribute()
    {
        return str_limit(strip_tags($this->content), 300);
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getVideoContent()
    {
        if (! $this->content) {
            return null;
        }

        $crawler = new Crawler($this->content);
        // scan embeded
        Youtube::setApi(env('YOUTUBE_API'));
        $videos = $crawler->filter('iframe')->each(function (Crawler $node, $i) {
            $src = $node->attr('src');
            $video = new VideoInfo($src);
            if ($video && $video->id) {
                return $video->getVideo();
            }
        });

        return $videos;
    }
}
