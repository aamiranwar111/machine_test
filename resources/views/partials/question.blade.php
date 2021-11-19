Hello {{\Session::get('user')->name}}
<br />
<br />
<div class="form-group">
    <input type="hidden" id="question_id" name="question_id" value="{{$question->id}}" />
    <label for="name">{{$question->question}}</label><br />
    @if(count($question->answers) > 0) 
      @foreach ($question->answers as $key => $answer)
      <input type="radio" class="answer_id" id="answer-{{$key}}" name="answer_id" onclick="setValue('{{$answer->id}}')" />
      <label for="answer-{{$key}}">{{$answer->option}}</label><br />
      @endforeach 
    @endif
</div>
