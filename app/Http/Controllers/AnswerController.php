<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $question->answers()->create(['body'=>$request->body, 'user_id'=>Auth::user()->id]);

        return back()->with('success', 'your answer has been submitted successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        return view('answers.edit', ['answer'=> $answer, 'question' => $question]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);

        $answer->update($request->validate([
            'body'=> 'required',
        ]));

        if($request->expectsJson()){
            return response()->json([
                'message'=> 'you answer has been updated',
                'body_html' => $answer->body_html,
            ]);
        };

        return redirect()->route('questions.show', $question->slug)->with('success', 'message update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);

        $answer->delete();
        
        return back()->with('success', 'answer deleted!');
    }

    public function accept(Answer $answer){
        $answer->question->acceptBestAnswer($answer);
        return back();
    }
}
