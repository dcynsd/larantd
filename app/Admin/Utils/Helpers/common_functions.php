<?php

if (! function_exists('test_function')) {
    function test_function()
    {
        return 'This is a test function.';
    }
}

if (! function_exists('admin_path')) {
    /**
     * 获取 Admin 地址
     * @param string $path
     * @return string
     */
    function admin_path($path = '')
    {
        return ucfirst(app_path('Admin')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
