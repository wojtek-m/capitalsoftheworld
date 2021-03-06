<?php

class AccountController extends BaseController {

    
    /*
    |------------------------
    | User authentication
    |------------------------
    */

    public function getSignIn() {
        return View::make('account.signin')->with('title', 'Sign in |');
    }

    public function postSignIn() {
        $validator = Validator::make(Input::all(), 
            array(
                'email'     => 'required|email',
                'password'  => 'required'
            )
        );

        if($validator->fails()){
            // Redirect to the sign in page
            return Redirect::route('account-sign-in')
                ->withErrors($validator)
                ->withInput()
                ->with('title', 'Sign in |');
        }
        else {
            $remember = (Input::has('remember')) ? true : false;

            // Attempt user sign in
            $auth = Auth::attempt(array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password'),
                'active'    => 1
            ), $remember);

            if($auth) {
                // Redirect to the intended page
                return Redirect::intended('/')
                    ->with('global', 'You are now signed-in.')
                    ->with('alert-type', 'alert-success'); 
            }
            else {
                return Redirect::route('account-sign-in')
                    ->with('global', 'There was a problem signing you in. Email and password do not match or your account is not active.')
                    ->with('alert-type', 'alert-danger')
                    ->with('title', 'Sign in |');
            }
        }

        return Redirect::route('account-sign-in')
            ->with('global', 'There was a problem signing you in. Have you activated your account?')
            ->with('alert-type', 'alert-danger')
            ->with('title', 'Sign in |');
    }

    /*
    |------------------------
    | Account sign out
    |------------------------
    */

    public function getSignOut() {
        Auth::logout();
        return Redirect::route('home')
            ->with('global', 'You have signed out.')
            ->with('alert-type', 'alert-info');
    }

    /*
    |------------------------
    | Account creation
    |------------------------
    */

    public function getCreate() {
        return View::make('account.create')->with('title', 'Register |');
    }

    public function postCreate() {

        $validator = Validator::make(Input::all(),
            array(
                'email'             => 'required|max:50|email|unique:users',
                'username'          => 'required|max:20|min:3|unique:users',
                'password'          => 'required|min:6',
                'password_again'    => 'required|same:password'
            )
        );

        if($validator->fails()){
            return Redirect::route('account-create')
                ->withErrors($validator)
                ->withInput();
        }
        else {
            // Create account
            $email = Input::get('email');
            $username = Input::get('username');
            $password = Input::get('password');

            // Activation code
            $code = str_random(60);

            $user = User::create(array(
                'email'     => $email,
                'username'  => $username,
                'password'  => Hash::make($password),
                'code'      => $code,
                'active'    => 0
            ));

            // SUCCESS
            if($user) {
                
                // Send e-mail
                Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'username' => $username), function($message) use ($user) {
                    $message->to($user->email, $user->username)->subject('Account activation');
                });

                // Redirect to home
                return Redirect::route('home')
                    ->with('global', 'Your account has been created. Please check your e-mail for the activation link.')
                    ->with('alert-type', 'alert-success')
                    ->with('title', 'Registration Successful |');
            }
            // FAILURE
            else {
                return Redirect::route('home')
                    ->with('global', 'We could not create your account, please try again or contact us using the feedback form.')
                    ->with('alert-type', 'alert-warning')
                    ->with('title', 'Registration Failed |');
            }


        }
    }

    /*
    |--------------------------
    | Account activation
    |--------------------------
    */

    // Activate the user account
    public function getActivate($code) {
        $user = User::where('code', '=', $code)->where('active', '=', 0);

        if($user->count()) {
            $user = $user->first();

            // Update the active field 
            $user->active   = 1;
            $user->code     = '';

            if($user->save()) {
                return Redirect::route('home')
                    ->with('global', 'Your account has been activated! You can now sign in.')
                    ->with('alert-type', 'alert-success')
                    ->with('title', 'Account Activated | ');
            }
        }
        
        return Redirect::route('home')
                ->with('global', 'We cound not activate your account. Please try again later.')
                ->with('alert-type', 'alert-warning');

    }

    /*
    |------------------------
    | Password change
    |------------------------
    */

    // Change user password (GET)
    public function getChangePassword() {
        return View::make('account.password')->with('title', 'Change Password | ');
    }

    // Change user password (POST)
    public function postChangePassword() {
        $validator = Validator::make(Input::all(), 
            array(
                'old_password'          => 'required',
                'new_password'          => 'required|min:6',
                'new_password_again'    => 'required|same:new_password'
            )
        );

        if ($validator->fails()) {
            return Redirect::route('account-change-password')
                ->withErrors($validator)
                ->with('title', 'Change Password | ');
        } else {

            $user = User::find(Auth::user()->id);

            $old_password = Input::get('old_password');
            $new_password = Input::get('new_password');

            if (Hash::check($old_password, $user->getAuthPassword())) {
                $user->password = Hash::make($new_password);

                if ($user->save()) {
                    return Redirect::route('home')
                        ->with('global', 'Your password has been changed.')
                        ->with('alert-type', 'alert-success')
                        ->with('title', 'Your Password has been Changed | ');
                }
            }
        }

        return Redirect::route('account-change-password')
            ->with('global', 'Your password could not be changed.')
            ->with('alert-type', 'alert-success')
            ->with('title', 'Change Password | ');
    }

    public function getForgotPassword() {
        return View::make('account.forgot')->with('title', 'Forgot Password | ');
    }

    public function getRecover($code) {
        $user = User::where('code', '=', $code)
            ->where('password_temp', '!=', '');

        if($user->count()){
            $user = $user->first();

            $user->password         = $user->password_temp;
            $user->password_temp    = '';
            $user->code             = '';

            // Reset successs
            if($user->save()) {
                return Redirect::route('home')
                    ->with('global', 'Your account has been recovered, you can sign in with your temporary password. Please change it as soon as you are signed in.')
                    ->with('alert-type', 'alert-success')
                    ->with('title', 'Account Recovered | ');
            }
        }

        // Fallback redirect
        return Redirect::route('home')
            ->with('global', 'Could not recover your account.')
            ->with('alert-type', 'alert-danger')
            ->with('title', 'Account Recovery Failed | ');
    }

    public function postForgotPassword() {
        $validator = Validator::make(Input::all(), 
            array(
                'email' => 'required|email'
            )
        );

        if($validator->fails()) {
            return Redirect::route('account-forgot-password')
                ->withErrors($validator)
                ->withInput();
        } else {
            
            $user = User::where('email', '=', Input::get('email'))->where('active', '=', 1);

            if($user->count()) {
                $user = $user->first();

                // Generate a new code and password
                $code                   = str_random(60);
                $password               = str_random(10);

                $user->code             = $code;
                $user->password_temp    = Hash::make($password);

                if($user->save()) {
                    Mail::send('emails.auth.forgot', array('link' => URL::route('account-recover', $code), 'username' => $user->username, 'password' => $password), function($message) use ($user) {
                        $message->to($user->email, $user->username)->subject('Your temporary password');
                    });

                    return Redirect::route('home')
                        ->with('global', 'We have sent you a temporary password by e-mail')
                        ->with('alert-type', 'alert-success')
                        ->with('title', 'Please Check Your e-mail | ');;
                }
            }
        }

        return Redirect::route('account-forgot-password')
            ->with('global', 'Could not request a new password. Please make sure you use a correct e-mail address.')
            ->with('alert-type', 'alert-danger')
            ->with('title', 'New Password Request Failed | ');
    }
}
