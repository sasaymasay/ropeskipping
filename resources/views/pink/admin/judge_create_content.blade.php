<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($judge->id)) ? route('admin.judges.update',['judges'=>$judge->id]) :route('admin.judges.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Имя:</span>
                    <br />
                    <span class="sublabel">Имя</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('name',isset($judge->name) ? $judge->name  : old('name'), ['placeholder'=>'Введите имя судьи']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Фамилия:</span>
                    <br />
                    <span class="sublabel">Фамилия</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('surname',isset($judge->surname) ? $judge->surname  : old('surname'), ['placeholder'=>'Введите фамилию судьи']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Отчество:</span>
                    <br />
                    <span class="sublabel">Отчество</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('patronymic',isset($judge->patronymic) ? $judge->patronymic  : old('patronymic'), ['placeholder'=>'Введите отчество судьи']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Город:</span>
                    <br />
                    <span class="sublabel">Город</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('city',isset($judge->city) ? $judge->city  : old('city'), ['placeholder'=>'Введите город судьи']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ранг:</span>
                    <br />
                    <span class="sublabel">Ранг</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('rank',isset($judge->rank) ? $judge->rank  : old('rank'), ['placeholder'=>'Введите ранг судьи']) !!}
                </div>
            </li>




            @if(isset($judge->id))
            <input type="hidden" name="_method" value="PUT">		

            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
            </li>

        </ul>

        {!! Form::close() !!}

    </div>
</div>
