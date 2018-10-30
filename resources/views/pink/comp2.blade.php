Соревнование {{ $competition->status }}

<form method="PATCH">
    <input type="hidden" name="status" value="0">
    {!! Form::button('Закрыть регистрацию', ['class' => 'btn btn-french-5','type'=>'submit', 'name'=>"submit", 'value'=>"Save"]) !!}
</form>
<br>
<form method="PATCH">
    <input type="hidden" name="status" value="1">
    {!! Form::button('Открыть регистрацию', ['class' => 'btn btn-the-salmon-dance-3','type'=>'submit', 'name'=>"submit", 'value'=>"Save"]) !!}
</form>




   







