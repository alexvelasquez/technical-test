<?php

function base_url()
{
    return BASE_URL;
}

function assets()
{
    return BASE_URL.'/assets';
}

function dd($data)
{
    $format = print_r('<pre>');
    $format .= print_r($data);
    $format .= print_r('</pre>');
    die;
}
