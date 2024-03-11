$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#addcomment").click(function () {
        $("#addCommentModal").css("display", "block");
        $("#modalOverlay").css("display", "block");
    });

    $(document).on('click', '#addCommentModal .close, #modalOverlay', function () {
        $("#addCommentModal").css("display", "none");
        $("#modalOverlay").css("display", "none");
    });

    $("#addCommentBtn").click(function () {
        var formData = $("#addCommentForm").serialize();
        var chapterIdString = 'chapter_id=' + encodeURIComponent(currentChapterId);
        var formDataWithChapterId = formData + '&' + chapterIdString;
        console.log(formDataWithChapterId);

        $.ajax({
            type: "POST",
            url: "/comments",
            data: formDataWithChapterId,
            success: function (response) {
                console.log(response);
                alert('Comment added successfully!');
                $("#addCommentModal").css("display", "none");
                $("#modalOverlay").css("display", "none");
                $("#addCommentForm")[0].reset();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while adding the comment.');
            }
        });
    });
});
