<!DOCTYPE html>
<html lang="en">

@include('web.layouts.header.index')

<body>
    @include('web.layouts.header.nav')

    @yield('content')

    @include('web.layouts.footer.index')
</body>

</html>