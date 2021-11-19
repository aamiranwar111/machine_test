@extends('layout.app') 
@section('content')

<div class="row">
    <div class="col-md-4">
        <form id="user_form" method="post" action="javascript:void(0)">
            <div class="alert alert-success d-none msg_div">
                <span class="res_message"></span>
            </div>
            <div class="form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control name" placeholder="Please enter name" />
                </div>
                <div class="form-group">
                    <button type="button" onclick="submitForm('one')" class="btn btn-success float-right send_form">Submit</button>
                </div>
            </div>
            <div class="form-group questions_button d-none">
                <button type="button" id="skip_form" class="btn btn-success">Skip</button>
                <button type="button" onclick="submitForm('two')" class="btn btn-success float-right">Next</button>
            </div>
        </form>
    </div>
</div>

@endsection 
@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script>
    $(document).ready(function () {
        let route = "{{ route('user_add')}}";
        let question_routes = "{{ route('post_answer')}}";

        $("#skip_form").on("click", function (e) {
            $(".answer_id").val("");
            submitForm("two");
        });
        $("#user_form").on("submit", function (e) {
            e.preventDefault();
            /*Ajax Request Header setup*/
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $(".send_form").html("Sending..");
            $.ajax({
                url: route,
                method: "post",
                data: $("#user_form").serialize(),
                success: function (response) {
                    $(".send_form").html("Submit");
                    $(".res_message").show();
                    $(".res_message").html(response.message);
                    $(".msg_div").removeClass("d-none");
                    document.getElementById("user_form").reset();
                    setTimeout(function () {
                        $(".res_message").hide();
                        $(".msg_div").hide();
                        $(".user").hide();
                        route = question_routes;
                        getQuestion();
                    }, 500);
                },
            });
        });
    });
    function submitForm(step) {
        if (step == "two") {
            if ($(".answer_id").val() == "on") {
                alert("Select any Option");
                $(".answer_id").focus();
                return;
            }
        } else {
            if ($(".name").val() == "") {
                alert("Name is required.");
                $("#name").focus();
                return;
            }
        }
        $("#user_form").submit();
    }
    function setValue(id) {
        $(".answer_id").val(id);
    }
    function getQuestion() {
        $.ajax({
            url: "{{ route('get_question')}}",
            method: "get",
            success: function (response) {
                $(".questions_button").removeClass("d-none");
                $(".form").html(response);
            },
        });
    }
</script>
@endsection