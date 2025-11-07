<!DOCTYPE html>
<html lang="id">
<head>
    //mulai css
   @include('layouts.admiin.css')
    //tutup css
</head>
<body>
    @include('layouts.admiin.sidebar')

    <div class="flex-grow-1">
        @include('layouts.admiin.header')

        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>
