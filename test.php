<?php
    $response_code = get_headers('http://www.envylook.dk/media/extendware/ewimageopt/media/inline/5/a/sia-kjole-bordeaux-d82.jpg')[0];
    if (!strstr($response_code,'200 OK')){
    };
