document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete-comment');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const commentId = this.getAttribute('data-comment-id');
            fetch(`/comments/${commentId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            })
            .then(response => {
                if (response.ok) {
                    // Remove the deleted comment from the UI
                    const commentItem = this.parentElement;
                    commentItem.remove();
                } else {
                    console.error('Failed to delete comment');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
