/**
 * Created by chucho on 30.01.17.
 */
$.extend({
    getUrlVars: function(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    },
    getUrlVar: function(name){
        return $.getUrlVars()[name];
    }
});

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

        if (location.search !== '') {
            location.href = '?' + 'search=' + $( "input[name='search']" ).val();
            return false;
        }
        else {
            location.href = current + '?' + 'search=' + $( "input[name='search']" ).val();
            return false;
        }
    });
    $("#search-cat2").submit(function( event ) {

        var current = location.href;

        if (location.search !== '') {
            location.href = '?' + 'search=' + $( "input[name='search2']" ).val();
            return false;
        }
        else {
            location.href = current + '?' + 'search=' + $( "input[name='search2']" ).val();
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