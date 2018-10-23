@if($competitions)
<div class="cols-1">
    @foreach($competitions as $competition)
    @if($competition->status === 1)
    <div class="pricing_box large radius-right">
        <div class="header">
            <h3>{{ $competition->title }}</h3>
        </div>
        <ul>
            <li>Организатор : {{ $competition->organizator }}</li>
            <li>Информация : {{ str_limit($competition->info,200) }}</li>
            <li>Город : {{ $competition->city }}</li>
            <li>Адрес : {{ $competition->adress }}</li>
            <li>Место : {{ $competition->place }}</li>
            <li>Время начала : {{ $competition->datebegin }}</li>
            <li>Время окончания : {{ $competition->dateend }}</li>
        </ul>
        <p class="button signup"><a href="{{ route('competitions.show', ['alias'=>$competition->alias]) }}">Записаться</a></p>
    </div>
    <div style="clear:both"></div>
    <br>
    @else
    <div class="pricing_box radius-right">
        <div class="header">
            <h3>{{ $competition->title }}</h3>
        </div>
        <ul>
            <li>Организатор : {{ $competition->organizator }}</li>
            <li>Информация : {{ str_limit($competition->info,200) }}</li>
            <li>Город : {{ $competition->city }}</li>
            <li>Адрес : {{ $competition->adress }}</li>
            <li>Место : {{ $competition->place }}</li>
            <li>Время начала : {{ $competition->datebegin }}</li>
            <li>Время окончания : {{ $competition->dateend }}</li>
        </ul>
        <p class="button signup"><a href="{{ route('competitions.show', ['alias'=>$competition->alias]) }}">Поcмотреть результаты</a></p>
    </div>
    <div style="clear:both"></div>
    <br>
@endif
@endforeach
</div>

<div class="general-pagination group">
    @if($competitions->lastPage() > 1 )
    
      @if($competitions->currentPage() !==1 ) 
      <a href="{{ $competitions->url(($competitions->currentPage()-1)) }}" class="selected">{{ Lang::get('pagination.previous') }}</a>
      @endif
      
      @for($i = 1; $i <= $competitions->lastPage(); $i++)
        @if($competitions->currentPage() == $i)
          <a class="selected disabled">{{ $i }}</a>
        @else
          <a href="{{ $competitions->url($i) }}">{{ $i }}</a>
        @endif
      @endfor
      
      
      @if($competitions->currentPage() !==$competitions->lastPage())
           <a href="{{ $competitions->url(($competitions->currentPage() + 1)) }}" class="selected">{{ Lang::get('pagination.next') }}</a>
      @endif
      
      
    @endif
</div>
@endif




   







