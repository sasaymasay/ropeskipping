@if($menu)
<div class="menu classic">
    <ul id="nav" class="menu">
        @include(env('THEME').'.customMenu',['items'=>$menu->roots()]) 
    </ul>
</div>
@endif
