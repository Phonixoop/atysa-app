<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function all(){
        return view('admin.calendar.all');
    }
    public function view(){
        return view('admin.calendar.view');
    }
}
