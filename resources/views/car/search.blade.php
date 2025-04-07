<x-app-layout title="Search Car Page">

    <main>
        @if(Session::has('success'))

    <div class="container my-large">
    <div class="success-message">{{Session::get('success')}}</div>
    </div>

  @elseif(Session::has('error'))
    <div class="container my-large">
    <div class="error-message">{{Session::get('error')}}</div>
    </div>
  @endif
        <!-- Found Cars -->
        <section>
            <div class="container">
                <div class="sm:flex items-center justify-between mb-medium">
                    <div class="flex items-center">
                        <button class="show-filters-button flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" style="width: 20px">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                            </svg>
                            Filterss
                        </button>
                        <h2>Define your search criteria</h2>
                    </div>
    
                  <form action="{{ route('car.search') }}" method="POST" class="find-a-car-form">
    @csrf
    <!-- your form fields including the select -->
  <select name="priceorder" onchange="this.form.submit()">
    <option value="">Order By</option>
    <option value="asc" {{ old('priceorder', $request->priceorder ?? '') == 'asc' ? 'selected' : '' }}>Price Asc</option>
    <option value="desc" {{ old('priceorder', $request->priceorder ?? '') == 'desc' ? 'selected' : '' }}>Price Desc</option>
</select>

</form>


                </div>
                <div class="search-car-results-wrapper">
                    <div class="search-cars-sidebar">
                        <div class="card card-found-cars">
                            <p class="m-0">Found 
                                @if ($cars->isNotEmpty())
    <p> <strong>{{ $cars->total() }}</strong> cars</p>
    @else
    <p><strong>No</strong> cars</p>
@endif
                            
    
                            <button class="close-filters-button">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width: 24px">
                                    <path fill-rule="evenodd"
                                        d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
    
                        <!-- Find a car form -->
                        <section class="find-a-car">
                            <form action="{{route('car.search')}}" method="POST" class="find-a-car-form card flex p-medium">
                                @csrf
                                <div class="find-a-car-inputs">
                                    <div class="form-group">
                                        <label class="mb-medium">Maker</label>
                                         <select name="maker_id" id="makerSelect">
                                         <option value="">Maker</option>
                                            @foreach ($makers as $maker)
                                        <option value="{{$maker->id}}">{{$maker->name}}</option>
                                  
                                            @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Model</label>
                                         <select  name="model_id" >
                                   <option value="">Model</option>
                                            @foreach ($models as $model)
                                        <option value="{{$model->id}}">{{$model->name}}</option>
                                  
                                            @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Type</label>
                                        <select name="car_type_id">
                         <option value="">Car Type</option>
                         @foreach ($cartypes as $cartype)
                        <option value="{{$cartype->id}}">{{$cartype->name}}</option>
                        
                        @endforeach
                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Year</label>
                                        <div class="flex gap-1">
                                             <select  name="year_from">
                                   <option value="">Year From</option>
                                 
                                            @foreach ($years as $year)
                                        <option value={{$year}}>{{$year}}</option>
                                  
                                            @endforeach
                                    </select>
                                              <select  name="year_to">
                                   <option value="">Year To</option>
                                 
                                            @foreach ($years as $year)
                                        <option value={{$year}}>{{$year}}</option>
                                  
                                            @endforeach
                                    </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Price</label>
                                        <div class="flex gap-1">
                                            <input type="number" placeholder="Price From" name="price_from" />
                                            <input type="number" placeholder="Price To" name="price_to" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Mileage</label>
                                        <div class="flex gap-1">
                                            <select name="mileage">
    <option value="">Any Mileage</option>
    @foreach($mileages as $step)
        <option value="{{ $step }}">{{ number_format($step) }} or less</option>
    @endforeach
</select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">State</label>
                                        <select id="stateSelect" name="state_id">
                        <option value="">State/Region</option>
                        @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                
                                 
                                            @endforeach
                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">City</label>
                                        <select name="city_id">
                        <option value="">City</option>
                        @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                
                                 
                                            @endforeach
                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-medium">Fuel Type</label>
                                        <select name="fuel_type_id">
                                            <option value="">Fuel Type</option>
                                            <option value="2">Diesel</option>
                                            <option value="3">Electric</option>
                                            <option value="1">Gasoline</option>
                                            <option value="4">Hybrid</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button type="button" class="btn btn-find-a-car-reset">
                                        Reset
                                    </button>
                                    <button class="btn btn-primary btn-find-a-car-submit">
                                        Search
                                    </button>
                                </div>
                            </form>
                        </section>
                        <!--/ Find a car form -->
                    </div>
    
                    <div class="search-cars-results">
                        <div class="car-items-listing">
                           @foreach ($cars as $car)
                               <x-car-item  :$car/>
                           @endforeach
                        </div>
                        {{-- {{$cars->links('pagination')}} --}}
                        {{$cars->onEachSide(1)->links()}}
                    {{-- This determines how many additional page numbers appear on each side of the current page in the pagination links. --}}

                    </div>
                </div>
            </div>
        </section>
        <!--/ Found Cars -->
    </main>

</x-app-layout>