<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Пользователи</h3>

        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>ID</th>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Email</th>
                <th>Роль</th>
                <th>Страна</th>
                <th>Город</th>
                <th>Ранг</th>
                <th>Пол</th>
                <th>Возрастная группа</th>
                <th>Действия</th>
                </thead>
                @if($users)


                @foreach($users as $user)

                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{!! Html::link(route('admin.users.edit',['users' => $user->id]),$user->name) !!}</td>
                    <td>{!! Html::link(route('admin.users.edit',['users' => $user->id]),$user->surname) !!}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->implode('name', ', ') }}</td>
                    <td>{{ $user->country }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->rank->name }}</td>
                    <td>{{ $user->gender->name }}</td>
                    <td>{{ $user->age->choices }}</td>



                    <td>
                        {!! Form::open(['url' => route('admin.users.destroy',['users'=> $user->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>	
                
                @endforeach

                @endif
            </table>
        </div>
        {!! Html::link(route('admin.users.create'),'Добавить пользователя',['class' => 'btn btn-the-salmon-dance-3']) !!}

    </div></div>
