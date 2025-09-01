<?php 

namespace App\Http\Traits;


trait Response 
{






    public function success($message = 'Success',$data = null, $status = 200, $meta = [])
    {
         $payload = [
        'success' => true,
        'message' => $message,
        'data'    => $data,
    ];

         if (!empty($meta)) {
        
            foreach($meta as $key => $value){
                $payload['key'] = $value;
            }

         }

            return response()->json($payload, $status);
    }


    public function fail( $message = 'Error',  $status = 400,$meta = [])
    {
              $payload = [
        'success' => false,
        'message' => $message
    ];

         if (!empty($meta)) {
        
            foreach($meta as $key => $value){
                $payload['key'] = $value;
            }

         }

            return response()->json($payload, $status);
    }






}