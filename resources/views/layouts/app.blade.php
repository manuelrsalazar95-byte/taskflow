@extends('layouts.base')
@section('body')
<div class="wrapper">
    @include('partials.sidebar')

    <main id="contenido"
          tabindex="-1"
          class="main-panel transition-all duration-300 ease-in-out md:ml-[260px] pt-[67px] min-h-screen">
        @include('partials.navbar')

        <div class="content p-4 md:p-8">
            @include('partials.flash')
            @yield('content')
        </div>
    </main>
</div>
@endsection
