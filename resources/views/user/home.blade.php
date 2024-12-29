@extends('layouts.user')

@section('content')
<section id="beranda">
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

{{-- <div class="row row-cols-1 row-cols-md-3 g-4 mt-3 mb-5">
    <div class="col">
      <div class="card" style="height: 25rem;">
        <img src="{{ asset('assets/product/sea(22).png')}}" alt="tes">
      </div>
      <div class="mt-2 ml-5">
        <h5 class="card-title">Produk 1</h5>
        <p class="card-text">Rp40.000</p>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="{{ asset('assets/product/sea(22).png')}}" class="card-img-top" alt="tes">
        <div class="card-body">
          <h5 class="card-title">Produk 1</h5>
          <p class="card-text">Rp40.000</p>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <img src="{{ asset('assets/product/sea(22).png')}}" class="card-img-top" alt="tes">
        <div class="card-body">
          <h5 class="card-title">Produk 1</h5>
          <p class="card-text">Rp40.000</p>
        </div>
      </div>
    </div>
</div> --}}

<h2 class="mt-3">Cheese Cakes</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card">
      <img src="{{ asset('assets/product/pistachio cheesecake.png')}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="{{ asset('assets/product/pistachio cheesecake.png')}}" class="card-img-top" alt="...">
      <div class="card-body" style="">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="{{ asset('assets/product/pistachio cheesecake.png')}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="{{ asset('assets/product/pistachio cheesecake.png')}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="{{ asset('assets/product/pistachio cheesecake.png')}}" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
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