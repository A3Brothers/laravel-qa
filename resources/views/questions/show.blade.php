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

                    @include('questions._question_answer_voting', ['model'=> $question, 'uri'=> 'question.vote'])

                    <div id=@if($question->is_favorited) "unfavorite" @else "favorite" @endif class="cursor-pointer w-10 text-center">
                        <i class="@if($question->is_favorited) unfavorite @else favorite @endif  fas fa-star fa-lg"></i>
                    </div>

                    <form id="postQuestionFavorite" action="{{route('questions.favorite', $question->id)}}" method="post">
                        @csrf
                    </form>
                    <form id="deleteQuestionFavorite" action="{{route('questions.unfavorite', $question->id)}}" method="post">
                        @method('delete')
                        @csrf
                    </form>

                    <p>{{$question->favorites_count}}</p>
                </div>
                <div class="flex flex-col w-11/12">
                    <div class="border bg-gray-100 text-red-500 my-2 p-1">
                        <div class="media-body">
                            <div class="flex justify-between my-3">
                                <p></p>
                                <a class="h-10 w-auto pt-2 bg-white text-center border-2 shadow-sm rounded" href="{{ route('questions.index') }}">Back to all questions</a>
                            </div>
                            <div class="flex justify-between">
                                <h1 class="mt-0 font-bold text-xl">{!!Purifier::clean($question->title)!!}</h1>
                            </div>
                            <p class="text-lg">
                                asked by 
                                <a class="hover:text-black text-gray-500" href="{{$question->user->url}}">{{$question->user->name}}</a>
                                <small>{{ $question->created_date }}</small>
                            </p>
                            {!!Purifier::clean($question->body)!!}
                            

                            @include('questions._name_icon_tag', ['model' => $question])

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

                                @include('questions._question_answer_voting', ['model'=> $answer, 'uri'=> 'answer.vote'])

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
                                {!!Purifier::clean($answer->body)!!}

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

                                    @include('questions._name_icon_tag', ['model' => $answer])
                                
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