<?php
/* Smarty version 3.1.30, created on 2020-03-06 12:52:31
  from "C:\develope\repair_tracker\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e62478f5bf196_97548775',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cec7c25bf17eb7a7ce574c08cde2f30495c5b10' => 
    array (
      0 => 'C:\\develope\\repair_tracker\\templates\\index.tpl',
      1 => 1583493236,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:js.tpl' => 1,
    'file:css.tpl' => 1,
    'file:banner.tpl' => 1,
    'file:message.tpl' => 1,
    'file:title.tpl' => 1,
    'file:working.tpl' => 1,
  ),
),false)) {
function content_5e62478f5bf196_97548775 (Smarty_Internal_Template $_smarty_tpl) {
?>

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
    
    
        <![endif]-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <?php $_smarty_tpl->_subTemplateRender("file:js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['module']->value)."/js.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    <?php $_smarty_tpl->_subTemplateRender("file:css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['module']->value)."/css.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

  </head>
  <body>
    
    <div class="content">
      <?php $_smarty_tpl->_subTemplateRender("file:banner.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

      <?php if (file_exists(((string)$_SERVER['DOCUMENT_ROOT'])."/../templates/".((string)$_smarty_tpl->tpl_vars['module']->value)."/".((string)$_smarty_tpl->tpl_vars['action']->value).".toolbar.tpl")) {?>
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

    </div>
  </body>
</html><?php }
}
