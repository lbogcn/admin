<?php

/**
 * 获取配置名称
 * @param $optionName
 * @return null|string
 */
function get_option($optionName) {
    return \App\Models\Option::getOption($optionName);
}

/**
 * CND域名
 * @param string $path
 * @return string
 */
function cdn($path) {
    $separator = '';

    if (substr($path, 0, 1) != '/') {
        $separator = '/';
    }

    return '//' . env('DOMAIN_CDN') . $separator . $path;
}