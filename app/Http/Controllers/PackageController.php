<?php

namespace App\Http\Controllers;

use App\Services\JWTAuthenticationService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(
        private JWTAuthenticationService $authenticationService,
    ) {}
    
    public function consume(Request $request) {
        try {
            $request->validate([
                "package_id" => "string",
            ]);
    
            return $this->sendOk();
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
