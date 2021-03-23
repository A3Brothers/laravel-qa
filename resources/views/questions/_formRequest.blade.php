<div class="flex justify-between mb-1">
    <label class="w-3/12 text-center" for="questiontitle">Question title</label>
    <input class="w-9/12 @error('title') invalid @enderror" type="text" name="title" id="questiontitle" value="{{old('title', $question->title)}}" placeholder="title...">
</div>
@error('title')
        <div class="text-sm mb-2 text-center text-red-600">{{ $message }}</div>
@enderror
<div class="flex justify-between mb-1">
    <label class="w-3/12 text-center" for="questionbody">Question body</label>
    <textarea class="w-9/12 @error('body') invalid @enderror" name="body" id="questionbody" cols="30" rows="10">{{old('body', $question->body)}}</textarea>
</div>
@error('body')
        <div class="text-sm mb-2 text-center text-red-600">{{ $message }}</div>
@enderror
<div class="flex justify-center mb-4">
    <button class="border rounded bg-green-300 w-2/12 text-2xl hover:bg-green-400">{{$buttonText}}</button>
</div>