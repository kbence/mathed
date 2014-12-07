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
            "grave": "\\grave{$}",
            "tilde": "\\tilde{$}",
            "bar": "\\bar{$}",
            "vec": "\\vec{$}",
            "dot": "\\dot{$}",
            "ddot": "\\ddot{$}"			
        },
        "operation": {
            "plusminus": "\\pm",
            "minusplus": "\\mp",
            "times": "\\times",
            "div": "\\div",
            "sat": "\\ast",
            "cdot": "\\cdot",
            "circ": "\\circ",
            "bullet": "\\bullet",			
			"otimes": "\\otimes",
            "oplus": "\\oplus",
            "ominus": "\\ominus",
            "odot": "\\odot",
            "oslash": "\\oslash"
        },
        "arrow": {
            "leftarrow": "\\leftarrow",
            "rightarrow": "\\rightarrow",
            "leftrightarrow": "\\leftrightarrow",
            "Leftarrow": "\\Leftarrow",
            "Rightarrow": "\\Rightarrow",
            "Leftrightarrow": "\\Leftrightarrow",
            "uparrow": "\\uparrow",
            "downarrow": "\\downarrow",
            "updownarrow": "\\updownarrow",
            "Uparrow": "\\Uparrow",
            "Downarrow": "\\Downarrow",
            "Updownarrow": "\\Updownarrow",
            "leftharpoonup": "\\leftharpoonup",
            "rightleftharpoons": "\\rightleftharpoons",
            "rightharpoonup": "\\rightharpoonup",
            "leftharpoondown": "\\leftharpoondown",
            "rightharpoondown": "\\rightharpoondown",
            "mapsto": "\\mapsto",
            "longmapsto": "\\longmapsto",
            "hookleftarrow": "\\hookleftarrow",
            "hookrightarrow": "\\hookrightarrow",
            "nearrow": "\\nearrow",
            "searrow": "\\searrow",
            "swarrow": "\\swarrow",
            "nwarrow": "\\nwarrow",
            "longleftarrow": "\\longleftarrow",
            "longrightarrow": "\\longrightarrow",
            "longleftrightarrow": "\\longleftrightarrow",
            "Longleftarrow": "\\Longleftarrow",
            "Longrightarrow": "\\Longrightarrow",
            "Longleftrightarrow": "\\Longleftrightarrow"
        },
        "logic": {
            "ni": "\\ni",
            "exists": "\\exists",
            "forall": "\\forall",
            "neg": "\\neg",
            "wedge": "\\wedge",
            "vee": "\\vee"
        },
        "relation": {
            "in": "\\in",
            "notin": "\\notin",
            "cup": "\\cup",
            "cap": "\\cap",
            "bigcup": "\\bigcup",
            "bigcap": "\\bigcap",
            "subset": "\\subset",
            "supset": "\\supset",
            "subseteq": "\\subseteq",
            "supseteq": "\\supseteq"
        },
        "special": {
            "partial": "\\partial",
            "nabla": "\\nabla",
            "infty": "\\infty",
            "im": "\\Im",
            "re": "\\Re",
            "aleph": "\\aleph",
            "angle": "\\angle",
            "bot": "\\bot",
            "diamond": "\\diamond",
            "ell": "\\ell",
            "wp": "\\wp",
            "hbar": "\\hbar",
            "int": "\\int{}",
            "sum": "\\sum{}",
            "prod": "\\prod{}",
            "coprod": "\\coprod{}"
        },
        "lowergreek": {
            "alpha": "\\alpha",
            "beta": "\\beta",
            "chi": "\\chi",
            "delta": "\\delta",
            "epsilon": "\\epsilon",
            "phi": "\\phi",
            "varphi": "\\varphi",
            "gamma": "\\gamma",
            "eta": "\\eta",
            "iota": "\\iota",
            "kappa": "\\kappa",
            "lambda": "\\lambda",
            "mu": "\\mu",
            "nu": "\\nu",
            "omicron": "o",
            "pi": "\\pi",
            "varpi": "\\varpi",
            "theta": "\\theta",
            "vartheta": "\\vartheta",
            "rho": "\\rho",
            "sigma": "\\sigma",
            "varsigma": "\\varsigma",
            "tau": "\\tau",
            "upsilon": "\\upsilon",
            "omega": "\\omega",
            "xi": "\\xi",
            "psi": "\\psi",
            "zeta": "\\zeta"
        },
        "uppergreek": {
            "alpha": "A",
            "beta": "B",
            "chi": "X",
            "delta": "\\Delta",
            "epsilon": "E",
            "phi": "\\Phi",
            "gamma": "\\Gamma",
            "eta": "H",
            "iota": "I",
            "kappa": "K",
            "lambda": "\\Lambda",
            "mu": "M",
            "nu": "N",
            "omicron": "O",
            "pi": "\\Pi",
            "theta": "\\Theta",
            "rho": "P",
            "sigma": "\\Sigma",
            "tau": "T",
            "upsilon": "\\Upsilon",
            "omega": "\\Omega",
            "xi": "\\Xi",
            "psi": "\\Psi",
            "zeta": "Z"
        },
		"bookmarks": {
			"left_dot": "\\left.",
			"right_dot": "\\right.",
			"left_bracket": "\\left(",
			"right_bracket": "\\right)",
			"left_square_bracket": "\\left\\[",
			"right_square_bracket": "\\right\\]",			
			"left_curly_bracket": "\\left\\{",
			"right_curly_bracket": "\\right\\}",
			"leftlfloor": "\\left\\lfloor",
			"rightrfloor": "\\right\\rfloor",			
			"leftlceil": "\\left\\lceil",
			"rightrceil": "\\right\\rceil",	
			"leftlangle": "\\left\\langle",
			"rightrangle": "\\right\\rangle",				
			"leftI": "\\left|",
			"rightI": "\\right|",
			"leftII": "\\left\\|",
			"rightII": "\\right\\|",			
			"overbrace": "\\overbrace{}^{}",
			"underbrace": "\\underbrace{}_{}"			
		},
		"matemathical_constructions": {
			"frac": "\\frac{}{}",
			"div": "/",
			"sqrt": "\\sqrt{}",
			"sqrtbracket": "\\sqrt[]{}"
		},
		"subscriptsuperscript": {
			"subsuper1": "^{}",
			"subsuper2": "_{}",
			"subsuper3": "^{}_{}",
			"subsuper4": "^{}",
			"subsuper5": "_{}",
			"subsuper6": "^{}_{}",			
			"subsuper7": "^{}",
			"subsuper8": "_{}",
			"subsuper9": "^{}_{}"
		},
		"operators": {
			"sum": "\\sum",
			"int": "\\int",
			"oint": "\\oint",
			"prod": "\\prod",
			"coprod": "\\coprod"		
		},
		"abovebelow": {
			"overline": "\\overline{}",
			"underline": "\\underline{}",
			"widehat": "\\widehat{}",
			"widetilde": "\\widetilde{}",
			"stackrel": "\\stackrel{}{}",
			"overbrace": "\\overbrace{}^{}",			
			"underbrace": "\\underbrace{}_{}"
		},
		"arrowswithcaptions": {
			"stackrelrightarrow": "\\stackrel{}{\\rightarrow}",
			"stackrelleftarrow": "\\stackrel{}{\\leftarrow}",
			"stackrelleftrightarrow": "\\stackrel{}{\\leftrightarrow}",
			"stackrelrightarrow2": "\\stackrel{\\rightarrow}{}",
			"stackrelleftarrow2": "\\stackrel{\\leftarrow}{}",
			"stackrelleftrightarrow2": "\\stackrel{\\leftrightarrow}{}"
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
            var row = 1, grp = 1;

            groupButtonDiv.addClass('group-buttons');
            rootDiv.append(groupButtonDiv);

            $.each(TOOLBAR_ICONS, function(group, items) {
                var groupDiv = createDiv();
                var groupButton = createButton('group', group, grp - 1, 0);
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

                    if (col > 15) {
                        col = 0;
                        row++;
                    }

                    button.click(function() {
                        Editor.insert(item);
                    });

                    groupDiv.append(button);
                });

                if (col % 16 == 0) {
                    row--;
                }

                groupButtonDiv.append(groupButton);
                rootDiv.append(groupDiv);
                row++;
                grp++;
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
