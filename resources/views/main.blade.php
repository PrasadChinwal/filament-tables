<!DOCTYPE html>
<html lang="en">
    <head>
        @include('partials._head')
    </head>
    <body>

        @include('partials._nav')
        <div class="px-64 mb-0">
            <div id="app">
                <v-app data-app>
                        @include('partials._messages')
                        @yield('content')
                </v-app>
            </div>
        </div>
        @include('partials._footer')
        @include('partials._javascript')

        @yield('scripts')
    </body>
</html>