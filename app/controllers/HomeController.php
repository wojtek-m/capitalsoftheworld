<?php

class HomeController extends BaseController {

    // Home page
	public function home()
	{
		return View::make('home');
	}

    // About page
    public function about()
    {
        return View::make('pages.about')
            ->with('title', 'About |');
    }

    // Feedback page
    public function feedback()
    {
        return View::make('pages.feedback')
            ->with('title', 'Feedback |');
    }

    /*
    |------------------------
    | Send user feedback
    |------------------------
    */
    public function postFeedback()
    {
        $validator = Validator::make(Input::all(), 
            array(
                'email' => 'required|email'
            )
        );

        if($validator->fails()) {
            return Redirect::route('feedback')
                ->withErrors($validator)
                ->withInput();
        } else {

            $email = Input::get('email');
            $name = Input::get('name');
            $message = Input::get('message');

            Mail::send('emails.feedback', array('email' => $email, 'name' => $name, 'feedback_message' => $message), function($message) {
                $message->to('wojciech.murawski@gmail.com')->subject('Capitals of the World - Feedback');
            });

            return Redirect::route('home')
                ->with('global', 'Thank you for your feedback, I appreciate it!')
                ->with('alert-type', 'alert-success')
                ->with('title', 'Thank You for Your Feedback |');
                }
            }

}
