<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($user->id)) ? route('admin.users.update',['users'=>$user->id]) :route('admin.users.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Имя:</span>
                    <br />
                    <span class="sublabel">Имя</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('name',isset($user->name) ? $user->name  : old('name'), ['placeholder'=>'Введите имя пользователя']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Фамилия:</span>
                    <br />
                    <span class="sublabel">Фамилия</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('surname',isset($user->surname) ? $user->surname  : old('surname'), ['placeholder'=>'Введите фамилию пользователя']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Отчество:</span>
                    <br />
                    <span class="sublabel">Отчество</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('patronymic',isset($user->patronymic) ? $user->patronymic  : old('patronymic'), ['placeholder'=>'Введите отчество пользователя']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Страна:</span>
                    <br />
                    <span class="sublabel">Страна</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('country',isset($user->country) ? $user->country  : old('country'), ['placeholder'=>'Введите отчество пользователя']) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Город:</span>
                    <br />
                    <span class="sublabel">Город</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('city',isset($user->city) ? $user->city  : old('city'), ['placeholder'=>'Введите город проживания']) !!}
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Email:</span>
                    <br />
                    <span class="sublabel">Email</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('email',isset($user->email) ? $user->email  : old('email'), ['placeholder'=>'Введите email пользователя']) !!}
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Пароль:</span>
                    <br />
                    <span class="sublabel">Пароль</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::password('password') !!}
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Повтор пароля:</span>
                    <br />
                    <span class="sublabel">Повтор пароля</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::password('password_confirmation') !!}
                </div>
            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ранг:</span>
                    <br />
                    <span class="sublabel">Ранг</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('rank_id', $ranks, (isset($user)) ? $user->rank()->first()->id : null) !!}
                </div>

            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Пол:</span>
                    <br />
                    <span class="sublabel">Пол</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('gander_id', $genders, (isset($user)) ? $user->gender()->first()->id : null) !!}
                </div>

            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Роль:</span>
                    <br />
                    <span class="sublabel">Роль</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('role_id', $roles, (isset($user)) ? $user->roles()->first()->id : null) !!}
                </div>

            </li>	
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Возрастная группа:</span>
                    <br />
                    <span class="sublabel">Возрастная группа</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('age_id', $ages, (isset($user)) ? $user->age()->first()->id : null) !!}
                </div>

            </li>	





            @if(isset($user->id))
            <input type="hidden" name="_method" value="PUT">		

            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
            </li>

        </ul>

        {!! Form::close() !!}

    </div>
</div>