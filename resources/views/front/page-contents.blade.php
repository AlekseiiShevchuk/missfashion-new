@if(count($contents) > 0)
    <div class="page-contents">
        @foreach($contents as $content)
            <section class="page-content">
                <div class="container">
                    {!! $content->description !!}
                </div>
            </section>
        @endforeach
    </div>
@endif
