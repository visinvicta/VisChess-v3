$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-study-create").click(function () {
        $("#createChapterModal").css("display", "block");
        $("#modalOverlay").css("display", "block");
    });

    $(document).on('click', '.close, #modalOverlay', function () {
        $("#createChapterModal").css("display", "none");
        $("#modalOverlay").css("display", "none");
    });

    $("#createChapterBtn").click(function () {
        var formData = $("#createChapterForm").serialize();

        $.ajax({
            type: "POST",
            url: "/chapters",
            data: formData,
            success: function (response) {
                console.log(response);
                alert('Chapter created successfully!');
                $("#createChapterModal").css("display", "none");
                $("#modalOverlay").css("display", "none");
                $("#createChapterForm")[0].reset();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while creating the chapter.');
            }
        });
    });
});
    

