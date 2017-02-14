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

    $('#main-menu > li a').each(function(){
        var current = location.href,
            target= $(this).attr('href');

        if ( target == current)
        {
            $(this).parent().addClass('active');
        }
    });

    $("#search-cat").submit(function( event ) {

        var current = location.href;

        if (location.search === '?page=') {
            location.href = '?' + 'search=' + $( "input[name='search']" ).val();
            return false;
        }

        if (location.search !== '') {
            location.href = current + '&' + 'search=' + $( "input[name='search']" ).val();
            // console.log(current +'&' + 'search=' + $( "input[name='search']" ).val());
            return false;
        }
        else {
            location.href = current + '?' + 'search=' + $( "input[name='search']" ).val();
            // console.log(current +'?' + 'search=' + $( "input[name='search']" ).val());
            return false;
        }
    });

    $('.order-dropdown li ul li > a').each(function () {
        var current = location.href,
            target = $(this).attr('href'),
            text = $(this).html();
        if ( target == current)
        {
            $('.order-dropdown .current-li-content').html(text);
        }

    })

});