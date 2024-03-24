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
                if (response.success) {
                    alert(response.message); 
                    $("#addUserModal").css("display", "none");
                    $("#modalOverlay").css("display", "none");
                    $("#addUserForm")[0].reset();
                } else {
                    alert(response.error); 
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert(response.error); 
            }
        });
    });

});
