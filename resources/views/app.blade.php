<!DOCTYPE html>
<html lang="en">
@include('partials.head')
<body>

@include('partials.navigation')

@include('partials.messages.success')
@include('partials.messages.errors')
@yield('content')

@section('js')
    @include('partials.js')
@show

</body>
</html>
