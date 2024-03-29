<?php

namespace App\Traits;

trait GeneralTrait
{

    public function getCurrentLang()
    {
        return app()->getLocale();
    }

    public function returnError( $msg,$code)
    {
        return response()->json([
            'status' => false,
            'errNum' => $code,
            'msg' => $msg
        ],$code);
    }


    public function returnSuccessMessage($msg = "", $errNum = "S000")
    {
        return [
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg
        ];
    }

    public function returnData($key, $value, $msg = "",$token,$code)
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            'token' => $token,
            $key => $value
        ],$code);
    }

    
       public function apiResponse($data= null,$message = null,$status = null){

           $array = [
               'data'=>$data,
               'message'=>$message,
               'status'=>$status,
           ];

           return response($array,$status);

       }
    }





