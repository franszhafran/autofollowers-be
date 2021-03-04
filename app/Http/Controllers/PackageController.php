<?php

namespace App\Http\Controllers;

use App\Services\JWTAuthenticationService;
use Illuminate\Http\Request;
use App\Models;

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
            
            try {
                $history = new Models\PackageHistory;
                $history->user_id = $request->user->id;
                $history->package_id = $request->package_id;
                $history->save();

                return $this->sendOk();
            }

            catch(\Exception $e) {
                return $this->handleException($e);
            } 
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
