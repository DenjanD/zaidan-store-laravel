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
                <h2 class="dashboard-title">My Account</h2>
                <p class="dashboard-subtitle">Update your current profile</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-12">
                    <form action="{{ route('dashboard-settings-redirect','dashboard-settings-account') }}" method="post" enctype="multipart/form-data" id="locations">
                      @csrf
                      <div class="card">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="name">Your Name</label>
                                <input
                                  type="text"
                                  id="name"
                                  name="name"
                                  value="{{ $user->name }}"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="email">Your Email</label>
                                <input
                                  type="email"
                                  id="email"
                                  name="email"
                                  value="{{ $user->email }}"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="address1">Address 1</label>
                                <input
                                  type="text"
                                  id="address_one"
                                  name="address_one"
                                  value="{{ $user->address_one }}"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="address2">Address 2</label>
                                <input
                                  type="text"
                                  id="address_two"
                                  name="address_two"
                                  value="{{ $user->address_two }}"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="province_id">Province</label>
                                <select name="province_id" id="province_id" class="form-control" v-if="provinces" v-model="province_id">
                                  <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                </select>
                                <select v-else class="form-control"></select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="regency_id">Regency</label>
                                <select name="regency_id" id="regency_id" class="form-control" v-if="regencies" v-model="regency_id">
                                  <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                </select>
                                <select v-else class="form-control"></select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="postalCode">Postal Code</label>
                                <input
                                  type="text"
                                  id="zip_code"
                                  name="zip_code"
                                  value="{{ $user->zip_code }}"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="country">Country</label>
                                <input
                                  type="text"
                                  id="country"
                                  name="country"
                                  value="{{ $user->country }}"
                                  class="form-control"
                                />
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input
                                  type="text"
                                  id="phone"
                                  name="phone"
                                  value="{{ $user->phone }}"
                                  class="form-control"
                                />
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

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          AOS.init();
          this.getProvincesData();
        },
        data: {
          provinces: null,
          regencies: null,
          province_id: null,
          regency_id: null
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route("api-provinces") }}')
              .then(function(response){
                self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
            axios.get('{{ url("api/regencies") }}'+ '/' + self.province_id)
              .then(function(response){
                self.regencies = response.data;
              })
          }
        },
        watch: {
          province_id: function(val, oldVal) {
            this.regency_id = null;
            this.getRegenciesData();
          }
        }
      });
    </script>
@endpush