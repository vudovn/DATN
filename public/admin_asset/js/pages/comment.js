$(document).ready(function () {
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: "{{ route('ajax.comment.getComments') }}",
        type: "GET",
        dataType: "json",
        success: function (html) {
            $("#comments-container").html(html);
        },
        error: function (error) {
            console.log("Error: " + error);
        },
    });
});
