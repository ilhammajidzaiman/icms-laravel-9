function test() {
    let content = $('#summernote').text().toLowerCase();
    $('#summernote').text(content);
}
$('#summernote').summernote({
    tabsize: 2,
    height: 400,
    toolbar: [
        ['view', ['undo', 'redo']],
        ['style', ['style', 'fontname']],
        ['font', ['bold', 'italic', 'underline', 'color']],
        ['para', ['ul', 'ol', 'paragraph', 'strikethrough', 'superscript', 'subscript']],
        ['table', ['table']],
        ['insert', ['hr', 'link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']],
        ['clear', ['clear']],
    ]
})