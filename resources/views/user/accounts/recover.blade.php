<x-user.app-layout title="login">
  <!-- login area start -->
  <section class="tp-login-area pb-140 p-relative z-index-1 fix mt-50">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8">
          <div class="tp-login-wrapper">
            <div class="tp-login-top text-center mb-30">
              <h3 class="tp-login-title mb-5">Recover Your Password</h3>
              <p>we will send you an email to reset your password</p>

            </div>
            <div class="tp-login-option">
              <div class="tp-login-input-wrapper">
                <x-form action="{{ route('user.account.passwordmail') }}" method="GET">
                  <div class="tp-login-input-box">
                    <div class="tp-login-input">
                      <input id="email" name="email" type="email" placeholder="testing@mail.com">
                    </div>
                    <div class="tp-login-input-title">
                      <label for="email">Your Email</label>
                    </div>
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
              </div>

              <div class="tp-login-bottom d-grid gap-2">
                <!-- Normal Login Button -->
                <button type="submit" class="tp-login-btn btn btn-primary w-100">Submit</button>
              </div>
              </x-form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- login area end -->
</x-user.app-layout>