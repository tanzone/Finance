$(document).ready(function()
{
  $("#Reload").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\ContentWrapper\\MainContent\\DashBoard\\DashBoard.php', function(responseTxt, statusTxt, xhr)
    {
      if(statusTxt == "error")
        $("#contentModificabile").load('.\\DashBoard.php');
  });});


  $("#UsernameSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\Utilities\\404.php');
  });



  $("#PasswordSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\Utilities\\404.php');
  });



  $("#CreditSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\Utilities\\404.php');
  });



  $("#DepositSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\ContentWrapper\\MainContent\\PagesSlideBar\\PortFolio\\Ricariche.php');
  });



  $("#WithdrawsSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\ContentWrapper\\MainContent\\PagesSlideBar\\PortFolio\\Prelievo.php');
  });


  $("#CompraAzione").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\ContentWrapper\\MainContent\\PagesSlideBar\\BuyAzione\\Mercato.php');
  });


  $("#TransizioniSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\ContentWrapper\\MainContent\\PagesSlideBar\\Transaction\\Transaction.php');
  });



  $("#AzioniDownSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\ContentWrapper\\MainContent\\PagesSlideBar\\Transaction\\TransactionDown.php');
  });


  $("#AzioniUpSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\ContentWrapper\\MainContent\\PagesSlideBar\\Transaction\\TransactionUp.php');
  });


  $("#404SlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\Utilities\\404.php');
  });



  $("#BlankSlideBar").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\Utilities\\Blank.php');
  });

  $("#ActivityLog").click(function()
  {
    $("#contentModificabile").load('.\\Templates\\Utilities\\Blank.php');
  });
});

