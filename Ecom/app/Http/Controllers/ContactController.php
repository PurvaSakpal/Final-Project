<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactUs;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ShowContactDetails()
    {
        $contactus = ContactUs::orderBy('created_at', 'desc')->paginate(10);
        return view('Contact.ShowContactDetails', compact('contactus'));
    }
}
