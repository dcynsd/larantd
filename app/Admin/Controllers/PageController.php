<?php

namespace App\Admin\Controllers;

class PageController extends Controller
{
    public function root()
    {
        $path = public_path('admin/index.html');

        if (! file_exists($path)) {
            abort(404);
        }

        return file_get_contents($path);
    }
}
