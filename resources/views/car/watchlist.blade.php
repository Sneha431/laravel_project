@props(['car', 'isInwatchlist' => false,'favouriteCarIds'=>[],'watchlisted'=>true])
<x-app-layout title="Show Watchlist Page" >
    <main>
        <!-- New Cars -->
        <section>
            <div class="container">
               
                <div class="flex justify-between items-center">
                    <h2>My Favourite Cars</h2>
                    @if ($cars->total() > 0)
                        <div class="pagination-summary">
                            <p>
                                Showing {{$cars->firstItem()}} to {{$cars->lastItem()}} of
                                {{$cars->total()}} results
                            </p>
                        </div>
                    @endif
                </div>
                <div class="car-items-listing">
               
              @foreach ($cars as $car)
                  <x-car-item :$car :isInwatchlist="true" :$watchlisted/>
              @endforeach

              @if ($cars->total() == 0)
                  <p class="text-center">No cars added to watchlist</p>
              @endif
    </div>
                {{$cars->onEachSide(1)->links()}}
            </div>
        </section>
        <!--/ New Cars -->
    </main>

</x-app-layout>