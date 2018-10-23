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

        {!! Form::open(['url' => (isset($result->id)) ? route('admin.scores.update',['result'=>$result->id]) :route('admin.scores.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Соревнование:</span>
                    <br />
                    <span class="sublabel">Соревнование</span><br />
                </label>
                <div class="input-prepend">
                    {!! Form::select('competition_id', $competitions, (isset($result->id)) ? $result->competition()->first()->id  : null) !!}
                </div>
            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Группа:</span>
                    <br />
                    <span class="sublabel">Группа</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('group_id', $groups, (isset($result->id)) ? $result->group()->first()->id : null) !!}
                </div>

            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Дисциплина:</span>
                    <br />
                    <span class="sublabel">Дисциплина</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('discipline_id', $disciplines, (isset($result->id)) ? $result->discipline()->first()->id : null) !!}
                </div>

            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Пол:</span>
                    <br />
                    <span class="sublabel">Пол</span><br />
                </label>
                <div  class="input-prepend">

                    {!! Form::select('gender_id', $genders, (isset($result->id)) ? $result->gender()->first()->id : null) !!}
                </div>

            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Возрастная категория:</span>
                    <br />
                    <span class="sublabel">Возрастная категория</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('age_id', $ages, (isset($result->id)) ? $result->age()->first()->id : null) !!}
                </div>

            </li>

            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Ранг:</span>
                    <br />
                    <span class="sublabel">Ранг</span><br />
                </label>
                <div class="input-prepend">

                    {!! Form::select('rank_id', $ranks, (isset($result->id)) ? $result->rank()->first()->id : null) !!}
                </div>

            </li>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Команда:</span>
                    <br />
                    <span class="sublabel">Введите членов команды</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('team_members',(isset($result->id)) ? $result->team_members  : old('team_members'), ['placeholder'=>'Введите членов команды']) !!}
                </div>
            </li>   
             {!! Form::close() !!}
             
              
           @if(\Auth::user()->hasRole('Admin'))
           @if($pattern)
         {!! Form::open(['url' => (isset($result->id)) ? route('admin.scores.update',['result'=>$result->id]) :route('admin.scores.store'),'class'=>'contact-form','method'=>'PATCH','enctype'=>'multipart/form-data']) !!}    
           
         <script type="text/javascript">
                function showSpoiler(obj) {
                    var inner = obj.parentNode.getElementsByTagName("div")[0];
                    if (inner.style.display == "none")
                        inner.style.display = "";
                    else
                        inner.style.display = "none";
                }
            </script> 
                        
            <div class="spoiler">
                <span onclick="showSpoiler(this);"> <li class="submit-button"> 
                        {!! Form::button('Выставить оценки', ['class' => 'btn btn-the-salmon-dance-3']) !!}			
                    </li></span>
                        
                        

               {{-- @if (isset($score)) --}}
                {{--  <span class="label">Поставленно оценок:  {{ $count_score }}</span> --}}
               {{-- @endif  --}}

                
                <div style="display:none;">
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 1 сложность/плотность:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_idsp1', $judges, (isset($freescore->id)) ? $freescore->judge()->first()->id : null) !!}
                        </div>
                    </li>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                   

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за сложность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('sloz1', (isset($freescore->id)) ? $freescore->sloz1  : old('sloz1'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за плотность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('plot1', (isset($freescore->id)) ? $freescore->plot1  : old('plot1'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    <div class="clearer"></div>
                        <hr />
                        <br>
                    

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 2 сложность/плотность:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_idsp2', $judges, (isset($freescore->id)) ? $freescore->judge()->first()->id : null) !!}
                        </div>
                    </li>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                  
                   
                  
                    
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за сложность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('sloz2', (isset($freescore->id)) ? $freescore->sloz2  : old('sloz2'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за плотность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('plot2', (isset($freescore->id)) ? $freescore->plot2  : old('plot2'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                     <div class="clearer"></div>
                        <hr />
                        <br>
                    
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 3 сложность/плотность:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_idsp3', $judges, (isset($freescore->id)) ? $freescore->judge()->first()->id : null) !!}
                        </div>
                    </li>
                     <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за сложность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('sloz3', (isset($freescore->id)) ? $freescore->sloz3  : old('sloz3'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за плотность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('plot3', (isset($freescore->id)) ? $freescore->plot3  : old('plot3'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                     <div class="clearer"></div>
                        <hr />
                        <br>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 1 техничность/зрелищность:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_idtz1', $judges, (isset($freescore->id)) ? $freescore->judge()->first()->id : null) !!}
                        </div>
                    </li>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                     <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за техничность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('tech1', (isset($freescore->id)) ? $freescore->tech1  : old('tech1'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за зрелищность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('zrel1', (isset($freescore->id)) ? $freescore->zrel1  : old('zrel1'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    <div class="clearer"></div>
                        <hr />
                        <br>


                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 2 техничность/зрелищность:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_idtz2', $judges, (isset($freescore->id)) ? $freescore->judge()->first()->id : null) !!}
                        </div>
                    </li>
                     <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                
                    
                     <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за техничность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('tech2', (isset($freescore->id)) ? $freescore->tech2  : old('tech2'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за зрелищность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('zrel2', (isset($freescore->id)) ? $freescore->zrel2  : old('zrel2'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                     <div class="clearer"></div>
                        <hr />
                        <br>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 3 техничность/зрелищность:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_idtz3', $judges, (isset($freescore->id)) ? $freescore->judge()->first()->id : null) !!}
                        </div>
                    </li>
                     <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
              
                    
                     <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за техничность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('tech3', (isset($freescore->id)) ? $freescore->tech3  : old('tech3'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку за зрелищность:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('zrel3', (isset($freescore->id)) ? $freescore->zrel3  : old('zrel3'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                     <div class="clearer"></div>
                        <hr />
                        <br>
                        
                         <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку главного судьи:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('major_judge', (isset($freescore->id)) ? $freescore->major_judge  : old('major_judge'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    <div class="clearer"></div>
                        <hr />
                        <br>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Участник:</span>
                            <br />
                            <span class="sublabel">Участник</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('user_id', $users, $use) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Дисциплина:</span>
                            <br />
                            <span class="sublabel">Дисциплина</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('discipline_id', $disciplines, $disc) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Соревнование:</span>
                            <br />
                            <span class="sublabel">Соревнование</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('competition_id', $competitions, $comps) !!}
                        </div>
                    </li>
                    
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Групаа:</span>
                            <br />
                            <span class="sublabel">Групаа</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('group_id', $groups, $grp) !!}
                        </div>
                    </li>
                    
                    <li class="submit-button"> 
                        {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
                    </li>
            </div>
            
                 {!! Form::close() !!}    
                
                    @else
                    
        {!! Form::open(['url' => (isset($result->id)) ? route('admin.scores.store',['result'=>$result->id]) :route('admin.scores.update'),'method'=>'POST','enctype'=>'multipart/form-data']) !!} 
        <script type="text/javascript">
                function showSpoiler(obj) {
                    var inner = obj.parentNode.getElementsByTagName("div")[0];
                    if (inner.style.display == "none")
                        inner.style.display = "";
                    else
                        inner.style.display = "none";
                }
            </script> 
            <div class="spoiler">
                <span onclick="showSpoiler(this);"> <li class="submit-button"> 
                        {!! Form::button('Выставить оценки', ['class' => 'btn btn-the-salmon-dance-3']) !!}			
                    </li></span>
                    <div style="display:none;">
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 1:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_id1', $judges, (isset($score->id)) ? $score->judge()->first()->id : null) !!}
                        </div>
                    </li>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку :</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('score_j1', (isset($score->id)) ? $score->score_j1  : old('score_j1'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                     <div class="clearer"></div>
                        <hr />
                        <br>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Судья 2:</span>
                            <br />
                            <span class="sublabel">Судья</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('judge_id2', $judges, (isset($score->id)) ? $score->judge()->first()->id : null) !!}
                        </div>
                    </li>

                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку :</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('score_j2', (isset($score->id)) ? $score->score_j2  : old('score_j2'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                     <div class="clearer"></div>
                        <hr />
                        <br>
                     <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Введите оценку главного судьи:</span>
                            <br />
                            <span class="sublabel">Введите оценку</span><br />
                        </label>
                        <div class="input-prepend"><span class="add-on"></span>
                            {!! Form::number('major_judge', (isset($score->id)) ? $score->major_judge  : old('major_judge'), ['class' => 'form-control','step' => '0.01', 'placeholder'=>'Введите счет']) !!}
                        </div>
                    </li>
                    <div class="clearer"></div>
                        <hr />
                        <br>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Участник:</span>
                            <br />
                            <span class="sublabel">Участник</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('user_id', $users, $use) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Дисциплина:</span>
                            <br />
                            <span class="sublabel">Дисциплина</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('discipline_id', $disciplines, $disc) !!}
                        </div>
                    </li>
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Соревнование:</span>
                            <br />
                            <span class="sublabel">Соревнование</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('competition_id', $competitions, $comps) !!}
                        </div>
                    </li>
                    
                    
                    <li class="text-field">
                        <label for="name-contact-us">
                            <span class="label">Групаа:</span>
                            <br />
                            <span class="sublabel">Групаа</span><br />
                        </label>
                        <div class="input-prepend">
                            {!! Form::select('group_id', $groups, $grp) !!}
                        </div>
                    </li>
                    
                   

                  
                    
                  


                    <li class="submit-button"> 
                        {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}			
                    </li>

                </div>


            </div>

        
        </ul>


        {!! Form::close() !!}
        @endif
        @endif
       



    </div>
</div>

