<?php
/* Smarty version 3.1.30, created on 2020-04-12 18:42:54
  from "C:\develop\repair_tracker\templates\sidenav.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e93612e87d6c8_16585024',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bebead1116c6e4f4c94fcf047c60276e4410dc0b' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\sidenav.tpl',
      1 => 1586716971,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e93612e87d6c8_16585024 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="sideNav"><a class="side-nav-element close" href="javascript:void(0);"><i class="far fa-chevron-double-right" onclick="SideNav.hideSideNav();"></i></a><a class="side-nav-element standard-tooltip" href="index.php?module=reminder&action=reminders" title="Manage reminders"><i class="far fa-alarm-clock"></i>Reminders</a><a class="side-nav-element standard-tooltip" href="index.php?module=utility&action=change_password" title="Change password"><i class="far fa-key"></i>Change Password</a><a class="side-nav-element standard-tooltip" href="javascript:void(0);" onclick="logOut();" title='Log out'><i class="fas fa-sign-out-alt"></i>Log out</a></div><?php }
}
