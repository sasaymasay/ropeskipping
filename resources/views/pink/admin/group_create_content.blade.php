<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($group->id)) ? route('admin.groups.update',['group'=>$group->id]) :route('admin.groups.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Название:</span>
                    <br />
                    <span class="sublabel">Название</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('name',isset($group->name) ? $group->name  : old('name'), ['placeholder'=>'Введите название группы']) !!}
                </div>
            </li>
            
            @if(isset($group->id))
            <input type="hidden" name="_method" value="PUT">		

            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
            </li>

        </ul>

        {!! Form::close() !!}

    </div>
</div>
