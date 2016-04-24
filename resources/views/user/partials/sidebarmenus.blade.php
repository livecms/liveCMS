<?php
$userSlug               = globalParams('slug_userhome', config('livecms.slugs.userhome'));
$profileSlug            = globalParams('slug_profile', config('livecms.slugs.profile'));
$articleSlug            = globalParams('slug_article', config('livecms.slugs.article'));
$menus = [
    ['uri' => $profileSlug, 'title' => trans('livecms.profile'), 'icon' => 'user'],
    ['uri' => $articleSlug, 'title' => trans('livecms.article'), 'icon' => 'pencil'],
];
?>

<?php
$subfolderPrefix = site()->subfolder;
$subfolderPrefix = $subfolderPrefix ? $subfolderPrefix.'.' : $subfolderPrefix;
?>

<!-- Home -->
@foreach($menus as $menu)
@if(is_array($uri = $menu['uri']))
<?php
    $activeMenu = false;
    $canReadMenu = false;
    foreach (collect($uri)->pluck('uri')->toArray() as $uri) {
        $activeMenu = $activeMenu || isInCurrentRoute($subfolderPrefix.$userSlug.'.'.$uri.'.');
        $canReadMenu = $canReadMenu || canRead($subfolderPrefix.$userSlug.'.'.$uri.'.index');
    }
?>
    @if ($canReadMenu)
    <li class="@if($activeMenu) active @endif treeview">
        <a href="#"><i class="fa fa-{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
        @foreach($menu['uri'] as $subMenu)
            @if (canRead($menuUrl = ($menuLink = $subfolderPrefix.$userSlug.'.'.$subMenu['uri'].'.').'index'))
            <li class="@if(isInCurrentRoute($menuLink))active @endif"><a href="{{ route($menuUrl) }}"><i class="fa fa-{{$subMenu['icon']}}"></i> <span>{{$subMenu['title']}}</span></a></li>
            @endif
        @endforeach
    </ul>
    @endif
@else
    @if (canRead($menuUrl = ($menuLink = $subfolderPrefix.$userSlug.'.'.$menu['uri'].'.').'index'))
    <li class="@if(isInCurrentRoute($menuLink))active @endif"><a href="{{ route($menuUrl) }}"><i class="fa fa-{{$menu['icon']}}"></i> <span>{{$menu['title']}}</span></a></li>
    @endif
@endif
@endforeach

@if (auth()->user()->is_administer)
<li class="@if(isInCurrentRoute('admin.home'))active @endif"><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> <span>{{trans('livecms.dashboard')}}</span></a></li>
@endif