
<div id="content-page" class="content group">
    <div class="hentrygroup">
        
{!! Form::open(['url' => (isset($article->id)) ? route('admin.articless.update',['articless'=>$article->alias]) :route('admin.articless.store'),'class'=>'contact-form','method'=>'POST','enctype'=>'multipart/form-data']) !!}
<ul>
    <li class="text-field">
        <label for="name-contact-us">
            <span class="label">Название:</span>
            <br />
            <span class="sublabel">Заголовок новости</span>
            <br />
        </label>
        <div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
        {!! Form::text('title',isset($article->title) ? $article->title :old('title'), ['placeholder'=>'Введите название']) !!}
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
        {!! Form::text('alias',isset($article->alias) ? $article->alias :old('alias'), ['placeholder'=>'Введите псевдоним']) !!}
        </div>
    </li>
    
    <li class="textarea-field">
        <label for="message-contact-us">
            <span class="label">Краткое описание</span>
            </label>
            <div class="input-prepend"><span class="add-on"> <i class="icon-pencil"></i></span>
        {!! Form::textarea('disc',isset($article->disc) ? $article->disc :old('disc'), ['id'=>'editor', 'placeholder'=>'Введите описание']) !!}
            </div>
        <div class="msg-error"></div>
    </li>
    
    <li class="textarea-field">
        <label for="message-contact-us">
            <span class="label">Oписание</span>
        </label>
        <div class="input-prepend"><span class="add-on"><i class="icon-pencil"></i></span>
         {!! Form::textarea('text',isset($article->text) ? $article->text :old('text'), ['id'=>'editor1', 'placeholder'=>'Введите текст']) !!}
            </div>
        <div class="msg-error"></div>
    </li>

    
    @if(isset($article->img->path))
    <li class="textarea-field">
        <label>
            <span class="label">Изображения материала:</span>
        </label>
        {{ Html::image(asset(env('THEME')).'/images/articles/'.$article->img->path),'',['style'=>'width:400px'] }}
        {!! Form::hidden('old_image',$article->img->path) !!}
    </li>
    @endif
    
    <li class="text-field">
        <label for="name-contact-us">
            <span class="label">Изображениe:</span>
            <br />
            <span class="sublabel">Изображениe материала</span><br />
        </label>
        {!! Form::file('image',['class'=>'filestyle','data-buttonText'=>'Выберите изображение','data-buttonName'=>"btn-primary",'data-placeholder'=>"Файла нет"]) !!}
    </li>
    
    @if(isset($article->id))
    <input type="hidden" name="_method" value="PUT">
    @endif
    
    <li class="submit-button">
        {!! Form::button('Сохранить', ['class'=>'btn btn-the-salmon-dance-3','type'=>'submit']) !!}
    </li>
    
</ul>


{!! Form::close() !!}

<script>
    CKEDITOR.replace('editor');
    CKEDITOR.replace('editor1');
</script>
</div>    
</div>    
    
    

                
            
        
    