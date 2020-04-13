<?php
/* Smarty version 3.1.30, created on 2020-03-29 14:51:58
  from "C:\develop\repair_tracker\templates\part\parts.toolbar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e80b60e1b9f45_27478128',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7ce50618c7776656489adad7a8bd6272f4c2b23b' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\part\\parts.toolbar.tpl',
      1 => 1585493504,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:toolbar_parent.tpl' => 1,
  ),
),false)) {
function content_5e80b60e1b9f45_27478128 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13157615845e80b60e1b9241_60015562', 'leftContent');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:toolbar_parent.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block 'leftContent'} */
class Block_13157615845e80b60e1b9241_60015562 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <button type="button" class='toolbar-button standard-tooltip back-button disabled' title='Previous page' onclick='window.history.back();'>
    <i class="fas fa-arrow-alt-left fa-fw"></i>
  </button>
  <button type="button" id='createPartButton' class='toolbar-button standard-tooltip' title="Create a new part for this repair" onclick="Parts.processAddPart();">
    <i class="fas fa-plus fa-fw"></i>
  </button>
<?php
}
}
/* {/block 'leftContent'} */
}
