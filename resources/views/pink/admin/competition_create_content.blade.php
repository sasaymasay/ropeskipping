<div style="margin-right: 4px;" id="content-page" class="content group">
    <div class="hentry group">

        {!! Form::open(['url' => (isset($competition->id)) ? route('admin.comps.update',['competition'=>$competition->id]) :route('admin.comps.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}

        <ul>
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Название:</span>
                    <br />
                    <span class="sublabel">Название</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('title',isset($competition->title) ? $competition->title  : old('title'), ['placeholder'=>'Введите название дисциплины']) !!}
                </div>
            </li>
            
             <li class="text-field">
        <label for="name-contact-us">
            <span class="label">Псевдоним:</span>
            <br />
            <span class="sublabel">Введите псевдоним</span>
            <br />
        </label>
        <div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
        {!! Form::text('alias',isset($competition->alias) ? $competition->alias :old('alias'), ['placeholder'=>'Введите псевдоним']) !!}
        </div>
    </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Организатор:</span>
                    <br />
                    <span class="sublabel">Организатор</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('organizator',isset($competition->organizator) ? $competition->organizator  : old('organizator'), ['placeholder'=>'Введите описание дисциплины']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Описание:</span>
                    <br />
                    <span class="sublabel">Описание</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('info',isset($competition->info) ? $competition->info  : old('info'), ['placeholder'=>'Введите описание дисциплины']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">City:</span>
                    <br />
                    <span class="sublabel">ciy</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('city',isset($competition->city) ? $competition->city  : old('city'), ['placeholder'=>'Введите описание дисциплины']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">Adress:</span>
                    <br />
                    <span class="sublabel">Adress</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('adress',isset($competition->adress) ? $competition->adress  : old('adress'), ['placeholder'=>'Введите описание дисциплины']) !!}
                </div>
            </li>
            
            <li class="text-field">
                <label for="name-contact-us">
                    <span class="label">place:</span>
                    <br />
                    <span class="sublabel">place</span><br />
                </label>
                <div class="input-prepend"><span class="add-on"><i class="icon-user"></i></span>
                    {!! Form::text('place',isset($competition->place) ? $competition->place  : old('place'), ['placeholder'=>'Введите описание дисциплины']) !!}
                </div>
            </li>
            <li class="submit-button">
                {!! Form::button('Сохранить', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
            </li>
        </ul>

              @if(isset($competition->id))
            <input type="hidden" name="_method" value="PUT">		

            @endif
            
            {!! Form::close() !!}
        <form method="GET">
            {!! Form::button('Завершить регистрацию', ['class' => 'btn btn-french-5','type'=>'submit']) !!}
        </form>
            
              <div class="clearer"></div>
                        <hr />
            <form method="GET">
                    <input type="text" name="user_id">
                
                        <br>
                {!! Form::button('Поиск', ['class' => 'btn btn-the-salmon-dance-3','type'=>'search']) !!}	
            </form>
               
                
           
                
                  <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                
                <th>ID</th>
                <th>Имя участника</th>
                <th>Фамилия участника</th>
                <th>Соревнование</th>
                <th>Группа</th>
                <th>Дисциплина</th>
                <th>Ранк</th>
                <th>Пол</th>
                <th>Возраст</th>
                <th>Общий счет</th>
                <th>Члены команды</th>


                <th>Действие</th>

                </thead>
                @if ($res)
                @foreach($res as $item)
                @if($competition->id == $item->competition->id)

                <tr>
                    <td>{{ $item->user_id}}</td>
                    <td>{!! Html::link(route('admin.scores.edit',['results' => $item->id]),$item->user->name) !!}</td>
                    <td>{!! Html::link(route('admin.scores.edit',['results' => $item->id]),$item->user->surname) !!}</td>
                    <td>{{ $item->competition->title}}</td>
                    <td>{{ $item->group->name}}</td>
                    <td>{{ $item->discipline->name}}</td>
                    <td>{{ $item->rank->name}}</td>
                    <td>{{ $item->gender->name}}</td>
                    <td>{{ $item->age->choices}}</td>
                    <td>{{ $item->final_score}}</td>
                    <td>{{ $item->team_members}}</td>
                    <td>
                        {!! Form::open(['url' => route('admin.scores.destroy',['results'=> $item->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
                {!! Form::close() !!}
        
                        
 {!! Form::open(['url' => (isset($competition->id)) ? route('admin.comps.update',['competition'=>$competition->id]) :route('admin.comps.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}                
         
          <div class="short-table white">
            <table style="width: 100%" cellspacing="0" cellpadding="0">
                <thead>
                <th>Номер участника</th>
                <th>ID</th>
                <th>Имя участника</th>
                <th>Фамилия участника</th>
                <th>Соревнование</th>
                <th>Группа</th>
                <th>Дисциплина</th>
                <th>Ранк</th>
                <th>Пол</th>
                <th>Возраст</th>
                <th>Общий счет</th>
                <th>Члены команды</th>


                <th>Действие</th>

                </thead>
                 
                @if($results)

                @foreach($results as $result)
                @if($competition->id == $result->competition->id)
                
                
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $result->user_id}}</td>
                    <td>{!! Html::link(route('admin.scores.edit',['results' => $result->id]),$result->user->name) !!}</td>
                    <td>{!! Html::link(route('admin.scores.edit',['results' => $result->id]),$result->user->surname) !!}</td>
                    <td>{{ $result->competition->title}}</td>
                    <td>{{ $result->group->name}}</td>
                    <td>{{ $result->discipline->name}}</td>
                    <td>{{ $result->rank->name}}</td>
                    <td>{{ $result->gender->name}}</td>
                    <td>{{ $result->age->choices}}</td>
                    <td>{{ $result->final_score}}</td>
                    <td>{{ $result->team_members}}</td>
                          
                    <td>
                        {!! Form::open(['url' => route('admin.scores.destroy',['results'=> $result->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
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
                         


            
          
            
           


        {!! Form::close() !!}

        
        @if($results)
<div class="general-pagination group">
    @if($results->lastPage() > 1 )
    
      @if($results->currentPage() !==1 ) 
      <a href="{{ $results->url(($results->currentPage()-1)) }}" class="selected">{{ Lang::get('pagination.previous') }}</a>
      @endif
      
      @for($i = 1; $i <= $results->lastPage(); $i++)
        @if($results->currentPage() == $i)
          <a class="selected disabled">{{ $i }}</a>
        @else
          <a href="{{ $results->url($i) }}">{{ $i }}</a>
        @endif
      @endfor
      
      
      @if($results->currentPage() !==$results->lastPage())
           <a href="{{ $results->url(($results->currentPage() + 1)) }}" class="selected">{{ Lang::get('pagination.next') }}</a>
      @endif
      
      
    @endif
    @endif
</div>
        
         @if(isset($result->id))
            <input type="hidden" name="_method" value="PUT">		

         @endif
    </div>
</div>
