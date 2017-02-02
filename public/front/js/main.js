/**
 * Created by chucho on 30.01.17.
 */

$(function() {
    console.log( "ready!" );

    $('.hero__slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        adaptiveHeight: true,
        autoplay: true
    });

    $('.product-slider').slick({
        asNavFor: '.product-slider-thumb',
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });

    $('.product-slider-thumb').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.product-slider',
        focusOnSelect: true,
        arrows: false
    });

});