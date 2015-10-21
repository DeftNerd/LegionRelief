<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ContactRequest;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{

    /**
     * Display the contact form
     * @return [type] [description]
     */
    public function contact()
    {
        return view('about.contact');    	
    }

    /**
     * Process the contact form
     * @return [type] [description]
     */
    public function contact_store(ContactRequest $request)
    {
		$data = [
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'user_message' => $request->get('message'),
		];
		
        \Mail::send('emails.contact', $data, function($message)
        {
        	$message->from(env('MAIL_USERNAME'));
            $message->to(env('MAIL_TO'), env('MAIL_NAME'));
            $message->subject('LegionRelief.com Inquiry');
		});

		return \Redirect::route('home')
			->with('message', "Thanks for contacting us! We'll be in touch soon.");
    }

}
