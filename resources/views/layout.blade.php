<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Add this inside the <head> tag of your layout file -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>{{$title ?? 'TheJobOpportunities | Find and list jobs'}}</title>
</head>
<body class="bg-gray-200 text-xl">
   <x-header />
   @if(request()->is('/'))
   <x-hero />
   <x-top-banner />
   @endif

    <main class="container mx-auto p-4 mt-4">
        {{-- Display alert messages --}}
        @if(session('success'))
        <x-alert type="success" message="{{session('success')}}" />
        @endif
        @if(session('error'))
        <x-alert type="error" message="{{session('error')}}"/>
        @endif
       {{$slot}}
    
    </main>
    <script src="{{asset('js/script.js')}}"></script>
</body>
</html>