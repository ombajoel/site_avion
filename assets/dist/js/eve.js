function init(){
    
    $("#step-2").addClass("init");
}
init();

$("#l1").on({
	click:function(){
       $("#step-1").removeClass("init");
       $("#step-2").addClass("init");
    }
});
$("#l2").on({
	click:function(){
       $("#step-2").removeClass("init");
       $("#step-1").addClass("init");
    }
});