var EditorToolbar = (function() {
    var BUTTON_WIDTH = 24;
    var BUTTON_HEIGHT = 24;
    var TOOLBAR_ICONS = {
        "equation": {
            "leq": "\\leq",
            "geq": "\\geq",
            "prec": "\\prec",
            "succ": "\\succ",
            "triangleleft": "\\triangleleft",
            "triangleright": "\\triangleright",
            "neq": "\\neq",
            "equiv": "\\equiv",
            "approx": "\\approx",
            "cong": "\\cong",
            "propto": "\\propto"
        },
        "whitespace": {
            "n3mu": "\\!",
            "3mu": "\\,",
            "4mu": "\\:",
            "5mu": "\\;",
            "space": "\\ ",
            "ldots": "\\ldots",
            "cdots": "\\cdots",
            "vdots": "\\vdots",
            "ddots": "\\ddots"
        },
        "accent": {
            "hat": "\\hat{$}",
            "check": "\\check{$}",
            "brave": "\\brave{$}",
            "acute": "\\acute{$}",
            "grave": "\\grave{$}"
        }
    };

    function createDiv() {
        return $('<div></div>');
    }

    function createButton(group, name, bgX, bgY) {
        var button = $('<div><span></span></div>')
        button.addClass('button button-' + group + '-' + name);
        button.find('span').css('background-position', (-bgX * BUTTON_WIDTH) + 'px ' + (-bgY * BUTTON_HEIGHT) + 'px');
        button.css('visibility', 'none');

        return button;
    }

    return {
        init: function() {
            var rootDiv = createDiv();
            var groupButtonDiv = createDiv();
            var row = 1;

            groupButtonDiv.addClass('group-buttons');
            rootDiv.append(groupButtonDiv);

            $.each(TOOLBAR_ICONS, function(group, items) {
                var groupDiv = createDiv();
                var groupButton = createButton('group', group, row - 1, 0);
                var col = 0;

                groupButton.click(function() {
                    rootDiv.find('.group').hide();
                    rootDiv.find('.group-' + group).show();
                    groupButtonDiv.find('.button').removeClass('pressed');
                    groupButton.addClass('pressed');
                });

                groupDiv.addClass('group group-' + group);

                $.each(items, function(name, item) {
                    var button = createButton(group, name, col++, row);

                    button.click(function() {
                        Editor.insert(item);
                    });

                    groupDiv.append(button);
                });

                groupButtonDiv.append(groupButton);
                rootDiv.append(groupDiv);
                row++;
            });

            rootDiv.find('.group').hide();
            rootDiv.find('.group').first().show();
            groupButtonDiv.find('.button').first().addClass('pressed');

            $('#toolbar').html("");
            $('#toolbar').append(rootDiv);
        }
    };
})();

$(function(){
    EditorToolbar.init();
});
