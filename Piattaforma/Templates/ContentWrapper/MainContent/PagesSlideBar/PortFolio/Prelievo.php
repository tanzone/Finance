<?php
/** SCRIPT DI INCLUSIONE DEI DOCUMENTI **/
if(!isset($_SESSION))
{
require_once("../../../../../Includes/utility.php");
require_once("../../../../../Templates/ContentWrapper/MainContent/PagesSlideBar/PortFolio/function-Prelievo.php");
}
else
{
require_once("./Templates/ContentWrapper/MainContent/PagesSlideBar/PortFolio/function-Prelievo.php");
}
?>
<?php
if(!isset($_SESSION))
session_start();
isStillValid();
?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 colorTitle">Preleva I Tuoi Soldi</h1>
  </div>
<div id="cercaAzioni-Main">
    <div id="cercaAzioni-Main">
        <div>
            <form autocomplete="off" action="" method="post">
                <div class="cercaAzioni-autocomplete"  style="">
                    <div style="margin:auto;">
                        <p class="cercaAzioni" style="" >Massimo prelievo : 9999$ </p>
                        <input style="" min="1" class="cercaAzioni campoTesto" id="myInput" type="Number" name="credito" placeholder="Preleva" autofocus require >
                        <input style=""class="cercaAzioni bottone" type="submit"  id="invia">
                    </div>
                    <?php LoadPagePrel(); ?>
                </div>
            </form>
        </div>
    </div>
    <script>
    
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
    //resizeInput();
    </script>
</div>