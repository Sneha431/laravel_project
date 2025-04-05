@props(['cars', 'makers', 'models', 'years', 'states', 'cities', 'cartypes', 'fueltypes', 'carfeatures'])
<x-app-layout>
    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Edit Car: {{$car->maker->name}} {{$car->model->name}}
                - {{ $car->year }}
            </h1>
             <form action="{{ route('car.update', ['car' => $car->id]) }}" class="card add-new-car-form" method="POST">
                @csrf
    @method('PUT')
          
                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                      <select name="maker_id">
                                         <option value="">Maker</option>
                                            @foreach ($makers as $maker)
                                        <option value="{{$maker->id}}" @if ($maker->name == $car->maker->name) selected @endif>{{$maker->name}}</option>
                                  
                                            @endforeach
                                    </select>
                                    <p class="error-message">This field is required</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Model</label>
                                    <select  name="model_id">
                                   <option value="">Model</option>
                                            @foreach ($models as $model)
                                        <option value="{{$model->id}}"  @if ($model->name == $car->model->name) selected @endif>{{$model->name}}</option>
                                  
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select  name="year">
                                   <option value="">Year</option>
                                 
                                            @foreach ($years as $year)
                                        <option value={{$year}}  @if ($year == $car->year) selected @endif>{{$year}}</option>
                                  
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Car Type</label>
                        @foreach ($cartypes as $cartype)
                            <div class="row">

                                <div class="col">
                                    <label class="inline-radio">
                                        <input type="radio" name="car_type_id" value="{{$cartype->id}}"  
                                        @if ($cartype->name === $car->carType->name) checked @endif/>
                                        {{$cartype->name}}
                                    </label>
                                </div>

                                
    
                               
                            </div>
                                @endforeach
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Price  ($)</label>
                                    
                                    <input type="text" placeholder="Price" name="price" value="{{$car->price}}"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input placeholder="Vin Code" type="text" name="vin" value="{{$car->vin}}"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Mileage (ml)</label>
                                    <input placeholder="Mileage" type="text" name="mileage" value="{{$car->mileage}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Fuel Type</label>
                              @foreach ($fueltypes as $fueltype)
                            <div class="row">

                                <div class="col">
                                    <label class="inline-radio">
                                        <input type="radio" name="fuel_type_id" value="{{$fueltype->id}}"  
                                        @if ($fueltype->name === $car->fueltype->name) checked @endif/>
                                        {{$fueltype->name}}
                                    </label>
                                </div>

                                
    
                               
                            </div>
                                @endforeach
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>State/Region</label>
                                    
                                    <select name="state_id">
                                          <option value="">State/Region</option>
                                            @foreach ($states as $state)
                                        <option value="{{$state->id}}" @if ($state->id == $car->city->state_id) selected @endif>{{$state->name}}</option>
                                
                                 
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>City</label>
                                    <select name="city_id">
                                        <option value="">City</option>
                                          @foreach ($cities as $city)
                                        <option value="{{$city->id}}" @if ($city->id == $car->city_id) selected @endif>{{$city->name}}</option>
                                
                                 
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input placeholder="Address" value="{{$car->address}}" name="address"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input placeholder="Phone" value="{{$car->phone}}" name="phone"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           
                            <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label class="checkbox">
                      <input type="checkbox" name="air_conditioning" value="1"
                        @if ($carfeatures[0]['air_conditioning'] === 1) checked @endif>
                      Air Conditioning
                    </label>

                    <label class="checkbox">
                         <input type="checkbox" name="power_windows" value="1"
                        @if ($carfeatures[0]['power_windows'] === 1) checked @endif>
                      
                      Power Windows
                    </label>

                    <label class="checkbox">
                         <input type="checkbox" name="power_door_locks" value="1"
                        @if ($carfeatures[0]['power_door_locks'] === 1) checked @endif>
                     
                      Power Door Locks
                    </label>

                    <label class="checkbox">
                        <input type="checkbox" name="abs" value="1"
                        @if ($carfeatures[0]['abs'] === 1) checked @endif>
                      ABS
                    </label>

                    <label class="checkbox">
                         <input type="checkbox" name="cruise_control" value="1"
                        @if ($carfeatures[0]['cruise_control'] === 1) checked @endif>
                     
                      Cruise Control
                    </label>

                    <label class="checkbox">
                    
                         <input type="checkbox" name="bluetooth_connectivity" value="1"
                        @if ($carfeatures[0]['bluetooth_connectivity'] === 1) checked @endif>
                      Bluetooth Connectivity
                    </label>
                  </div>
                  <div class="col">
                    <label class="checkbox">
                          <input type="checkbox" name="remote_start" value="1"
                        @if ($carfeatures[0]['remote_start'] === 1) checked @endif>
                   
                      Remote Start
                    </label>

                    <label class="checkbox">
                          <input type="checkbox" name="gps_navigation" value="1"
                        @if ($carfeatures[0]['gps_navigation'] === 1) checked @endif>
                     
                      GPS Navigation System
                    </label>

                    <label class="checkbox">
                      
                        <input type="checkbox" name="heater_seats" value="1"
                        @if ($carfeatures[0]['heater_seats'] === 1) checked @endif>
                      Heater Seats
                    </label>

                    <label class="checkbox">
                           <input type="checkbox" name="climate_control" value="1"
                        @if ($carfeatures[0]['climate_control'] === 1) checked @endif>
                   
                      Climate Control
                    </label>

                    <label class="checkbox">
                            <input type="checkbox" name="rear_parking_sensors" value="1"
                        @if ($carfeatures[0]['rear_parking_sensors'] === 1) checked @endif>
                   
                      Rear Parking Sensors
                    </label>

                    <label class="checkbox">
                          <input type="checkbox" name="leather_seats" value="1"
                        @if ($carfeatures[0]['leather_seats'] === 1) checked @endif>
                   
                   
                      Leather Seats
                    </label>
                  </div>
                </div>
              </div>
                         
                        </div>
                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea rows="10" name="description">{{$car->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published_at"  value="1"  @if ($car['published_at'] != "")  checked @endif/>
                                Published
                            </label>
                        </div>
                    </div>
                    <div class="form-images">
                        <p class="my-large">
                            Manage your images
                            <a href="{{route('car.editimages', $car)}}">From here</a>
                        </p>
                        <div class="car-form-images">
                            <a class="car-form-image-preview">
                               @if($images->isEmpty())
    <img src="{{ asset('uploads/cars/no-image.png') }}" alt="Car Image" class="car-active-image" id="activeImage" />
@else

                           
                                  @foreach ($images as $image)
                                                                                  @php 
                                                                                     $img = $image->image_path ?? null;
                                                                                   
                                                                                   @endphp

                                                                 <img src="{{ $img != null ? Str::startsWith($img, ['http://', 'https://']) ? $img : asset('uploads/cars/' . $img) : asset('uploads/cars/no-image.png')}}"  alt="Car Image"
                                                                                                                              class="car-active-image"  id="activeImage" />
                                   @endforeach
                            @endif
                            </a>
                        
                        </div>
                        
                    </div>
                </div>
                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                        <button type="button" class="btn btn-default">Reset</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
   </x-app-layout>
