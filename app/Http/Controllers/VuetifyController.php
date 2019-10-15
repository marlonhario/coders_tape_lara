<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VuetifyController extends Controller
{
    public function index() {
    	return view('vuetify.index');
    }
}
