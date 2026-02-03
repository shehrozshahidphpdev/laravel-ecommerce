<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Helpers\MyHelper;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\session;

class AccountController extends Controller
{
    public function login()
    {
        return view('user.accounts.login');
    }

    public function register()
    {
        return view('user.accounts.register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'string'],
            'email' => ['string', 'required', 'unique:customers,email', 'email'],
            'password' => ['required', 'string', 'confirmed', 'min:6']
        ]);

        try {
            Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            Log::info('User Created Successfully!');
            return to_route('user.account.login')
                ->with('success', 'User Registered Successfully');
        } catch (\Exception $e) {
            Log::error('User Registration Failed' . $e->getMessage());
        }
    }

    public function attemptLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ]);
        $remember_me = false;
        $credentials = $request->only('email', 'password');
        if (isset($request->remember_me)) {
            $remember_me = true;
        }

        if (Auth::guard('customer')->attempt($credentials, $remember_me)) {
            return to_route('user.account.profile');
        }

        return redirect()->back()
            ->withErrors(['email' => "The crdetials does not match our records."])
            ->onlyInput('email');
    }

    public function profile()
    {
        if (! MyHelper::customerCheck()) {
            return to_route('user.account.login');
        }

        $profile = Customer::where('id', MyHelper::customerId())->first();

        $avatarPath = asset('assets/photos/dummy.jpg');
        if (auth()->guard()->check() && isset($profile->avatar)) {
            $avatarPath = asset("storage/" . $profile->avatar);
        }
        return view('user.accounts.profile', [
            'profile' => $profile,
            'avatar' => $avatarPath
        ]);
    }

    public function logout(Request $request)
    {
        auth()->guard('customer')->logout();

        $request->session()->invalidate();

        return to_route('user.home');
    }

    public function uploadPhoto(Request $request)
    {
        $request->validate([
            'avatar' => 'required|mimes:png,jpeg|max:5048',
        ]);

        $oldAvatar = Customer::where('id', auth()->guard('customer')->id())
            ->select('avatar')->first();

        if ($oldAvatar->avatar) {
            MyHelper::removeFile($oldAvatar->avatar);
            Log::info('old avatar deleted');
        }

        $file = $request->file('avatar');
        $path = MyHelper::uploadFile($file);
        Customer::where('id', auth()->guard('customer')->id())
            ->update([
                'avatar' => $path
            ]);

        Log::info('Avatar uploaded: ' . $path);
        return redirect()->back()->with('success', 'Profile added.');
    }

    public function updateProfile(Request $request)
    {
        try {
            Customer::where('id', MyHelper::customerId())
                ->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'gender' => $request->gender,
                    'location' => $request->location,
                    'about' => $request->about
                ]);

            Log::info("profile updated successfully");
            return redirect()->back()->with('success', 'Profile Updated Successfully');
        } catch (\Exception $e) {
            Log::error("profile not updated: " . $e->getMessage());
        }
    }

    public function updateAddress(Request $request)
    {
        return response()->json(['message' => $request->formData]);
    }
}
