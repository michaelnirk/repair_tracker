<?php
/* Smarty version 3.1.30, created on 2020-04-15 12:28:40
  from "C:\develop\repair_tracker\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e96fdf874f3d2_62128203',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b0bc96023b7240b2de0acaf9e2fbde491dd4e89a' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\index.tpl',
      1 => 1586953614,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:css.tpl' => 1,
    'file:js.tpl' => 1,
    'file:banner.tpl' => 1,
    'file:message.tpl' => 1,
    'file:title.tpl' => 1,
    'file:working.tpl' => 1,
    'file:sidenav.tpl' => 1,
  ),
),false)) {
function content_5e96fdf874f3d2_62128203 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>It's Fixed!</title>
    <?php $_smarty_tpl->_subTemplateRender("file:css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->_subTemplateRender("file:js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  </head>
  <body>
    <div class="content">
      <?php $_smarty_tpl->_subTemplateRender("file:banner.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <p><?php echo $_SERVER['DOCUMENT_ROOT'];?>
</p>
      <?php if (file_exists(((string)$_SERVER['DOCUMENT_ROOT'])."/repair_tracker/templates/".((string)$_smarty_tpl->tpl_vars['module']->value)."/".((string)$_smarty_tpl->tpl_vars['action']->value).".toolbar.tpl")) {?>
        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['module']->value)."/".((string)$_smarty_tpl->tpl_vars['action']->value).".toolbar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

      <?php }?>
      <?php $_smarty_tpl->_subTemplateRender("file:message.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <?php $_smarty_tpl->_subTemplateRender("file:title.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['module']->value)."/".((string)$_smarty_tpl->tpl_vars['content']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

      <?php $_smarty_tpl->_subTemplateRender("file:working.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <?php $_smarty_tpl->_subTemplateRender("file:sidenav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
  </body>
</html><?php }
}
