<!DOCTYPE html>
<html lang="en">

<head>

    @include('layouts.head')

    @livewireStyles
</head>

<body>
    <main id="main-wrapper" class="main-wrapper">
        <!-- Header -->
        @include('components.header')

        <!-- navbar vertical -->
        <!-- Sidebar -->
        @include('components.sidebar')
        {{-- @include('components.header') --}}
        <div id="app-content">
            <div class="app-content-area">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        
        @include('layouts.footer')
    </main>
    @stack('scripts')
    @livewireScripts
</body>

</html>
