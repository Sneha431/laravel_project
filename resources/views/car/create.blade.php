@props(['makers', 'models', 'years', 'states', 'cities', 'cartypes', 'fueltypes', 'carfeatures'])
<x-app-layout title="Add Car Page">

 @if($errors->any())
 <div class="container my-large">
    <div class="error-message"> 
      <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
    </div>
  
@endif

    <main>
        <div class="container-small">
            <h1 class="car-details-page-title">Add Car
            </h1>
             <form action="{{ route('car.store') }}" class="card add-new-car-form" method="POST" enctype="multipart/form-data">
                @csrf
   
          
                <div class="form-content">
                    <div class="form-details">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Maker</label>
                                      <select name="maker_id">
                                         <option value="">Maker</option>
                                            @foreach ($makers as $maker)
                                        <option value="{{$maker->id}}">{{$maker->name}}</option>
                                  
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
                                        <option value="{{$model->id}}">{{$model->name}}</option>
                                  
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
                                        <option value={{$year}}>{{$year}}</option>
                                  
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
                   />
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
                                    
                                    <input type="text" placeholder="Price" name="price" value=""/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Vin Code</label>
                                    <input placeholder="Vin Code" type="text" name="vin" value=""/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Mileage (ml)</label>
                                    <input placeholder="Mileage" type="text" name="mileage" value=""/>
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
                       />
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
                                        <option value="{{$state->id}}">{{$state->name}}</option>
                                
                                 
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
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                
                                 
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input placeholder="Address" value="" name="address"/>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input placeholder="Phone" value="" name="phone"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                           
                            <div class="form-group">
                <div class="row">
                  <div class="col">
                    <label class="checkbox">
                      <input type="checkbox" name="air_conditioning" value="1"
                       >
                      Air Conditioning
                    </label>

                    <label class="checkbox">
                         <input type="checkbox" name="power_windows" value="1"
                       >
                      
                      Power Windows
                    </label>

                    <label class="checkbox">
                         <input type="checkbox" name="power_door_locks" value="1"
                       >
                     
                      Power Door Locks
                    </label>

                    <label class="checkbox">
                        <input type="checkbox" name="abs" value="1"
                       >
                      ABS
                    </label>

                    <label class="checkbox">
                         <input type="checkbox" name="cruise_control" value="1"
                      >
                     
                      Cruise Control
                    </label>

                    <label class="checkbox">
                    
                         <input type="checkbox" name="bluetooth_connectivity" value="1"
                      >
                      Bluetooth Connectivity
                    </label>
                  </div>
                  <div class="col">
                    <label class="checkbox">
                          <input type="checkbox" name="remote_start" value="1"
                       >
                   
                      Remote Start
                    </label>

                    <label class="checkbox">
                          <input type="checkbox" name="gps_navigation" value="1"
                       >
                     
                      GPS Navigation System
                    </label>

                    <label class="checkbox">
                      
                        <input type="checkbox" name="heater_seats" value="1"
                       >
                      Heater Seats
                    </label>

                    <label class="checkbox">
                           <input type="checkbox" name="climate_control" value="1"
                      >
                   
                      Climate Control
                    </label>

                    <label class="checkbox">
                            <input type="checkbox" name="rear_parking_sensors" value="1"
                       >
                   
                      Rear Parking Sensors
                    </label>

                    <label class="checkbox">
                          <input type="checkbox" name="leather_seats" value="1"
                       >
                   
                   
                      Leather Seats
                    </label>
                  </div>
                </div>
              </div>
                         
                        </div>
                        <div class="form-group">
                            <label>Detailed Description</label>
                            <textarea rows="10" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="checkbox">
                                <input type="checkbox" name="published_at"  value="1" />
                                Published
                            </label>
                        </div>
                    </div>
                      <div class="form-images">
                        <div class="form-image-upload">
                          <div class="upload-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                              style="width: 48px">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                          </div>
                          <input id="carFormImageUpload" type="file" name="image_path[]" multiple />
                        </div>
                        <div id="imagePreviews" class="car-form-images"></div>
                      </div>
                <div class="p-medium" style="width: 100%">
                    <div class="flex justify-end gap-1">
                <input type="reset" value="Reset" class="reset_btn" style="width:84px;background-color: #e9580c;color:white">
                     
                        <button class="btn btn-primary" type="submit">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
   </x-app-layout>
