<?php $tabs=['users','articles','comments'] ?>

<ul class="nav nav-tabs">
    @foreach($tabs as $tab)
        @if($active===$tab)
            <li role="presentation" class="active"><a href="{{ url("/admin/$tab") }}">{{$tab}}</a></li>
        @else
            <li role="presentation"><a href="{{ url("/admin/$tab") }}">{{$tab}}</a></li>
        @endif
    @endforeach
</ul>