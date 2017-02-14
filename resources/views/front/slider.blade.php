{{--<div class="hero">--}}
{{--<div class="hero__slider">--}}
{{--@foreach($sliders as $slider)--}}
{{--<div>--}}
{{--<img src="./uploads/{{ $slider-slider_image }}" alt="{{ $slider->description }}">--}}
{{--</div>--}}
{{--@endforeach--}}
{{--</div>--}}
{{--</div>--}}
<div>
    @php
        if (env('INCLUDE_REV_SLIDER')){
        include_once __DIR__ . "../../../../public/revslider/embed.php";
        RevSliderEmbedder::putRevSlider("main-page-slider");
    }
    @endphp
</div>
