<?php

namespace App\Http\Controllers\User;

use App\Helpers\CountryHelper;
use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use App\Models\User\Customer;
use App\Models\User\CustomerAddresses;
use function Pest\Laravel\session;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    public function login()
    {
        // return auth()->guard('customer')->user();
        return view('user.accounts.login');
    }

    public function register()
    {
        return view('user.accounts.register');
    }

    public function registerUser(Request $request)
    {
        $existingCustomer = Customer::where('email', $request->email)->first();
        $request->validate([
            'name' => ['required', 'min:3', 'string'],
            'email' => [
                'string',
                'required',
                'email',
                Rule::unique('customers', 'email')
                    ->ignore($existingCustomer),
            ],
            'password' => ['required', 'string', 'confirmed', 'min:6']
        ]);

        try {
            $googleAuthenticatedCustomer = Customer::where('email', $request->email)->first();
            if ($googleAuthenticatedCustomer) {
                Customer::whereEmail($request->email)->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password'))
                ]);
                return to_route('user.account.login')
                    ->with('success', 'User Registered Successfully');
            }
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

        $profile = Customer::with('customerAddresses')
            ->where('id', MyHelper::customerId())->first();

        $billingAddress = CustomerAddresses::where('customer_id', MyHelper::customerId())->whereAddressType('billing')->first();
        $shippingAddress = CustomerAddresses::where('customer_id', MyHelper::customerId())->whereAddressType('shipping')->first();
        $avatarPath = asset('assets/photos/dummy.jpg');
        $countryCodes = CountryHelper::getCountries();
        if (auth()->guard()->check() && isset($profile->avatar)) {
            $avatarPath = asset("storage/" . $profile->avatar);
        }
        return view('user.accounts.profile', [
            'profile' => $profile,
            'avatar' => $avatarPath,
            'billingAddress' => $billingAddress,
            'shippingAddress' => $shippingAddress,
            'countryCodes' => $countryCodes
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
        $validations = Validator::make($request->all(), [
            'address_type' => ['required', 'string', 'in:billing,shipping'],
            'street' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'phone' => [
                'nullable',
                'string',
                'phone:country_code',
            ],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'country_code' => ['required_with:phone', 'string', 'size:2'],
            'country' => ['nullable', 'string', 'max:100'],
        ], [
            'phone.phone' => 'The phone number is not valid for the selected country.',
            'country_code.required_with' => 'Country code is required when phone number is provided.',
            'country_code.size' => 'Country code must be a 2-letter ISO code.',
            'address_type.in' => 'Invalid address type. Must be billing or shipping.',
        ]);

        if ($validations->fails()) {
            Log::error("Validation fails", ['errors' => $validations->errors()]);
            return response()->json(['errors' => $validations->errors()], 422);
        }

        try {
            CustomerAddresses::updateOrCreate(
                [
                    'address_type' => $request->input('address_type'),
                    'customer_id' => MyHelper::customerId()
                ],
                [
                    'customer_id' => MyHelper::customerId(),
                    'address_type' => $request->input('address_type'),
                    'street' => $request->input('street'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'phone' => $request->input('phone'),
                    'zip_code' => $request->input('zip_code'),
                    'country_code' => strtoupper($request->input('country_code')),
                    'country' => $request->input('country')
                ]
            );

            Log::info("Customer {$request->input('address_type')} address updated successfully");
            Session::flash('success', 'Address Updated Successfully!');

            return response()->json([
                'success' => true,
                'message' => 'Address updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error("Address update failed: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to update address. Please try again.'
            ], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        // return response()->json(['data' => $request->all()]);

        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $customer = Customer::findOrFail(MyHelper::customerId());


        if (! Hash::check($request->current_password, $customer->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        $customer->update([
            'password' => Hash::make($request->new_password),
        ]);

        Log::info('User password updated successfully', [
            'customer_id' => $customer->id,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully!',
        ]);
    }

    public function forgetPassword()
    {
        return view('user.accounts.recover');
    }
}
