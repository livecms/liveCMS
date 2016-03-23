<?php
$adminPrefix = globalParams('slug_admin', config('livecms.slugs.admin'));
$articleSlug = globalParams('slug_article', config('livecms.slugs.article'));
$staticpageSlug = globalParams('slug_staticpage', config('livecms.slugs.staticpage'));

$menus = [
    [   'title' => 'Post', 'icon' => 'pencil',
        'uri' => [
            ['uri' => $articleSlug, 'title' => 'Article', 'icon' => 'files-o'],
            ['uri' => 'category', 'title' => 'Category', 'icon' => 'list'],
            ['uri' => 'tag', 'title' => 'Tag', 'icon' => 'tag'],
        ],
    ],
    ['uri' => $staticpageSlug, 'title' => 'Static Page', 'icon' => 'file-o'],
    ['uri' => 'permalink', 'title' => 'Permalink', 'icon' => 'link'],
    ['uri' => 'user', 'title' => 'User', 'icon' => 'users'],
    ['uri' => 'setting', 'title' => 'Setting', 'icon' => 'cog'],
];
?>

<!-- Home -->
<li class="@if(request()->is($adminPrefix))active @endif"><a href="{{ url($adminPrefix) }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
@foreach($menus as $menu)
@if(is_array($uri = $menu['uri']))
<?php
    $activeMenu = false;
    foreach (collect($uri)->pluck('uri')->toArray() as $uri) {
        $activeMenu = $activeMenu || request()->is($adminPrefix.'/'.$uri.'*');
    }
?>
    <li class="@if($activeMenu) active @endif treeview">
        <a href="#"><i class="fa fa-{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
        @foreach($menu['uri'] as $subMenu)
            <li class="@if(request()->is(($menuLink = $adminPrefix.'/'.$subMenu['uri']).'*'))active @endif"><a href="{{ url($menuLink) }}"><i class="fa fa-{{$subMenu['icon']}}"></i> <span>{{$subMenu['title']}}</span></a></li>
        @endforeach
    </ul>
@else
    <li class="@if(request()->is(($menuLink = $adminPrefix.'/'.$menu['uri']).'*'))active @endif"><a href="{{ url($menuLink) }}"><i class="fa fa-{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span></a></li>
@endif
@endforeach