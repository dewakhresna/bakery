@extends('layouts.user')

@section('content')
<section id="home">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('assets/banner/banner_1.png')}}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('assets/banner/banner_2.png')}}" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden ">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<div class="button-menu">
  <a href="#" class="btn btn1" role="button" data-bs-toggle="button">Cupcakes</a>
  <a href="#" class="btn btn2" role="button" data-bs-toggle="button">Cookies</a>
  <a href="#" class="btn btn3" role="button" data-bs-toggle="button">Cheesecakes</a>
</div>

<h2 class="mt-3">Cupcakes</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach ($cupcakes as $cupcake)
  <div class="col">
    @if(Auth::check())
      <a href="{{ route('user.add_cart', ['id' => $cupcake->id])}}" class="link-product">
    @else
      <a href="#signin" class="link-product" data-bs-toggle="modal" data-bs-target="#signIn">
    @endif
      <div class="card">
        <img src="{{ asset('assets/product/' . $cupcake->product_image)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $cupcake->product_name }}</h5>
          <p class="card-text">Rp{{ number_format($cupcake->price, 0, ',', '.')}}</p>
        </div>
      </div>
    </a>
  </div>
  @endforeach
</div>

<h2 class="mt-3">Cookies</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach ($cookies as $cookie)
  <div class="col">
    @if(Auth::check())
      <a href="{{ route('user.add_cart', ['id' => $cookie->id])}}" class="link-product">
    @else
      <a href="#signin" class="link-product" data-bs-toggle="modal" data-bs-target="#signIn">
    @endif
      <div class="card">
        <img src="{{ asset('assets/product/' . $cookie->product_image)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $cookie->product_name }}</h5>
          <p class="card-text">Rp{{ number_format($cookie->price, 0, ',', '.')}}</p>
        </div>
      </div>
    </a>
  </div>
  @endforeach
</div>

<h2 class="mt-3">Cheese Cakes</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  @foreach ($cheesecakes as $cheesecake)
  <div class="col">
    @if(Auth::check())
      <a href="{{ route('user.add_cart', ['id' => $cheesecake->id])}}" class="link-product">
    @else
      <a href="#signin" class="link-product" data-bs-toggle="modal" data-bs-target="#signIn">
    @endif
      <div class="card">
        <img src="{{ asset('assets/product/' . $cheesecake->product_image)}}" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{ $cheesecake->product_name }}</h5>
          <p class="card-text">Rp{{ number_format($cheesecake->price, 0, ',', '.')}}</p>
        </div>
      </div>
    </a>
  </div>
  @endforeach
</div>

<div class="location-section" id="location">
    <h2 class="location-title">Store Location</h2>
    <div class="map-container">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d7932.6648676998275!2d106.82843543552225!3d-6.219820009343367!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sEpicentrum%2C%20Jl.%20H.%20R.%20Rasuna%20Said%20No.Kav.%2022%202%2C%20RT.2%2FRW.5%2C%20Karet%20Kuningan%2C%20Jakarta%2012940!5e0!3m2!1sid!2sid!4v1735033390895!5m2!1sid!2sid"
        allowfullscreen
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        class="map-iframe"
      ></iframe>
    </div>
    <div class="location-info">
      <h3 class="location-city">JAKARTA</h3>
      <p class="location-address">
        Epicentrum, Jl. H. R. Rasuna Said No.Kav. 22 2, RT.2/RW.5, Karet Kuningan, Jakarta 12940
      </p>
    </div>
</div>
@endsection