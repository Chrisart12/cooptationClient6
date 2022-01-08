<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Auth;
use Lang;
use Redirect;
use Session;
use Validator;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
		if ($e instanceof \Illuminate\Session\TokenMismatchException) {
			// return response()->view('errors.custom', [], 500);
			// dd("Token mismatch handled");
			
			Session::regenerateToken();
			return Redirect::route('/');
		}
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
		if ($e instanceof \Illuminate\Session\TokenMismatchException) {
			// return response()->view('errors.custom', [], 500);
			// dd("Token mismatch handled");
			
			Session::regenerateToken();
			// return Redirect::route('login', ['request' => $request]);
			// return Redirect::action('UserController@login', [$request]);
			
			// $this->validate($request, ['token' => 'required']);
			// $this->validate($request, ['password' => 'required']);
			// Validator::validate($request, ['token' => 'required']);
			// Validator::validate($request, ['password' => 'required']);
			
			// si les indentifiants de connexion sont corrects, on dirige vers la homepage
			// if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
			if(Auth::attempt(['token' => $request->token, 'password' => $request->password])){
				// si un returnUrl est configuré
				if(isset($request->returnUrl)){
					return Redirect($request->returnUrl);
				}

				// session lors de la connexion
				session()->flash('message', 'Welcome ' . Auth::user()->firstname . ' ' . Auth::user()->lastname);
				session()->flash('color', 'info');
				
				// Redirection
				return Redirect::route("gallery");
				
			// sinon on redirige vers la page de login avec un message d'erreur
			} else {
				return Redirect::route("login")->withErrors(ucfirst(Lang::get('label.incorrect-connexion-params')));
			}
		}
        return parent::render($request, $e);
    }
}
