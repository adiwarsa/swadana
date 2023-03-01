<x-landingpage bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.navs.navbar></x-navbars.navs.navbar>
    <style>
        a{
        text-decoration: none !important;
      }
    </style>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Detail Car</h1>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/gambar/' . $car->gambar) }}"
                            alt="{{ $car->nama_mobil }}" />
                        <!-- Product details-->
                        <div class="card-body card-body-custom pt-4">
                            <div>
                                <!-- Product name-->
                                <h3 class="fw-bolder text-primary">Description</h3>
                                <p>
                                    {{$car->deskripsi}}
                                </p>
                                <div class="mobil-info-list border-top pt-4">
                                    <ul class="list-unstyled">
                                        @foreach ($car->categories as $category)
                                            <li>
                                                <ion-icon name="checkmark-circle-outline"></ion-icon>
                                                {{ $category->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <!-- Product details-->
                        <div class="card-body card-body-custom pt-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="fw-bolder">{{ $car->nama_mobil }}</h5>
                                    <div class="rent-price mb-3">
                                        <span style="font-size: 1rem"
                                            class="text-primary">Rp.{{ $car->harga_sewa }}/</span>day
                                    </div>
                                </div>
                                <ul class="list-unstyled list-style-group">
                                    <li class="border-bottom p-2 d-flex justify-content-between">
                                        <span>Fuel</span>
                                        <span style="font-weight: 600">{{ $car->bahan_bakar }}</span>
                                    </li>
                                    <li class="border-bottom p-2 d-flex justify-content-between">
                                        <span>Seats</span>
                                        <span style="font-weight: 600">{{ $car->jumlah_kursi }}</span>
                                    </li>
                                    <li class="border-bottom p-2 d-flex justify-content-between">
                                        <span>Transmission</span>
                                        @if($car->transmisi != 'otomatis')
                                        <span style="font-weight: 600">Manual</span>
                                        @else
                                        <span style="font-weight: 600">Automatic</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer border-top-0 bg-transparent">
                            <div class="text-center">
                                @if(!Auth::guest())
                                    @if($car->status == 'tersedia')
                                <a class="btn d-flex align-items-center justify-content-center btn-primary mt-auto"
                                    data-bs-toggle="modal" id="rent_add" data-bs-target="#addnew"
                                    href="javascript:void(0)" style="column-gap: 0.4rem">Rent <i
                                        class="ri-whatsapp-line"></i></a>
                                    @else
                                    <a>Not Available</a>
                                    @endif
                                @else
                                <a class="btn d-flex align-items-center justify-content-center btn-primary mt-auto"
                                    href="{{ route('register') }}" style="column-gap: 0.4rem">Rent Car <i
                                        class="ri-whatsapp-line"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="addnew" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <form name="rent_add" id="rent_add" class="form-horizontal" action="{{ route('rentCustomer-add', $car->slug) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Rent a Car</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row mt-2">
                          <div class="mb-3 col-md-6">
                              <label class="form-label">Rent Date</label>
                              <input required type="date" class="form-control border border-2 p-2" id="rent_start_date" name="rent_date">
                          </div>
                          <div class="mb-3 col-md-6">
                              <label class="form-label">Return Date</label>
                              <input type="date" class="form-control border border-2 p-2" id="rent_end_date" name="return_date">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="delivery">Delivery</label>
                          <input type="text" class="form-control border border-2 p-2" id="delivery" name="delivery">
                      </div>
                      <div class="form-group" id="rental-price-group" style="display: none;">
                          <label for="rent_price">Rental Price</label>
                          <input type="text" class="form-control border border-2 p-2" id="rent_price" readonly>
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Book now</button>
                  </div>
              </div>
          </form>
      </div>
  </div>
  
</x-landingpage>
<script>
  // Listen to the start and end date fields and update the price field
    const startDateField = document.getElementById('rent_start_date');
    const endDateField = document.getElementById('rent_end_date');
    const rentalPrice = {{ $car->harga_sewa }};
    const priceGroup = document.getElementById('rental-price-group');
    const priceField = document.getElementById('rent_price');

    function updatePriceField() {
      const startDate = startDateField.value;
      const endDate = endDateField.value;

      if (startDate && endDate) {
        const diffTime = Math.abs(new Date(endDate) - new Date(startDate));
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        const total = diffDays * rentalPrice;
        priceField.value = `Rp.${total}`;
        priceGroup.style.display = 'block';
      } else {
        priceField.value = '';
        priceGroup.style.display = 'none';
      }
    }

    startDateField.addEventListener('change', updatePriceField);
    endDateField.addEventListener('change', updatePriceField);
</script>




