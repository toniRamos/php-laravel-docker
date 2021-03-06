<?php

namespace App\Http\Controllers;

use App\Service\ApplicationService;
use Log;

class AppController extends Controller{
    private $applicationService;

    function __construct(){
        $this->applicationService = new ApplicationService();
    }

    public function ping(){
        return response()->json("pong", 200);
    }

    public function shout($userName,$limit){
        $code = 200;
        $message = "";

        try{
            $message = $this->applicationService->getMessages($userName,$limit);
        }catch(Exception $e){
            $code = 500;
            $message = "An error has occurred";
            Log::Error('Error obtain messages userName "'.$userName.' and limit'.$limit);
        }

        return response()->json($message, $code);
        
    }

}