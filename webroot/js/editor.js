var Editor = (function() {
    var editor;
    var documentId;

    return {
        init: function () {
            editor = ace.edit('editor');
            editor.setTheme('ace/theme/dawn');
            editor.getSession().setMode('ace/mode/tex');

            if (currentDocumentId) {
                documentId = currentDocumentId;
            }
        },

        save: function () {
            var document = {
                tex: editor.getValue()
            };

            if (documentId) {
                document.id = documentId;
            }

            this.progress('Saving...');

            $.ajax({
                url: '/index.php?r=ajax/saveDocument',
                type: 'POST',
                data: document,
                dataType: 'json',
                context: this
            }).success(function(data) {
                this.progress('Saved');
                console.log(typeof data, data);

                if (data.id) {
                    documentId = data.id;
                }
            }).fail(function() {
                this.progress('Failed to save!');
            });
        },

        saveAndPreview: function () {
        },

        progress: function(message) {
            $('#progress-text').text(message ? message : '');
        }
    }
})();

$(function() {
    Editor.init()
});
