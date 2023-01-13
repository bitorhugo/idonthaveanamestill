<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->emptyCartException();
        $this->sessionExpiredException();
        $this->methodNotAllowedException();
    }

    private function sessionExpiredException()
    {
        $this->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->route('login');
            };
        });        
    }

    private function methodNotAllowedException()
    {
        $this->renderable(function (MethodNotAllowedHttpException $e) {
            error_log($e);
            return redirect()->route('home');
        });
    }

    private function emptyCartException()
    {
        $this->renderable(function (EmptyCartException $e) {
            error_log($e);
            return redirect()->route('cart.index')->with('error', 'Empty Cart.');
        });
    }

}
