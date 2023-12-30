<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Http\Request;
use Illuminate\Contracts\Container\Container;
use App\Http\Requests\Exceptions\InputDataBadFormatException;
use App\Http\Requests\Exceptions\InputDataOutOfRangeException;
use App\Http\Resources\Factory\ErrorResourseFactory;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function __construct(
        protected ErrorResourseFactory $errorResourseFactory,
        Container $container
    ){
        parent::__construct($container);
    }

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

        $this->renderable(function (InputDataBadFormatException $e, Request $request) {
            return $this->errorResourseFactory->createBadFormat($e, $request);
        });
        $this->renderable(function (InputDataOutOfRangeException $e, Request $request) {
            return $this->errorResourseFactory->createOutOfRange($e, $request);
        });
        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            return $this->errorResourseFactory->createNotFound($e, $request);
        });
    }
}
