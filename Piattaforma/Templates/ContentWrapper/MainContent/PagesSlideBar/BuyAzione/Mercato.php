<?php
/** SCRIPT DI INCLUSIONE DEI DOCUMENTI **/
if(!isset($_SESSION))
{
require_once("../../../../../Includes/utility.php");
require_once("../../../../../Templates/ContentWrapper/MainContent/PagesSlideBar/BuyAzione/function-Mercato.php");
}
else
{
require_once("./Templates/ContentWrapper/MainContent/PagesSlideBar/BuyAzione/function-Mercato.php");
}
?>
<?php
if(!isset($_SESSION))
session_start();
isStillValid();
?>
<!-- Begin Page Content -->
<div class="container-fluid colorSfondoDashBoard">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 colorTitle">Mercato Azionario</h1>
    </div>
    <div id="cercaAzioni-Main">
        <div id="cercaAzioni-Contain">
            <div>
                <form autocomplete="off" action="" method="post" >
                    <div class="cercaAzioni-autocomplete" style="">
                        <div style="margin:auto;">
                            <input class="cercaAzioni campoTesto"  style="" id="myInput" type="text" name="azione" placeholder="Azioni" autofocus  >
                            <input style="" class="cercaAzioni bottone"  type="submit"  id="invia">
                        </div>
                    </div>
                </form>
            </div>
            <?php
            LoadPage();
            ?>
        </div>
        
        <script>
        /** SCRIPT PER RENDERE IL TUTTO RESPONSIVE **/
        var resizeGraph = function (){
        if($(window).width() < 500){
        $("#canvas-container").height(500);
        $("#canvas-container").width("100%");
        $("input.campoTesto").css("width" , "40%");
        $("input.campoTesto").css("font-size" , "12px");
        $("input.bottone").css("width" , "30%");
        $("input.bottone").css("font-size" , "12px");
        $("#titolo").css("font-size" , "15px");
        }
        else {
        $("#canvas-container").height(450);
        $("#canvas-container").width("60%");
        $("#canvas-container").width("80%");
        $("input.campoTesto").css("width" , "40%");
        $("input.campoTesto").css("font-size" , "13px");
        $("#titolo").css("font-size" , "15px");
        $("input.bottone").css("width" , "10%");
        $("input.bottone").css("font-size" , "15px");
        }
        };
        $(window).resize(resizeGraph);
        //resizeGraph();
        </script>
    </div>
</div>