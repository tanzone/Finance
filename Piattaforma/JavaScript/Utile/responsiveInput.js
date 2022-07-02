    var resizeInput = function (){

    if($(window).width() < 500){
            $("#myInput").css("width" , "40%");
            $("#myInput").css("font-size" , "12px");
            $("#invia").css("width" , "30%");
            $("#invia").css("font-size" , "12px");
        }
        else {
             $("#myInput").css("width" , "40%");
            $("#myInput").css("font-size" , "13px");
            $("#invia").css("width" , "10%");
            $("#invia").css("font-size" , "15px");
        }

    };
    
    $(window).resize(resizeInput);
    resizeInput();