<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function getParam($array = array(), $key = "") 
    {
        return isset($array[$key]) ? $array[$key] : "";
    }
}
