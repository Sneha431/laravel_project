<x-app-layout>
  <main>
    <div>
      <div class="container">
       <div class="flex justify-between">
         <h1 class="car-details-page-title">
          Manage Images for: {{$car->year}} - {{$car->maker->name}} {{$car->model->name}}
         
        </h1>
           <span>
            <a href="{{route('car.edit', $car)}}" class="btn btn-edit inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" style="width: 12px; margin-right: 5px">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>

                                                Go Back
                                            </a></span>
       </div>
  {{-- @dump($images) --}}
        <div class="car-images-wrapper">
          
          <form action="{{route('car.updateimages', $car)}}" method="POST" class="card p-medium form-update-images">
            @csrf
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Delete</th>
                    <th>Image</th>
                    <th>Position</th>
                  </tr>
                </thead>
                <tbody>
                   @foreach ($images as $image)
              @php 
              $img = $image->image_path ?? null;

               @endphp
            <tr>
            <td>
             <input type="checkbox" name="delete_images[]" id="delete_image_{{ $image->id }}" value="{{ $image->id }}" />

            </td>
            <td>
             <img src="{{ Str::startsWith($img, ['http://', 'https://']) ? $img : asset('uploads/cars/' . $img) }}" alt="Car Image"
              class="my-cars-img-thumbnail"
            style="width: 120px" />
            <input type="hidden" name="id[]" value="{{$image->id}}" />

            </td>
            <td>
            <input type="number" name="position[]" value="{{$image->position}}" style="width: 80px" />
            </td>
            </tr>
        @endforeach
                </tbody>
              </table>
            </div>
  
            <div class="p-medium" style="width: 100%">
              <div class="flex justify-end gap-1">
             
                <button class="btn btn-primary" type="submit" {{ $images->isEmpty() ? 'disabled' : '' }}>Update Images</button>
              </div>
            </div>
          </form>
          <form action="{{route('car.addimages',$car)}}" method="POST" enctype="multipart/form-data" class="card form-images p-medium mb-large">
            @csrf
            <div class="form-image-upload">
              <div class="upload-placeholder">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                  stroke="currentColor" style="width: 48px">
                  <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
              </div>
              <input id="carFormImageUpload" type="file" name="images[]" multiple accept="image/*" />
            </div>
            <div id="imagePreviews" class="car-form-images"></div>
  
            <div class="p-medium" style="width: 100%">
              <div class="flex justify-end gap-1">
                <button class="btn btn-primary" type="submit">Add Images</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</x-app-layout>