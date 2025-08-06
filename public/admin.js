$(document).ready(function() {
    $('.edit-btn').click(function() {
        const id = $(this).data('id');
        const title = $(this).data('title');
        const content = $(this).data('content');

        $('#news-id').val(id);
        $('#title').val(title);
        $('#content').val(content);
    });
});
