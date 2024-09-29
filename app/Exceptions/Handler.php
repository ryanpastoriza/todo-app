<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
// use Throwable;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (Exception $e, Request $request) {
            if ($request->wantsJson()) {
                return $this->handleApiExceptions($request, $e);
            }
            return abort(500, $e->getMessage());
        });
    }

    public function handleApiExceptions(Request $request, Exception $e)
    {
        if ($e instanceof NotFoundHttpException) {
            return $this->failure(['message' => 'Resource not found'], JsonResponse::HTTP_NOT_FOUND);
        }
    }
}
