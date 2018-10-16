<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/5
 * Time: 9:05
 */

namespace App\Http\Controllers\Test;


use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    public function action()
    {
        return view('test/test')->with('username', 'HelloFelton');
        //return view('test')->with('username', 'HelloFelton');
    }
}