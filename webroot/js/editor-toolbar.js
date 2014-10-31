var EditorToolbar = (function() {
    return {
        init: function() {
            $(".button-comparsion span").click(function(){
                var button_comparsion_position = $(".button-comparsion").position();
                $(".comparsion").css("visibility","visible");
                $(".comparsion").css("top",button_comparsion_position.top+30+"px");
                $(".comparsion").css("left",button_comparsion_position.left+"px");
            });
            $(".button-leq span").click(function(){
                Editor.insert("\\leq");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-geq span").click(function(){
                Editor.insert("\\geq");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-prec span").click(function(){
                Editor.insert("\\prec");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-succ span").click(function(){
                Editor.insert("\\succ");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-triangleleft span").click(function(){
                Editor.insert("\\triangleleft");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-triangleright span").click(function(){
                Editor.insert("\\triangleright");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-neq span").click(function(){
                Editor.insert("\\neq");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-equiv span").click(function(){
                Editor.insert("\\equiv");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-approx span").click(function(){
                Editor.insert("\\approx");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-cong span").click(function(){
                Editor.insert("\\cong");
                $(".comparsion").css("visibility","hidden");
            });
            $(".button-propto span").click(function(){
                Editor.insert("\\propto");
                $(".comparsion").css("visibility","hidden");
            });
        }
    };
})();

$(function(){
    EditorToolbar.init();
});
