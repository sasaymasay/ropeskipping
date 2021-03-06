<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Результат</h3>
        

        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>ID</th>
                <th>Пользователь</th>
                <th>Соревнование</th>
                <th>Группа</th>
                <th>Дисциплина</th>
                <th>Ранк</th>
                <th>Пол</th>
                <th>Возраст</th>
                <th>Счет</th>

                <th>Члены команды</th>

                <th>Действие</th>

                </thead>
                @if($results)


              
                
                @foreach($results as $result)
                
                

                <tr>
                   @if(Auth::user()->id === $result->user_id)
                    <td>{!! Html::link(route('signup.edit',['results' => $result->id]),$result->id) !!}</td>
                    <td>{{ $result->user->name}}</td>
                    <td>{{ $result->competition->title}}</td>
                    <td>{{ $result->group->name}}</td>
                    <td>{{ $result->discipline->name}}</td>
                    <td>{{ $result->rank->name}}</td>
                    <td>{{ $result->gender->name}}</td>
                    <td>{{ $result->age->choices}}</td>
                    <td>{{ $result->final_score}}</td>

                    <td>{{ $result->team_members}}</td>

                    <td>
                        {!! Form::open(['url' => route('signup.destroy',['results'=> $result->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                        {!! Form::close() !!}

                    </td>

                </tr>	
                @endif
                
                @endforeach

                @endif
            </table>
        </div>
        {!! Html::link(route('signup.create'),'Зарегистрироватсья на соревновании',['class' => 'btn btn-the-salmon-dance-3']) !!}

    </div></div>




