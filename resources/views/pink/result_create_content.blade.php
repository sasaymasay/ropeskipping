 @if(count($errors) > 0)
    <div class ="box error-box">
        @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach    
    </div>
    @endif
    @if(session('status'))
    <div class="box success-box">
        {{ session('status') }}
    </div>
    @endif
    @if(session('error'))
    <div class="box error-box">
        {{ session('error') }}
    </div>
    @endif
<div id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($result->user->name)) ? route('signup.update',['result'=>$result->id]) :route('signup.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Соревнование:</span>
                    <br />
                    <span class="sublabel">Соревнование</span><br />
                </label>
                <div class="input-prepend">
                    {!! Form::select('competition_id', $competitions, (isset($result)) ? $result->competition()->first()->id  : null) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Группа:</span>
                    <br />
                    <span class="sublabel">Группа</span><br />
                </label>
                <div class="input-prepend">
                    
                    {!! Form::select('group_id', $groups, (isset($result)) ? $result->group()->first()->id : null) !!}
                </div>

            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Дисциплина:</span>
                    <br />
                    <span class="sublabel">Дисциплина</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('discipline_id', $disciplines, (isset($result)) ? $result->discipline()->first()->id : null) !!}
                </div>

            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Пол:</span>
                    <br />
                    <span class="sublabel">Пол</span><br />
                </label>
                <div  class="input-prepend">

                    {!! Form::select('gender_id', $genders, (isset($result)) ? $result->gender()->first()->id : null) !!}
                </div>

            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Возрастная категория:</span>
                    <br />
                    <span class="sublabel">Возрастная категория</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('age_id', $ages, (isset($result)) ? $result->age()->first()->id : null) !!}
                </div>

            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ранг:</span>
                    <br />
                    <span class="sublabel">Ранг</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('rank_id', $ranks, (isset($result)) ? $result->rank()->first()->id : null) !!}
                </div>

            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Команда:</span>
                    <br />
                    <span class="sublabel">Введите членов команды</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('team_members',isset($result) ? $result->team_members  : old('team_members'), ['placeholder'=>'Введите членов команды']) !!}
                </div>
            </li>







            @if(isset($result->id))
            <input type="hidden" name="_method" value="PUT">		

            @endif

            <li class="submit-button"> 
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
            </li>
            

       
 </div>
    
 </div>

        </ul>

        {!! Form::close() !!}



    </div>
</div>

