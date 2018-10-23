<div id="content-page" class="content group">
    <div class="hentry group">
        <h3 class="title_page">Группы</h3>


        <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>ID</th>
                <th>Название</th>
                <th>Действие</th>

                </thead>
                @if($groups)


                @foreach($groups as $group)

                <tr>
                    <td>{{ $group->id }}</td>
                    <td>{!! Html::link(route('admin.groups.edit',['groups' => $group->id]),$group->name) !!}</td>
                    <td>
                        {!! Form::open(['url' => route('admin.groups.destroy',['groups'=> $group->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Удалить', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>	
                
                @endforeach

                @endif
            </table>
        </div>
        {!! Html::link(route('admin.groups.create'),'Добавить группу',['class' => 'btn btn-the-salmon-dance-3']) !!}

    </div></div>