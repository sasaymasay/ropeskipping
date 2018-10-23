<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Судьи</h3>


        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Отчество</th>
                <th>Город</th>
                <th>Ранк</th>
                <th>Действия</th>
                </thead>
                @if($judges)


                @foreach($judges as $judge)

                <tr>
                    <td>{{ $judge->id }}</td>
                    <td>{!! Html::link(route('admin.judges.edit',['judges' => $judge->id]),$judge->name) !!}</td>
                    <td>{!! Html::link(route('admin.judges.edit',['judges' => $judge->id]),$judge->surname) !!}</td>
                    <td>{!! Html::link(route('admin.judges.edit',['judges' => $judge->id]),$judge->patronymic) !!}</td>
                    <td>{{ $judge->city }}</td>
                    <td>{{ $judge->rank }}</td>



                    <td>
                        {!! Form::open(['url' => route('admin.judges.destroy',['judges'=> $judge->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>	
                
                @endforeach

                @endif
            </table>
        </div>
        {!! Html::link(route('admin.judges.create'),'Добавить пользователя',['class' => 'btn btn-the-salmon-dance-3']) !!}

    </div></div>

