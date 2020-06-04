<?php

namespace App\Http\Controllers\Open\Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Open\ContactValidate;
use App\Model\Open\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\Open\SendMail;
use URL;

class ContactController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showContactForm(){

        return view('open/contact/contact');
    }

    public function send(Request $request,ContactValidate $requestValidate){

    	$validated = $requestValidate->validated();///hmm.. how to custom redirect

            $data = array(
                'name'    => $request->input('name'),
                'email'   => $request->input('email'),
                'phone'   => $request->input('phone'),
                'message' => $request->input('message'),
            );

        if(!empty($data)){

            //send mail(for some reason return false but mail is sent)
            Mail::to('mymail@felportf.x10host.com')->send(new SendMail($data));

                $contact = new Contact;
                $contact->name    = $request->input('name');
                $contact->email   = $request->input('email');
                $contact->phone   = $request->input('phone');
                $contact->message = $request->input('message');
                $contact->save();

                $url = URL::route('contact') . '#contactform';

                return redirect($url)->with('message','Message sent.');

        }

    }
}
