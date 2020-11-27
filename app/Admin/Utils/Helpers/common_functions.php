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

if (! function_exists('makeFullUrl')) {
    /**
     * 获得完整 URL 地址
     * @param string|array $url
     * @return string | array
     */
    function makeFullUrl($url)
    {
        if (! $url) {
            return '';
        }

        if (is_array($url)) {
            $result = [];

            foreach ($url as $item) {
                $result[] = makeFullUrl($item);
            }

            return $result;
        }

        if (\Illuminate\Support\Str::startsWith($url, 'http')) {
            return $url;
        }

        return config('app.url') . '/storage/' . $url;
    }
}

if (! function_exists('show_tree')) {
    /**
     * 以树状展示数据
     * @param array $data
     * @return array
     */
    function show_tree(array $data)
    {
        $tree = [];
        foreach ($data as $value) {
            if ($value['level'] > 0) {
                $prefix = '|' . str_repeat('--', $value['level']);
            } else {
                $prefix = '';
            }

            $tree[] = [
                'value' => $value['id'],
                'label' => $prefix . $value['title'],
            ];
        }

        return $tree;
    }
}

if (! function_exists('admin_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_base_path($path = '')
    {
        $prefix = '/admin-api';

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }

        return $prefix . '/' . $path;
    }
}
