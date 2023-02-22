<x-landingpage bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.navs.navbar></x-navbars.navs.navbar>
    
    {{-- CSS --}}
    <style>
      .select2-container--default .select2-selection--multiple {
        background-color: transparent !important;
        border: none !important;
      }
      a{
        text-decoration: none !important;
      }
    </style>
    {{--  --}}

    <section class="section hero" id="home">
        <div class="container">

            <div class="hero-content">
                <h2 class="h1 hero-title">The easy way to takeover a lease</h2>

                <p class="hero-text">
                    Live in Bali, New Jerset and Connecticut!
                </p>
            </div>

            <div class="hero-banner"></div>

            <form action="" class="hero-form" method="get">
                <div class="input-wrapper">
                    <label for="input-1" class="input-label">Car, model, or brand</label>
                    <input type="text" name="nama_mobil" id="input-1" class="input-field"
                        placeholder="What car are you looking?">
                </div>

                <div class="input-wrapper">
                  <label for="input-2" class="input-label">Seats</label>
                    <input type="number" name="jumlah_kursi" id="input-2" class="input-field"
                        placeholder="How many seat">
                </div>

                <button type="submit" class="btn btn-primary rounded-3">Search</button>

            </form>

        </div>
    </section>

    <section class="section featured-car" id="featured-car">
        <div class="container">
            <div class="title-wrapper">
                <a href="{{ route('pub-index') }}"><h2 class="h2 section-title">Featured cars</h2></a>

            </div>
            <ul class="featured-car-list">
                @foreach ($car as $item)
                    <li>
                        <div class="featured-car-card">

                            <figure class="card-banner">

                                <img src="{{ asset('storage/gambar/' . $item->gambar) }}" loading="lazy" width="440"
                                    height="300" class="w-100">
                            </figure>
                            <div class="card-content">
                                <div class="card-title-wrapper">
                                    <h3 class="h3 card-title">
                                        <a href="{{ route('detail', $item->slug) }}">{{ $item->nama_mobil }}</a>
                                    </h3>

                                    <data class="year text-uppercase">{{ ucfirst( $item->categories->first()->name) }}</data>
                                </div>

                                <ul class="card-list">

                                    <li class="card-list-item">
                                        <ion-icon name="people-outline"></ion-icon>

                                        <span class="card-item-text">{{ $item->jumlah_kursi }}</span>
                                    </li>

                                    <li class="card-list-item">
                                        <ion-icon name="flash-outline"></ion-icon>
                                        @if($item->transmisi != 'otomatis')
                                        <span class="card-item-text">Manual</span>
                                        @else
                                        <span class="card-item-text">Automatic</span>
                                        @endif
                                    </li>

                                    <li class="card-list-item">
                                        <ion-icon name="speedometer-outline"></ion-icon>

                                        <span class="card-item-text">{{ ucfirst($item->bahan_bakar) }}</span>
                                    </li>

                                    <li class="card-list-item">
                                        @foreach ($item->categories as $category)
                                            <ion-icon name="checkmark-done-outline"></ion-icon>
                                            <span class="card-item-text">{{ ucfirst($category->name) }}</span>
                                        @endforeach
                                    </li>

                                </ul>

                                <div class="card-price-wrapper">

                                    <p class="card-price">
                                        <strong>Rp.{{ number_format($item->harga_sewa) }}</strong> / day
                                    </p>
                                    @if($item->status == 'tersedia')
                                    <a href="{{ route('detail', $item->slug) }}">
                                    <button class="btn btn-primary">Rent now</button>
                                    </a>
                                    @else
                                    <button class="btn btn-primary">Not Available</button>
                                    @endif

                                </div>

                            </div>

                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section class="section featured-car" id="featured-motor">
        <div class="container">
            <div class="title-wrapper">
                <a href="{{ route('pub-index') }}"><h2 class="h2 section-title">Featured motorcycle</h2></a>
            </div>
            <ul class="featured-car-list">
                @foreach ($motor as $item)
                    <li>
                        <div class="featured-car-card">

                            <figure class="card-banner">

                                <img src="{{ asset('storage/gambar/' . $item->gambar) }}" loading="lazy" width="440"
                                    height="300" class="w-100">
                            </figure>
                            <div class="card-content">
                                <div class="card-title-wrapper">
                                    <h3 class="h3 card-title">
                                        <a href="{{ route('detail', $item->slug) }}">{{ $item->nama_motor }}</a>
                                    </h3>

                                    <data class="year text-uppercase">{{ ucfirst( $item->categories->first()->name) }}</data>
                                </div>

                                <ul class="card-list">

                                    <li class="card-list-item">
                                        <ion-icon name="flash-outline"></ion-icon>
                                        @if($item->transmisi != 'otomatis')
                                        <span class="card-item-text">Manual</span>
                                        @else
                                        <span class="card-item-text">Automatic</span>
                                        @endif
                                    </li>

                                    <li class="card-list-item">
                                        <ion-icon name="speedometer-outline"></ion-icon>

                                        <span class="card-item-text">{{ ucfirst($item->bahan_bakar) }}</span>
                                    </li>

                                    <li class="card-list-item">
                                        @foreach ($item->categories as $category)
                                            <ion-icon name="checkmark-done-outline"></ion-icon>
                                            <span class="card-item-text">{{ ucfirst($category->name) }}</span>
                                        @endforeach
                                    </li>

                                </ul>

                                <div class="card-price-wrapper">

                                    <p class="card-price">
                                        <strong>Rp.{{ number_format($item->harga_sewa) }}</strong> / day
                                    </p>
                                    @if($item->status == 'tersedia')
                                    <a href="{{ route('detailmotor', $item->slug) }}">
                                    <button class="btn btn-primary">Rent now</button>
                                    </a>
                                    @else
                                    <button class="btn btn-primary">Not Available</button>
                                    @endif

                                </div>

                            </div>

                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
    {{-- <!--Select 2-->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
        </script> --}}

</x-landingpage>
