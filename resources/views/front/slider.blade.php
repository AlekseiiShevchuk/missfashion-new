<div class="hero">
    <div class="hero__slider">
        @foreach($sliders as $slider)
            <div>
                <img src="./uploads/{{ $slider->slider_image }}" alt="{{ $slider->description }}">
            </div>
        @endforeach
    </div>
</div>