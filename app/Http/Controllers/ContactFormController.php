<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\MAil;

class ContactFormController extends Controller
{
    public function create() {
    	return view('contact.create');
    }

    public function store() {
    	$data = request()->validate([
    		'name' => 'required',
    		'email' => 'required|email',
    		'message' => 'required'
    	]);	

    	Mail::to('test@test.com')->send(new ContactFormMail($data));

    	// session()->flash('message', 'Thanks for your message will be in touch');

    	return redirect('contact')->with('message', 'Thanks for your message will be in touch');
    }
}
