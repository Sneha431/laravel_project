
    @extends("layouts.base")
    
   
@section("childContent")
       @include("layouts.partials.header")

            @yield("content")
                <footer>
                    {{-- @yield("footerlinks") --}}
                    @section("footerlinks")

                                                        <a href="#">Link 1</a>
                                                        <a href="#">Link 2</a>
                        {{-- show both ends and outputs the section immediately. --}}
                                                   @show

                                                </footer>
                    @endsection
   



  


