$(document).ready(function() {
    $('.edit-btn').click(function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const content = $(this).data('content');

        $('#news-id').val(id);
        $('#title').val(title);
        $('#content').val(content);

        $('#submit-button').text('Save');
    });

    // $('#news-form').on('submit', function(e) {
    //     setTimeout(() => {
    //         $('#news-id').val('');
    //         $('#title').val('');
    //         $('#content').val('');
    //         $('#submit-button').text('Create');
    //     }, 500);
    // });

    $('#logout-button').click(function () {
        window.location.href = '/?action=logout';
    });
});
