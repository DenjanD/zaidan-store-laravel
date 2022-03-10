@extends('layouts.app')

@section('title')
    Store Homepage
@endsection

@section('content')
<div class="page-content page-home">
      <!-- Carousel -->
      <section class="store-carousel">
        <div class="container">
          <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
              <div
                id="storeCarousel"
                class="carousel slide"
                data-ride="carousel"
              >
                <ol class="carousel-indicators">
                  <li
                    class="active"
                    data-target="#storeCarousel"
                    data-slide-to="0"
                  ></li>
                  <li data-target="#storeCarousel" data-slide-to="1"></li>
                  <li data-target="#storeCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      src="/images/banner.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="/images/banner.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="/images/banner.jpg"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Trend Categories -->
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Trend Categories</h5>
            </div>
          </div>
          <div class="row">
            @php $incrementCategory = 0; @endphp
            @forelse ($categories as $c)
              <div
              class="col-6 col-md-3 col-lg-2"
              data-aos="fade-up"
              data-aos-delay="{{ $incrementCategory += 100 }}"
              >
                <a href="{{ route('categories-detail',$c->slug) }}" class="component-categories d-block">
                  <div class="categories-image">
                    <img src="{{ Storage::url($c->icon) }}" alt="" class="w-100" />
                  </div>
                  <p class="categories-text">{{ $c->name }}</p>
                </a>
              </div>
            @empty
              <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                No Categories Now
              </div>
            @endforelse
          </div>
        </div>
      </section>

      <!-- New Products -->
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>New Products</h5>
            </div>
          </div>
          <div class="row">
            @php $incrementProduct = 0; @endphp
            @forelse ($products as $p)
              <div
                class="col-6 col-md-4 col-lg-3"
                data-aos="fade-up"
                data-aos-delay="{{ $incrementProduct =+ 100 }}"
              >
              <a href="{{ route('detail', $p->slug) }}" class="component-products d-block">
                <div class="products-thumbnail">
                  <div
                    class="products-image"
                    style="@if($p->photos->count()) background-image: url('{{ Storage::url($p->photos->first()->name) }}') @else background-color: #eee @endif"
                  ></div>
                </div>
                <div class="products-text">{{ $p->name }}</div>
                <div class="products-price">{{ $p->price }}</div>
              </a>
            </div> 
            @empty
              <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                No Products Now
              </div>
            @endforelse
         </div>
        </div>
      </section>
    </div>
@endsection