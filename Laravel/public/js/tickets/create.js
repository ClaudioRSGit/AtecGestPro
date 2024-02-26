document.addEventListener('DOMContentLoaded', function() {
    var quill = new Quill('#description', {
        theme: 'snow'
    });

    quill.on('text-change', function() {
        var htmlContent = quill.root.innerHTML;
        document.getElementById('descriptionInput').value = htmlContent;
    });
});

document.getElementById('attachment').addEventListener('change', function() {
    var filename = this.value.split('\\').pop();
    document.getElementById('file-name').textContent = filename;
});
