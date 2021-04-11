@if ($question->answers_count)
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

                                        <user-info :model="{{$answer}}" label="Answered"></user-info>
                                        
                                    
                                    </li>
                                </div>
                            </div>
                            
                            @endforeach
                        </ul>
                        
                    </div>
                </div>
            @endif