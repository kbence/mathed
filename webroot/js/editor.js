var Editor = (function() {
    var editor;
    var documentId;

    function progress(message) {
        $('#progress-text').text(message ? message : '');
    }

    function generateDocument() {
        progress("Generating document...");

        $.ajax({
            url: '/index.php?r=ajax/generateDocument',
            type: 'POST',
            data: {
                id: documentId,
                tex: editor.getValue()
            },
            dataType: 'json'
        }).success(function(data) {
            progress("");

            previewContent = '';

            for (var i in data.images) {
                var image = data.images[i];
                previewContent += '<img src="' + image + '" style="width: 100%" /><br/>';
            }

            $('#wl_preview').html(previewContent);
        });
    }

    return {
        init: function () {
            editor = ace.edit('editor');
            editor.setTheme('ace/theme/dawn');
            editor.getSession().setMode('ace/mode/tex');

            if (currentDocumentId) {
                documentId = currentDocumentId;
            }
        },

        save: function (callback) {
            var document = {
                tex: editor.getValue(),
                title: $('#document-title').val()
            };

            if (documentId) {
                document.id = documentId;
            }

            progress('Saving...');

            $.ajax({
                url: '/index.php?r=ajax/saveDocument',
                type: 'POST',
                data: document,
                dataType: 'json',
                context: this
            }).success(function(data) {
                progress('Saved');

                if (data.id) {
                    documentId = data.id;
                }

                if (callback) {
                    callback();
                }
            }).fail(function() {
                progress('Failed to save!');
            });
        },

        saveAndPreview: function () {
            this.save(generateDocument);
        },

        insert: function (insert_string) {
            editor.insert(insert_string);
            editor.focus();
        }
    }
	
})();

$(function() {
    Editor.init()
});
