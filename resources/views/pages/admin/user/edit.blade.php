@extends('layouts.admin')

@section('title')
    Edit User
@endsection

@section('content')
<!-- Section Content -->
          <div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">User</h2>
                <p class="dashboard-subtitle">Edit User</p>
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
                        <form action="{{ route('user.update', $item->user_id) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                      <label>Nama User</label>
                                      <input type="text" name="name" id="" class="form-control" required placeholder="" aria-describedby="helpId" value="{{ $item->name }}">
                                    </div>
                                    <div class="form-group">
                                      <label>Email User</label>
                                      <input type="email" name="email" id="" class="form-control" required placeholder="" aria-describedby="helpId" value="{{ $item->email }}">
                                    </div>
                                    <div class="form-group">
                                      <label>Password User</label>
                                      <input type="password" name="password" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                      <small>Kosongkan jika tidak dirubah</small>
                                    </div>
                                    <div class="form-group">
                                      <label>Roles</label>
                                      <select name="roles" required class="form-control">
                                          <option value="{{ $item->roles }}" selected>Tidak Diganti</option>
                                          <option value="ADMIN">Admin</option>
                                          <option value="USER">User</option>
                                      </select>
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