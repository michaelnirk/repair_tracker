{*smarty*}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>It's Fixed!</title>
    {include file="css.tpl"}
    {include file="js.tpl"}
  </head>
  <body>
    <div class="content">
      {include file='banner.tpl'}
      <p>{$smarty.server.DOCUMENT_ROOT}</p>
      {if file_exists("`$smarty.server.DOCUMENT_ROOT`/repair_tracker/templates/`$module`/`$action`.toolbar.tpl")}
        {include file="$module/$action.toolbar.tpl"}
      {/if}
      {include file='message.tpl'}
      {include file="title.tpl"}
      {include file="$module/$content.tpl"}
      {include file="working.tpl"}
      {include file="sidenav.tpl"}
    </div>
  </body>
</html>