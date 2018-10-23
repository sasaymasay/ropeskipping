<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Дисциплины</h3>


        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Группа</th>
                <th>Действие</th>

                </thead>
                @if($disciplines)


                @foreach($disciplines as $discipline)

                <tr>
                    <td>{{ $discipline->id }}</td>
                    <td>{!! Html::link(route('admin.disc.edit',['disciplines' => $discipline->id]),$discipline->name) !!}</td>
                    <td>{{ $discipline->discription }}</td>
                    <td>{{ $discipline->group->name }}</td>
                    <td>
                        {!! Form::open(['url' => route('admin.disc.destroy',['disciplines'=> $discipline->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>	
                
                @endforeach

                @endif
            </table>
        </div>
        {!! Html::link(route('admin.disc.create'),'Добавить дисциплину',['class' => 'btn btn-the-salmon-dance-3']) !!}

    </div></div>

