<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <h1 class="text-center text-2xl font-bold">All Questions</h1>

            <div class="flex flex-col justify-between w-8/12 m-auto">
                @foreach ($questions as $question)
                <div class="border bg-gray-100 text-red-500 my-2 p-1">
                    <div class="media-body">
                        <h3 class="mt-0 font-bold text-xl hover:text-red-800"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                        <p class="text-lg">
                            asked by 
                            <a class="hover:text-black text-gray-500" href="{{$question->user->url}}">{{$question->user->name}}</a>
                            <small>{{ $question->created_date }}</small>
                        </p>
                        {{ Str::limit($question->body, 250, '...') }}
                    </div>
                </div>
                @endforeach 
            <div class="mt-5"> {{ $questions->links() }} </div>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
</head>
<body>

    
       
</body>
</html>