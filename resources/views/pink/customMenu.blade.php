@foreach($items as $item) 

<li {{ (URL::current()==$item->url()) ? "class=active" : ' ' }}><a href="{{ $item->url() }}">{{ $item->title }}</a></li>
@if($item->hasChildren())

<ul class="sub-menu">
    
 @include(env('THEME').'.customMenu',['items'=>$item->children()]);   
    
</ul>

@endif
@endforeach