<?php

namespace App\Http\Controllers;

use App\Mail\Mailable;
use App\Mail\RecoverPasswordMail;
use App\Models\User\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{

    public function sendRecoverPasswordMail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $customer =  Customer::whereEmail($request->input('email'))->first();

        if (! $customer) {
            return redirect()->back()->withErrors(['email' => 'The email was incorrect']);
        }

        $newPlainPassword = bin2hex(random_bytes(4));
        $newHashedPassword = password_hash($newPlainPassword, PASSWORD_BCRYPT);

        Customer::where('email', $customer->email)->update([
            'password' => $newHashedPassword
        ]);

        Log::info("password changed successfuly for user", ['customerId' => $customer->id]);

        $recipientEmail = $request->input('email');
        $body = "Your new password is: " . $newPlainPassword;
        $subject = "New Password to access your account";

        $response =  Mail::to($recipientEmail)->send(new RecoverPasswordMail($body, $subject));
        Log::info("Email sent successfully to the user", ['customerId' => $customer->id]);
        return redirect()->back()->with('success', 'An email has been sent successfully to your account');
    }
}
