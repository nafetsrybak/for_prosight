<?php

declare(strict_types=1);

namespace App\Http\Resources\Factory;

use Illuminate\Http\Request;
use App\Http\Requests\Exceptions\InputDataBadFormatException;
use App\Http\Requests\Exceptions\InputDataOutOfRangeException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ErrorResourseFactory
{
    public function createNotFound(NotFoundHttpException $e, Request $request): ?JsonResponse
    {
        if (! $request->wantsJson()) {
            /**
             * Just let the default exception handler deal with this.
             */
            return null;
        }

        $routeName = $request->route()->getName();
        switch ($routeName) {
            case 'salesmen.show':
            case 'salesmen.update':
            case 'salesmen.destroy':
                $json = [
                    'errors' => [
                        [
                            'code' => 'PERSON_NOT_FOUND',
                            'message' => $e->getMessage()
                        ]
                    ]
                ];
                return response()->json($json, 404);
            default:
                /**
                 * Just let the default exception handler deal with this.
                 */
                return null;
        }
    }

    public function createBadFormat(InputDataBadFormatException $e, Request $request): ?JsonResponse
    {
        if (! $request->wantsJson()) {
            /**
             * Just let the default exception handler deal with this.
             */
            return null;
        }

        $errors = [];
        foreach ($e->errors() as $message) {
            $errors[] = [
                'code' => 'INPUT_DATA_BAD_FORMAT',
                'message' => $message
            ];
        }

        $json = [
            'errors' => $errors
        ];
        return response()->json($json, 400);
    }

    public function createOutOfRange(InputDataOutOfRangeException $e, Request $request): ?JsonResponse
    {
        if (! $request->wantsJson()) {
            /**
             * Just let the default exception handler deal with this.
             */
            return null;
        }

        $errors = [];
        foreach ($e->errors() as $message) {
            $errors[] = [
                'code' => 'INPUT_DATA_OUT_OF_RANGE',
                'message' => $message
            ];
        }

        $json = [
            'errors' => $errors
        ];
        return response()->json($json, 416);
    }
}