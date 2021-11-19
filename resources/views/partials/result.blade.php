
Congratulations {{\Session::get('user')->name}}
<div class="row col-md-12 mt-4">
    <div class="col-md-6">
        Correct Answers
    </div>
    <div class="col-md-6">
        {{$correct_answers}}
    </div>
</div>
<div class="row col-md-12">
    <div class="col-md-6">
        Wrong Answers
    </div>
    <div class="col-md-6">
        {{$wrong_answers}}
    </div>
</div>
<div class="row col-md-12">
    <div class="col-md-6">
        Skip Answers
    </div>
    <div class="col-md-6">
        {{$skip_answers}}
    </div>
</div>
<script type="text/javascript">
    $(".questions_button").addClass("d-none");
</script>
