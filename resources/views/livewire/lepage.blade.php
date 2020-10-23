<div>

    @php
    #dd($asrParams);
#dd($asrParams); you left off wondering why asrParams isn't in scope here.'
#dd(get_defined_vars());
@endphp

{{--    @include($pageRoute,['asrParams'=>$asrParams])--}}
    {!! $innerHtml !!}
{{--    @include('partials/footer')--}}
</div>
