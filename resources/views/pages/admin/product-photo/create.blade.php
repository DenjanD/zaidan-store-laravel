@extends('layouts.admin')

@section('title')
    Add New Photo
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product Photo</h2>
                <p class="dashboard-subtitle">Add New Photo</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-12">
                      @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                      @endif
                    <div class="card">
                      <div class="card-body">
                        <form action="{{ route('product-photo.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Product</label>
                                      <select name="product_id" class="form-control" id="">
                                        @foreach ($product as $p)
                                          <option value="{{ $p->product_id }}">{{ $p->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="">Foto Product</label>
                                      <input type="file" name="name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-5">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection