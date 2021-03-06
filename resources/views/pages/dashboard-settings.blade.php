@extends('layouts.dashboard')

@section('title')
    Dashboard
@endsection

@section('content')
<!-- Section Content -->
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Store Settings</h2>
                <p class="dashboard-subtitle">Make store that profitable</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    <form action="{{ route('dashboard-settings-redirect','dashboard-settings-store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Store Name</label>
                                <input type="text" name="store_name" value="{{ $user->store_name }}" class="form-control" />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control" id="">
                                  <option value="{{ $user->category_id }}">Tidak diganti</option>
                                  @foreach ($categories as $c)
                                    <option value="{{ $c->category_id }}">{{ $c->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Store</label>
                                <p class="text-muted">
                                  Apakah anda juga ingin membuka toko?
                                </p>
                                <div
                                  class="custom-control custom-radio custom-control-inline"
                                >
                                  <input
                                    type="radio"
                                    name="store_status"
                                    id="openStoreTrue"
                                    value="1"
                                    {{ $user->store_status == 1 ? 'checked' : '' }}
                                    class="custom-control-input"
                                  />
                                  <label
                                    for="openStoreTrue"
                                    class="custom-control-label"
                                    >Buka</label
                                  >
                                </div>
                                <div
                                  class="custom-control custom-radio custom-control-inline"
                                >
                                  <input
                                    type="radio"
                                    name="store_status"
                                    id="openStoreFalse"
                                    value="0"
                                    {{ $user->store_status == 0 || $user->store_status == NULL ? 'checked' : '' }}
                                    class="custom-control-input"
                                  />
                                  <label
                                    for="openStoreFalse"
                                    class="custom-control-label"
                                    >Sementara Tutup</label
                                  >
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col text-right">
                              <button
                                type="submit"
                                class="btn btn-success px-5"
                              >
                                Save Now
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection