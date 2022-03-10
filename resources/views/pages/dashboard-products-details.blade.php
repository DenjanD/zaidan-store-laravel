@extends('layouts.dashboard')

@section('title')
    Dashboard Product - Details
@endsection

@section('content')
<!-- Section Content -->
         <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Shirup Marzan</h2>
                <p class="dashboard-subtitle">Product Details</p>
              </div>
              <div class="dashboard-content">
                <div class="row mt-4">
                  <div class="col-12">
                    @if($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                    @endif
                    <form action="{{ route('dashboard-products-update', $products->product_id) }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Product Name</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="name"
                                  value="{{ $products->name }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Price</label>
                                <input
                                  type="number"
                                  class="form-control"
                                  name="price"
                                  value="{{ $products->price }}"
                                />
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" id="">
                                  <option value="{{ $products->category_id }}">{{ $products->category->name }}</option>
                                  @foreach ($categories as $c)
                                    <option value="{{ $c->category_id }}">{{ $c->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="editor">{!! $products->description !!}</textarea>
                              </div>
                            </div>
                            <div class="col-12">
                              <button
                                type="submit"
                                class="btn btn-success btn-block mb-3 px-5"
                              >
                                Update Product
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          @foreach($products->photos as $photos)
                          <div class="col-md-4">
                            <div class="gallery-container">
                              <img
                                src="{{ Storage::url($photos->name ?? '') }}"
                                alt=""
                                class="w-100"
                              />
                              <a href="{{ route('dashboard-products-photos-delete', $photos->photo_id) }}" class="delete-gallery">
                                <img src="{{ url('images/icon-delete.svg') }}" alt="" />
                              </a>
                            </div>
                          </div>
                          @endforeach
                          <div class="col-12 mt-2">
                            <form action="{{ route('dashboard-products-photos-upload') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="product_id" value="{{ $products->product_id }}">
                              <input
                                type="file"
                                name="name"
                                id="file"
                                style="display: none"
                                onchange="form.submit()"
                              />
                              <button
                                type="button"
                                class="btn btn-secondary btn-block mt-2"
                                onclick="thisFileUpload()"
                              >
                                Add Photo
                              </button>
                            </form>    
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
      function thisFileUpload() {
        document.getElementById("file").click();
      }
    </script>
    <script>
      CKEDITOR.replace("editor");
    </script>
@endpush