@extends('layouts.dashboard')

@section('title')
    Dashboard Product - Create
@endsection

@section('content')
<!-- Section Content -->
 <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Create New Product</h2>
                <p class="dashboard-subtitle">Create your own product</p>
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
                    <form action="{{ route('dashboard-products-store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" name="name"/>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Price</label>
                                <input type="number" class="form-control" name="price"/>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" id="">
                                  @foreach ($categories as $c)
                                    <option value="{{ $c->category_id }}">{{ $c->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Description</label>
                                <textarea
                                  name="description"
                                  id="editor"
                                ></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Thumbnails</label>
                                <input type="file" class="form-control" name="photoName"/>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    
                  </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-success btn-block mt-3 mb-5 px-5">
                        Create Product
                      </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'editor' );
    </script>
@endpush