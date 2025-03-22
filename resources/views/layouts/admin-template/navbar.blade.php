<nav class="navbar">
    <div class="nav-left">
        <a href="{{ route('admin.add_product') }}" class="nav-link">+ ADD PRODUCT</a>
        <a href="{{ route('admin.admin_home') }}" class="nav-link">PRODUCT</a>
    </div>
    <div class="nav-center">
        <img src="{{ asset('assets/logo/logo_bakery.png') }}" alt="Bakery Logo" class="logo">
    </div>
    <div class="nav-rights">
        <a href="{{ route('admin.transaction') }}" class="nav-link">TRANSACTION</a>
        <a href="{{ route('admin.admin_profile') }}" class="nav-link"><img src="{{ asset('assets/logo/profile.png') }}" alt="Profile Logo" class="logo-right"></a>
    </div>
</nav>