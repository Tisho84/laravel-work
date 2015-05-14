<head>
    {{-- //load all meta data --}}
    @section('meta')
        @include('partials.head.meta')
    @show

    {{-- //define title --}}
    <title>@yield('title', 'Laravel.app')</title>

    {{-- //load css --}}
    @section('css')
        @include('partials.css')
    @show

    {{-- //load legacy scripts --}}
    @section('legacy')
        @include('partials.head.ie-support')
    @show

</head>