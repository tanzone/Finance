function validateFields(){
        

    var testoPsw = $("#password").val();
    var regexLower = /[a-z]/g;
    var regexUpper = /[A-Z]/g;
    var regexNumber = /[1-9]/g;

    if($("#input-sesso").val() == "")
    {
        alert("Compila tutti i campi");
        return false;
    }
        

    if(!(testoPsw.match(regexLower) && testoPsw.match(regexUpper) && testoPsw.match(regexNumber)))
    {
        $("#password-errata").css('color', 'red');
        return false;
    }else if(testoPsw.length < 8)
    {
        $("#password-errata").css('color', 'red');
        return false;
    }
        
    
    return true;
     
}