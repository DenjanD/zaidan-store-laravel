@extends('layouts.app')

@section('title')
    Store Category Page
@endsection

@section('content')
<div class="page-content page-home">
      <!-- All Categories -->
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>All Categories</h5>
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

      <!-- All Products -->
      <section class="store-new-products">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>All Products</h5>
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
          <div class="row">
            <div class="col-12 mt-4">
              {{ $products->links() }}
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
@endsection