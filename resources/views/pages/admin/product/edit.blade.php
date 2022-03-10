@extends('layouts.admin')

@section('title')
    Edit Product
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">Edit Product</p>
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
                        <form action="{{ route('product.update', $item->product_id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Nama Product</label>
                                      <input type="text" name="name" id="" class="form-control" value="{{ $item->name }}" required placeholder="" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                      <label>Pemilik Product</label>
                                      <select name="user_id" class="form-control" id="">
                                        <option selected value="{{ $item->user_id }}">{{ $item->user->name }}</option>
                                        @foreach ($user as $u)
                                          <option value="{{ $u->user_id }}">{{ $u->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Kategori Product</label>
                                      <select name="category_id" class="form-control" id="">
                                        <option selected value="{{ $item->category_id }}">{{ $item->category->name }}</option>
                                        @foreach ($category as $c)
                                          <option value="{{ $c->category_id }}">{{ $c->name }}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Harga Product</label>
                                      <input type="number" name="price" id="" class="form-control" value="{{ $item->price }}" required placeholder="" aria-describedby="helpId">
                                    </div>
                                    <div class="form-group">
                                      <label>Deskripsi Product</label>
                                      <textarea name="description" id="editor">{!! $item->description !!}</textarea>
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
@push('addon-script')
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');
</script>
@endpush