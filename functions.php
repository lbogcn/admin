<?php

/**
 * CND域名
 * @param string $path
 * @return string
 */
function cdn($path)
{
    return url($path);
    $separator = '';

    if (substr($path, 0, 1) != '/') {
        $separator = '/';
    }

    return '//' . config('domain.cdn') . $separator . $path;
}

/**
 * 生成字符串摘要
 * @param $str
 * @param $len
 * @return string
 */
function str_excerpt($str, $len)
{
    $str = trim(strip_tags($str));

    return str_limit($str, $len);
}
