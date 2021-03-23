<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                
            <div class="flex flex-col justify-between m-auto">
                <div class="flex">
                    <div class="border bg-gray-100 text-red-500 my-2 p-1">
                        <div class="media-body">
                            <div class="flex justify-between my-3">
                                <p></p>
                                <a class="bg-white h-10 w-auto pt-2 bg-white text-center border-2 shadow-sm rounded" href="{{ route('questions.index') }}">Back to all questions</a>
                            </div>
                            <div class="flex justify-between">
                                <h1 class="mt-0 font-bold text-xl">{{$question->title}}</h1>
                            </div>
                            <p class="text-lg">
                                asked by 
                                <a class="hover:text-black text-gray-500" href="{{$question->user->url}}">{{$question->user->name}}</a>
                                <small>{{ $question->created_date }}</small>
                            </p>
                            @parsedown($question->body)
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>