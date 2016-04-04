    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('title', trans('livecms.title'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('title', $model->title, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('slug', trans('livecms.slug'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('slug', $model->slug, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('url', trans('livecms.url'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            <p class="form-static"><a href="{{$url = $model->url}}">{{$url}}</a></p>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('permalink', trans('livecms.permalink'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::text('permalink', $model->permalink ? $model->permalink->permalink : '', ['class' => 'form-control', 'placeholder' => url('path/sebagai/permalink')]) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('content', trans('livecms.content'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            {!! Form::textarea('content', $model->content, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-2">
            {!! Form::label('picture', trans('livecms.picture'), ['class' => 'control-label']) !!}
        </div>
        <div class="col-md-10">
            @if ($picture = $model->picture)
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    Preview :
                    <figure style="width: 100%;">
                        <img src="{{ $picture }}" class="img-responsive" alt="">
                    </figure>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                @if ($picture = $model->picture)
                    <strong>{{trans('backend.ifwanttochangepicture')}}</strong>
                @endif
                    {!! Form::file('picture', null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>