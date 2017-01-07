<?php

namespace App\Http\Controllers;

use App\Components\ApiResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Create the response for when a request fails validation.
     * @param Request $request
     * @param array $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if (($request->ajax() && ! $request->pjax()) || $request->wantsJson()) {
            $resp = array(442, current(current($errors)));

            return ApiResponse::buildFromArray($resp);
        }

        return redirect()->to($this->getRedirectUrl())
            ->withInput($request->input())
            ->withErrors($errors, $this->errorBag());
    }
}
