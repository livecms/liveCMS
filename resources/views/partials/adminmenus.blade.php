<!-- Optionally, you can add icons to the links -->
<li class="@if(request()->is('admin'))active @endif"><a href="{{ asset('admin') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
<li class="@if(request()->is('admin/kategori*') || request()->is('admin/tag*') || request()->is('admin/artikel*'))active @endif treeview">
    <a href="#"><i class="fa fa-pencil"></i> <span>Tulisan</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="@if(request()->is('admin/artikel*'))active @endif"><a href="{{ asset('admin/artikel') }}"><i class="fa fa-file-o"></i> <span>Artikel</span></a></li>
        <li class="@if(request()->is('admin/kategori*'))active @endif"><a href="{{ asset('admin/kategori') }}"><i class="fa fa-list"></i> <span>Kategori</span></a></li>
        <li class="@if(request()->is('admin/tag*'))active @endif"><a href="{{ asset('admin/tag') }}"><i class="fa fa-tag"></i> <span>Tag</span></a></li>
    </ul>
</li>
<li class="@if(request()->is('admin/staticpage*'))active @endif"><a href="{{ asset('admin/staticpage') }}"><i class="fa fa-files-o"></i> <span>Halaman Statis</span></a></li>
<li class="@if(request()->is('admin/user*'))active @endif"><a href="{{ asset('admin/user') }}"><i class="fa fa-users"></i> <span>User</span></a></li>
<li class="@if(request()->is('admin/setting*'))active @endif"><a href="{{ asset('admin/setting') }}"><i class="fa fa-cog"></i> <span>Setting</span></a></li>
<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>