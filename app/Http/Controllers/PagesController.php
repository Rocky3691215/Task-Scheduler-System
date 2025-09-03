<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class PagesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function page4()
    {
        return view('page4');
    }

    public function page5()
    {
        // This method now returns a view, but you'll need to create the file
        // at `resources/views/page5.blade.php` for it to work.
        return view('page5');
    }
}
