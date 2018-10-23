<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($discipline->id)) ? route('admin.disc.update',['discipline'=>$discipline->id]) :route('admin.disc.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Название:</span>
                    <br />
                    <span class="sublabel">Название</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('name',isset($discipline->name) ? $discipline->name  : old('name'), ['placeholder'=>'Введите название дисциплины']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Описание:</span>
                    <br />
                    <span class="sublabel">Описание</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('discription',isset($discipline->discription) ? $discipline->discription  : old('discription'), ['placeholder'=>'Введите описание дисциплины']) !!}
                </div>
            </li>
            
             <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Группа:</span>
                    <br />
                    <span class="sublabel">Группа</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('group_id', $groups, (isset($discipline)) ? $discipline->group()->first()->id : null) !!}
                </div>

            </li>
            
            @if(isset($discipline->id))
            <input type="hidden" name="_method" value="PUT">		

            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
            </li>

        </ul>

        {!! Form::close() !!}

    </div>
</div>
