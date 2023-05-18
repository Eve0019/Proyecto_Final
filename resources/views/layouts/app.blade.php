<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <div x-data="toastNotification()" @toast.window="toastInfo($event.detail.title,$event.detail.message,$event.detail.success)">
            <div 
                x-show="open"
                class="w-96 p-4 rounded h-32 fixed bottom-4 right-4 transform-gpu transition-transform duration-400 ease z-[100]"
                :class="isSuccess ? 'bg-green-500' : 'bg-red-500'"
                x-transition:enter-start="translate-y-full"
                x-transition:enter-end="translate-y-0"
                x-transition:leave-start="translate-y-0"
                x-transition:leave-end="translate-y-full"
                >
                <p class="text-white"><strong x-text="title"></strong></p>
                <p class="mt-2 text-sm text-white" x-text="message"></p>
            </div>
        </div>

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        
        <script>
            function toastNotification() {
                return {
                    open: false,
                    title: "Toast Title",
                    message: "Toast message",
                    success: false,
                    get isSuccess(){
                        return this.success;
                    },
                    openToast() {
                        this.open = true
                        setTimeout(() => {
                            this.open = false
                        }, 3000)
                    },
                    toastInfo(title, message, success = true){
                        this.title = title;
                        this.message = message;
                        if(success == 'false'){
                            this.success = false;
                        }else{
                            this.success = true;
                        }
                        this.openToast();
                    }
                }
            }
      </script>
    </body>
</html>
