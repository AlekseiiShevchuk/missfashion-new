{{--<div class="hero">--}}
    {{--<div class="hero__slider">--}}
        {{--@foreach($sliders as $slider)--}}
            {{--<div>--}}
                {{--<img src="./uploads/{{ $slider->slider_image }}" alt="{{ $slider->description }}">--}}
            {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}
{{--</div>--}}
<div class="row">
@php
    if (file_exists(__DIR__ . "../../../../public/revslider/embed.php")){
    include_once __DIR__ . "../../../../public/revslider/embed.php";
    RevSliderEmbedder::putRevSlider("main-page-slider");
}
@endphp
</div>
