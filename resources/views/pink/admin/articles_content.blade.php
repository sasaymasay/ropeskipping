@if($articles)
<div id="content-page" class="content-group">
    <div class="hentry-group">
        <h2>Добавленные записи</h2>
        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="align-left">ID</th>
                        <th>Заголовок</th>
                        <th>Текст</th>
                        <th>Изображение</th>
                        <th>Псевдоним</th>
                        <th>Кем добавлена</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td class="aligh-left">{{ $article->id }}</td>
                        <td class="aligh-left">{!! Html::link(route('admin.articless.edit',['articless'=>$article->alias]),$article->title) !!}</td>
                        <td class="aligh-left">{{ str_limit($article->text,200) }}</td>
                        <td>
                            @if(isset($article->img->mini))
                            {!! Html::image(asset(env('THEME')).'/images/articles/'.$article->img->mini)!!}
                            @endif
                        </td>
                        <td>{{ $article->alias }}</td>
                        <td>{{ $article->user->name }}</td>
                        <td>
                            {!! Form::open(['url'=>route('admin.articless.destroy',['articless'=>$article->alias]),'class'=>'form-horizontal','method'=>'POST']) !!}
                                {{ method_field('DELETE') }}
                                {!! Form::button('Удалить', ['class'=>'btn btn-french-5','type'=>'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! Html::link(route('admin.articless.create'),'Добавить новость', ['class'=>'btn btn-the-salmon-dance-3','type'=>'button']) !!}
    </div>
</div>
@endif