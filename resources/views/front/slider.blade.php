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
    $filename = __DIR__ . "../../../../public/revslider/embed.php";
    if (file_exists($filename)){
    include_once $filename;
    RevSliderEmbedder::putRevSlider("main-page-slider");
}
@endphp
</div>
