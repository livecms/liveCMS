<?php
$adminPrefix = globalParams('slug_admin', config('livecms.slugs.admin'));

$menus = [
    [   'title' => 'Tulisan', 'icon' => 'pencil',
        'uri' => [
            ['uri' => 'artikel', 'title' => 'Artikel', 'icon' => 'files-o'],
            ['uri' => 'kategori', 'title' => 'Kategori', 'icon' => 'list'],
            ['uri' => 'tag', 'title' => 'Tag', 'icon' => 'tag'],
        ],
    ], 
    ['uri' => 'staticpage', 'title' => 'Halaman Statis', 'icon' => 'file-o'],
    ['uri' => 'user', 'title' => 'User', 'icon' => 'users'],
    ['uri' => 'user', 'title' => 'User', 'icon' => 'users'],
];
?>

<!-- Home -->
<li class="@if(request()->is($adminPrefix))active @endif"><a href="{{ asset($adminPrefix) }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
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
            <li class="@if(request()->is(($menuLink = $adminPrefix.'/'.$subMenu['uri']).'*'))active @endif"><a href="{{ asset($menuLink) }}"><i class="fa fa-{{$subMenu['icon']}}"></i> <span>{{$subMenu['title']}}</span></a></li>
        @endforeach
    </ul>
@else
    <li class="@if(request()->is(($menuLink = $adminPrefix.'/'.$menu['uri']).'*'))active @endif"><a href="{{ asset($menuLink) }}"><i class="fa fa-{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span></a></li>
@endif
@endforeach