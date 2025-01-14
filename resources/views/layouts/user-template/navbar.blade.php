<nav class="navbar">
    <div class="nav-left">
        <a href="#home" class="nav-link">HOME</a>
        <a href="#location" class="nav-link">LOCATION</a>
    </div>
    <div class="nav-center">
        <img src="{{ asset('assets/logo/logo_bakery.png') }}" alt="Bakery Logo" class="logo">
    </div>
    @if(Auth::check())
        <div class="nav-rights">
            <a href="{{ route('user.order_status') }}" class="nav-link">ORDER STATUS</a>
            <a href="#" class="nav-link">{{ $user->username }}</a>
            <a href="{{ route('logout') }}" class="nav-link">LOGOUT</a>
            <a href="{{ route('user.cart') }}" class="nav-link"><img src="{{ asset('assets/logo/cart.png') }}" alt="Cart Logo" class="logo-right"></a>
            <a href="#" class="nav-link"><img src="{{ asset('assets/logo/profile.png') }}" alt="Profile Logo" class="logo-right"></a>
        </div>
    @else
        <div class="nav-right">
            <a href="#signin" class="nav-link" data-bs-toggle="modal" data-bs-target="#signIn">SIGN IN</a>
            <span class="nav-link"> / </span>
            <a href="#signup" class="nav-link" data-bs-toggle="modal" data-bs-target="#signUp">SIGN UP</a>
        </div>
    @endif
</nav>

<div class="modal fade" id="signIn" tabindex="-1" aria-labelledby="signInLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="signInLabel">Sign In</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <form method="POST" action="{{ route('signin_process') }}" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                      <label for="signInEmail" class="form-label">Email</label>
                      <input type="email" class="form-control" id="signInEmail" name="email" placeholder="name@example.com">
                      @error('email')
                          <small>{{ $message }}</small>
                      @enderror
                  </div>
                  <div class="mb-3">
                      <label for="signInPassword" class="form-label">Password</label>
                      <input type="password" class="form-control" id="signInPassword" name="password" placeholder="Password">
                      @error('password')
                          <small>{{ $message }}</small>
                      @enderror
                  </div>
                  <button type="submit" class="btn btn-primary w-100">Sign In</button>
                  <p class="d-flex justify-content-center mt-3">Don't have an account yet? <a href="#" data-bs-toggle="modal" data-bs-target="#signUp" class="ms-1">Sign Up</a></p>
                </form>
          </div>
      </div>
  </div>
</div>

<div class="modal fade" id="signUp" tabindex="-1" aria-labelledby="signUpLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="signUpLabel">Sign Up</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                <form method="POST" action="{{ route('signup_process') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="signUpUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="signUpUsername" name="username" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label for="signUpEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="signUpEmail" name="email" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="signUpPhone" class="form-label">No HP</label>
                        <input type="number" class="form-control" id="signUpPhone" name="phone" placeholder="08123xxxxxxx">
                    </div>
                    <div class="mb-3">
                        <label for="signUpAddres" class="form-label">Addres</label>
                        <div class="d-flex gap-2">
                            <select name="address" id="signUpAddresKota" class="form-select">
                                <option selected>Choose City</option>
                                <option value="Jakarta Utara">Jakarta Utara</option>
                                <option value="Jakarta Timur">Jakarta Timur</option>
                                <option value="Jakarta Barat">Jakarta Barat</option>
                                <option value="Jakarta Pusat">Jakarta Pusat</option>
                                <option value="Jakarta Selatan">Jakarta Selatan</option>
                            </select>
                            <input type="text" class="form-control" id="signUpAddresDetail" name="detailed_address" placeholder="*detailed addres">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="signUpPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signUpPassword" name="password" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    <p class="d-flex justify-content-center mt-3">Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signIn" class="ms-1">Sign In</a></p>
                </form>
          </div>
      </div>
  </div>
</div>