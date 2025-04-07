{{-- <div>
    {{$test()}}
</div> --}}
<!-- Find a car form -->

@props(['cars', 'action','makers', 'models', 'years', 'states', 'cities', 'cartypes', 'fueltypes'])
<section class="find-a-car">
    <div class="container">
        <form action="{{route('car.search')}}" method="POST" class="find-a-car-form card flex p-medium">
            @csrf
            <div class="find-a-car-inputs">
                <div>
                   
                        <select name="maker_id" id="makerSelect">
                                         <option value="">Maker</option>
                                            @foreach ($makers as $maker)
                                        <option value="{{$maker->id}}">{{$maker->name}}</option>
                                  
                                            @endforeach
                                    </select>
                    
                </div>
                <div>
                    <select  name="model_id" >
                                   <option value="">Model</option>
                                            @foreach ($models as $model)
                                        <option value="{{$model->id}}">{{$model->name}}</option>
                                  
                                            @endforeach
                                    </select>
                   
                  
                </div>
                <div>
                    <select id="stateSelect" name="state_id">
                        <option value="">State/Region</option>
                        @foreach ($states as $state)
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                
                                 
                                            @endforeach
                    </select>
                </div>
                <div>
                    <select name="city_id">
                        <option value="">City</option>
                        @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                
                                 
                                            @endforeach
                    </select>
                </div>
                <div>
                    <select name="car_type_id">
                         <option value="">Car Type</option>
                         @foreach ($cartypes as $cartype)
                        <option value="{{$cartype->id}}">{{$cartype->name}}</option>
                        
                        @endforeach
                    </select>
                </div>
                <!-- <div>
                   
                                    <select  name="year">
                                   <option value="">Year</option>
                                 
                                            @foreach ($years as $year)
                                        <option value={{$year}}>{{$year}}</option>
                                  
                                            @endforeach
                                    </select>
                </div> -->
               
                <div>
                    <select name="fuel_type_id">
                          <option value="">Fuel Type</option>
                         @foreach ($fueltypes as $fueltype)
                        <option value="{{$fueltype->id}}"> {{$fueltype->name}}</option>
                        
                        @endforeach
                    </select>
                </div>
                
                                       
                                        <div>
                                             <select  name="year_from">
                                   <option value="">Year From</option>
                                 
                                            @foreach ($years as $year)
                                        <option value={{$year}}>{{$year}}</option>
                                  
                                            @endforeach
                                    </select>
                                    </div>
                                    <div>
                                         <select  name="year_to">
                                   <option value="">Year To</option>
                                 
                                            @foreach ($years as $year)
                                        <option value={{$year}}>{{$year}}</option>
                                  
                                            @endforeach
                                    </select>
                                    </div>
                                    
                                       
                                        <div>
                                            <input type="number" placeholder="Price From" name="price_from" />
                                            </div>
                                            <div>
                                            <input type="number" placeholder="Price To" name="price_to" />
                                        </div>
                                       
                                       
           
            <div class="flex-col">
               <input type="reset" value="Reset" class="reset_btn" style="width:84px;background-color: #e9580c;color:white">
               
                <button class="btn btn-primary btn-find-a-car-submit" style="width:84px;">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>
<!--/ Find a car form -->