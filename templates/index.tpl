{*smarty*}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>It's Fixed!</title>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {*    <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>*}
    {*    <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>*}
        <![endif]-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    {include file="js.tpl"}
    {include file="$module/js.tpl"}
    {include file="css.tpl"}
    {include file="$module/css.tpl"}
  </head>
  <body>
    {*<script>
      $(document).ready(() => {
        Utils.init
      });
    </script>*}
    <div class="content">
      {include file='banner.tpl'}
      {if file_exists("`$smarty.server.DOCUMENT_ROOT`/../templates/`$module`/`$action`.toolbar.tpl")}
        {include file="$module/$action.toolbar.tpl"}
      {/if}
      {include file='message.tpl'}
      {include file="title.tpl"}
      {include file="$module/$content.tpl"}
      {include file="working.tpl"}
    </div>
  </body>
</html>