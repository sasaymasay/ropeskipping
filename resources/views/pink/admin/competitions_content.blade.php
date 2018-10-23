<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Соревнования</h3>


        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>ID</th>
                <th>Название</th>
                <th>Информация</th>
                <th>Город</th>
                <th>Адрес</th>
                <th>Место</th>
                <th>Псевдоним</th>
                <th>Действие</th>

                </thead>
                @if($competitions)


                @foreach($competitions as $competition)

                <tr>
                    <td>{{ $competition->id }}</td>
                    <td>{!! Html::link(route('admin.comps.edit',['competitions' => $competition->id]),$competition->title) !!}</td>
                    <td>{{ str_limit($competition->info,100) }}</td>
                    <td>{{ $competition->city }}</td>
                    <td>{{ $competition->adress }}</td>
                    <td>{{ $competition->place }}</td>
                    <td>{{ $competition->alias }}</td>
                    <td>
                        {!! Form::open(['url' => route('admin.comps.destroy',['competitions'=> $competition->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>	
                
                @endforeach

                @endif
            </table>
        </div>
        
        
        {!! Html::link(route('admin.comps.create'),'Добавить соревнования',['class' => 'btn btn-the-salmon-dance-3']) !!}

    </div>
</div>


