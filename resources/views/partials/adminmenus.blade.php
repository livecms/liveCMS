<?php
$adminSlug              = globalParams('slug_admin', config('livecms.slugs.admin'));
$articleSlug            = globalParams('slug_article', config('livecms.slugs.article'));
$categorySlug           = globalParams('slug_category', config('livecms.slugs.category'));
$tagSlug                = globalParams('slug_tag', config('livecms.slugs.tag'));
$staticpageSlug         = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));
$teamSlug               = globalParams('slug_team', config('livecms.slugs.team'));
$gallerySlug            = globalParams('slug_gallery', config('livecms.slugs.gallery'));
$projectSlug            = globalParams('slug_project', config('livecms.slugs.project'));
$clientSlug             = globalParams('slug_client', config('livecms.slugs.client'));
$projectCategorySlug    = globalParams('slug_projectcategory', config('livecms.slugs.projectcategory'));
$contactSlug            = globalParams('slug_contact', config('livecms.slugs.contact'));

$menus = [
    [   'title' => trans('livecms.post'), 'icon' => 'pencil',
        'uri' => [
            ['uri' => $articleSlug, 'title' => trans('livecms.article'), 'icon' => 'files-o'],
            ['uri' => $categorySlug, 'title' => trans('livecms.category'), 'icon' => 'list'],
            ['uri' => $tagSlug, 'title' => trans('livecms.tag'), 'icon' => 'tag'],
        ],
    ],
    [   'title' => trans('livecms.clientandproject'), 'icon' => 'briefcase',
        'uri' => [
            ['uri' => $clientSlug, 'title' => trans('livecms.client'), 'icon' => 'users'],
            ['uri' => $projectCategorySlug, 'title' => trans('livecms.projectcategory'), 'icon' => 'list'],
            ['uri' => $projectSlug, 'title' => trans('livecms.project'), 'icon' => 'briefcase'],
        ],
    ],
    ['uri' => $staticpageSlug, 'title' => trans('livecms.staticpage'), 'icon' => 'file-o'],
    ['uri' => $teamSlug, 'title' => trans('livecms.team'), 'icon' => 'user-plus'],
    ['uri' => $gallerySlug, 'title' => trans('livecms.gallery'), 'icon' => 'image'],
    ['uri' => 'permalink', 'title' => 'Permalink', 'icon' => 'link'],
    ['uri' => 'user', 'title' => trans('livecms.user'), 'icon' => 'users'],
    ['uri' => $contactSlug, 'title' => trans('livecms.contact'), 'icon' => 'phone'],
    ['uri' => 'setting', 'title' => 'Setting', 'icon' => 'cog'],
];
?>

<!-- Home -->
<li class="@if(isInCurrentRoute('admin.home'))active @endif"><a href="{{ url($adminSlug) }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
@foreach($menus as $menu)
@if(is_array($uri = $menu['uri']))
<?php
    $activeMenu = false;
    foreach (collect($uri)->pluck('uri')->toArray() as $uri) {
        $activeMenu = $activeMenu || isInCurrentRoute($adminSlug.'.'.$uri.'.index');
    }
?>
    <li class="@if($activeMenu) active @endif treeview">
        <a href="#"><i class="fa fa-{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
        @foreach($menu['uri'] as $subMenu)
            <li class="@if(isInCurrentRoute($menuLink = $adminSlug.'.'.$subMenu['uri'].'.index'))active @endif"><a href="{{ route($menuLink) }}"><i class="fa fa-{{$subMenu['icon']}}"></i> <span>{{$subMenu['title']}}</span></a></li>
        @endforeach
    </ul>
@else
    <li class="@if(isInCurrentRoute($menuLink = $adminSlug.'.'.$menu['uri'].'.index'))active @endif"><a href="{{ route($menuLink) }}"><i class="fa fa-{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span></a></li>
@endif
@endforeach