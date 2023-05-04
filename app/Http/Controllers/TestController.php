<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\NotifyMail;

class TestController extends Controller
{
   

    public function tesEmail(Request $request){
        $this->validate($request, [
            'email' => 'required'
        ]);

        $email = $request -> email;
        try {
            Mail::send('email.demoMail', ['Nama' => "nama", 'link' => ""], function ($message) use ($email) {
                $message->from('noreply@sitama.co.id', 'Ubah Password');
                $message->to($email);
                $message->subject('Forgot Password');
            });
            // End Mail
        return 'Silahkan cek email anda';
    
        } catch (\Throwable $e) {
            $respon = [
                'status' => 'error',
                'message' =>  $e->getMessage(),
                'errors' => $e->getMessage(),
                'content' => null,
            ];
            return response()->json($respon);
        }
      
    }
}
