<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Question') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @include('layouts._messages')
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                
            <div class="flex justify-between m-auto">
                <div class="flex flex-col w-1/12 justify-center items-center bg-gray-100">
                    <div class="cursor-pointer w-10 text-center">
                        <i class="fas fa-caret-up fa-2x"></i>
                    </div>
                    <p>165654</p>
                    <div class="cursor-pointer w-10 text-center">
                        <i class="text-gray-400 fas fa-caret-down fa-2x"></i>
                    </div>
                    <div class="cursor-pointer w-10 text-center">
                        <i class="text-yellow-400 fas fa-star fa-lg"></i>
                    </div>
                    <p>165654</p>
                </div>
                <div class="flex flex-col w-11/12">
                    <div class="border bg-gray-100 text-red-500 my-2 p-1">
                        <div class="media-body">
                            <div class="flex justify-between my-3">
                                <p></p>
                                <a class="h-10 w-auto pt-2 bg-white text-center border-2 shadow-sm rounded" href="{{ route('questions.index') }}">Back to all questions</a>
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
                            <div class="text-right mb-4">
                                <div class="">
                                    <span class="block">Answered {{$question->created_date}}</span>
                                    <a href="{{$question->user->url}}">
                                        <img class="inline-block" src="{{$question->user->avatar}}" alt="">
                                    </a>
                                    <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col border">
                <div class="text-2xl ml-2 my-4">
                {{$question->answers_count}} {{Str::plural('answer', $question->answers_count)}}
                </div>
                <div class="p-1">
                    <ul>
                        @foreach ($question->answers as $answer)
                        <div class="flex">
                            <div class="flex flex-col w-1/12 justify-center items-center">
                                <div class="cursor-pointer w-10 text-center">
                                    <i class="fas fa-caret-up fa-2x"></i>
                                </div>
                                <p>165654</p>
                                <div class="cursor-pointer w-10 text-center">
                                    <i class="text-gray-400 fas fa-caret-down fa-2x"></i>
                                </div>
                                @can('accept', $answer)
                                    <div onclick="event.preventDefault(); getElementById('accept-answer-{{ $answer->id }}').submit();" class="cursor-pointer w-10 text-center">
                                        <i class="{{$answer->status}} hover:text-green-600 fas fa-check fa-lg"></i>
                                    </div>
                                    <form action="{{ route('answers.accept', $answer->id) }}"method="POST" id="accept-answer-{{ $answer->id }}" style="display: none;">
                                        @csrf
                                    </form>
                                @else
                                    @if ($answer->is_best)
                                        <div class="cursor-pointer w-10 text-center">
                                            <i class="{{$answer->status}} hover:text-green-600 fas fa-check fa-lg"></i>
                                        </div>
                                    @endif
                                @endcan
                                
                            </div>

                            <div class="w-11/12">
                                <li class="border-b-2 my-4 bg-gray-50">
                                    {{$answer->body}}

                                    <div class="flex mt-4">
                                        @can('update', $answer)
                                        <div class="h-7 bg-blue-400 mr-2 cursor-pointer px-4 text-white rounded border-black hover:bg-blue-500"><a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}">Edit</a></div>
                                        @endcan
    
                                        @can('delete', $answer)
                                        <div class="h-7 bg-red-400 cursor-pointer px-4 text-white rounded border-black hover:bg-red-500">
                                            <form action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}" method="post" onclick="return confirm('are you sure!')">
                                            @csrf
                                            @method('delete')
                                            <button>Delete</button>
                                            </form>
                                        </div>                                        
                                        @endcan
                                    </div>

                                
                                    <div class="text-right mb-4">
                                        <div class="">
                                            <span class="block">Answered {{$answer->created_date}}</span>
                                            <a href="{{$answer->user->url}}">
                                                <img class="inline-block" src="{{$answer->user->avatar}}" alt="">
                                            </a>
                                            <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                        </div>
                                    </div>
                                
                                </li>
                            </div>
                        </div>
                        
                        @endforeach
                    </ul>
                    
                </div>
            </div>

            <div class="flex flex-col">
                <div class="border my-2 p-1">
                    <div class="text-2xl ml-2 my-4">
                        Answer
                    </div>
                    <div>
                        <form action="{{ route('questions.answers.store', [$question->id]) }}" method="POST">
                            @csrf
                            <div class="flex flex-col mb-1">
                                <textarea id="commentAnswer" class="@error('body') invalid @enderror" name="body" cols="30" rows="10"> {{old('body', '')}} </textarea>
                            </div>
                            @error('body')
                                    <div class="text-sm mb-2 text-center text-red-600">{{ $message }}</div>
                            @enderror
                            <div class="flex mb-4">
                                <button class="border-black border-2 rounded bg-white w-2/12 text-2xl hover:bg-gray-100">Add Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
</x-app-layout>