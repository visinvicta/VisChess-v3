$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".btn-add-user").click(function () {
        $("#addUserModal").css("display", "block");
    });

    $(document).on('click', '#addUserModal .close, #modalOverlay', function () {
        $("#addUserModal").css("display", "none");
    });

    $("#addUserBtn").click(function () {
        var studyId = $("input[name='study_id']").val();
        var formData = $("#addUserForm").serialize();

        formData += '&study_id=' + studyId;
        console.log(formData)

        $.ajax({
            type: "POST",
            url: "/add-users-to-study",
            data: formData,
            success: function (response) {
                console.log(response);
                alert('Users added to study successfully!');
                $("#addUserModal").css("display", "block");
                $("#addUserForm")[0].reset();
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert('An error occurred while adding users to the study.');
            }
        });
    });

});

