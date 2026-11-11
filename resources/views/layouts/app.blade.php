@extends('layouts.base')

@section('body')
<div class="min-h-screen bg-canvas">

    @include('partials.sidebar')

    <div class="min-h-screen md:pl-[264px]">
        @include('partials.navbar')

        <main id="contenido"
              tabindex="-1"
              class="pt-16 outline-none">
            <div class="mx-auto w-full max-w-[1440px] px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
                @include('partials.flash')

                @yield('content')
            </div>
        </main>
    </div>

</div>
@endsection
