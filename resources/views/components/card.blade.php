 @props(['color', 'bgColor' => 'white', 'fontSize' => '18px', 'fontWeight' => '300'])

{{-- If fontSize is not passed when using the component, it will use the default value (18px).
This prevents "Undefined variable" errors.
It ensures the component has a consistent style even when the user does not explicitly set fontSize. --}}
{{-- 
In Laravel Blade components, @props is used to define properties 
(variables) that a component can accept when it is used.
color → This is a required prop (no default value).
bgColor => 'white' → This is an optional prop with a default value of 'white'.
If the user does not pass bgColor, it will default to 'white'. --}}

{{-- {{dump($attributes)}} --}}
{{-- comment out props to see the output of all the attributes coming from index
Illuminate\View\ComponentAttributeBag {#269 ▼ // resources\views/components/card.blade.php
#attributes: array:5 [▼
"color" => "red"
"bgColor" => "blue"
"fontSize" => "34px"
"fontWeight" => "600"
"lang" => "en"
]
}
but without comment it will exclude
all the props already mentioned in prop 
Illuminate\View\ComponentAttributeBag {#278 ▼ // resources\views/components/card.blade.php
#attributes: array:1 [▼
"lang" => "en"
]
}
--}}

{{-- <div class="card card-text-{{$color}} card-bg-{{$bgColor}}" {{$attributes}} > --}}
  <div {{$attributes->class("card card-text-$color card-bg-$bgColor")->merge(["man" => "demo"])}}>
    {{--
    ->merge(["man"=>"demo"]) this will merge the attributes coming from component with the default attributes
    --}}
    {{-- this will combine both class attributes
      <x-card color="red" bgColor="blue" :fontSize="$size" :$fontWeight lang="en" class="class-rounded"> 
        The ->class(...) method merges the provided classes with any additional classes passed via the component.
Prevents class duplication. , Merges default & custom classes smoothly. ,
Allows passing extra attributes dynamically.
        --}}
  <div class="card-div" @style(["font-size :" . $fontSize, "font-weight :" . $fontWeight])>
   <div {{$title->attributes->class("card-header")}}>
    {{-- {{dump($title->attributes)}}  --}}
    {{$title}}
   </div>
  </div>
  {{$color}}
  @if ($slot->isEmpty())
  <p>Please provide some content</p>
  @else
  {{$slot}}
  @endif
  {{$body}}
  <div class="card-footer">{{$footer}}</div>
 </div>