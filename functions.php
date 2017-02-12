<?php

/**
 * 获取配置名称
 * @param $optionName
 * @return null|string
 */
function get_option($optionName) {
    return \App\Models\Option::getOption($optionName);
}