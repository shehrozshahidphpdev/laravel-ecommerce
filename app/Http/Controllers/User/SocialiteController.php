<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Customer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Pest\ArchPresets\Custom;

class SocialiteController extends Controller
{
    /**
     * Summary of googleLogin
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Summary of googleAuth
     * @return 
     */
    public function googleAuth()
    {
        $googleUser = Socialite::driver('google')
            ->user();
        $customer = Customer::where('google_id', $googleUser->getId())->first();
        if ($customer) {

            $customer->update([
                'google_id' => $googleUser->getId(),
            ]);

            Auth::guard('customer')->login($customer);
            return to_route('user.home');
        }

        Customer::create([
            'name'      => $googleUser->getName(),
            'email'     => $googleUser->getEmail(),
            'google_id' => $googleUser->getId(),
            'password'  => null,
        ]);
        $customer = Customer::where('email', $googleUser->getEmail())->first();
        Auth::guard('customer')->login($customer);
        return to_route('user.home');
    }
}
