@section('index.submenu')
    <div class="col-xs-6">
        <a href="{{ action($baseClass.'@index') }}" class="btn btn-sm btn-block btn-default @if (!request()->has('hierarchy')) active @endif ">@if (!request()->has('hierarchy')) <i class="fa fa-check"></i> @endif {{trans('backend.viewall')}}</a> 
    </div>
    <div class="col-xs-6">
        <a href="{{ action($baseClass.'@index', ['hierarchy' => 'true']) }}" class="btn btn-sm btn-block btn-default @if (request()->has('hierarchy')) active @endif ">@if (request()->has('hierarchy')) <i class="fa fa-check"></i> @endif {{trans('backend.viewhierarchy')}}</a> 
    </div>
@endsection