<?php
/* Smarty version 3.1.30, created on 2020-02-29 17:21:53
  from "/var/www/html/repair_tracker_v2/templates/banner.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e5a8fa1b02eb1_92416959',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07472b51651dc26f39b295be2e0198542f29349f' => 
    array (
      0 => '/var/www/html/repair_tracker_v2/templates/banner.tpl',
      1 => 1582992603,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e5a8fa1b02eb1_92416959 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class='banner'>
  <div class='banner-element left'>
    <a href='index.php?module=vehicle&action=vehicles' id='bannerLink'><i class="fas fa-tools"></i>It's Fixed!</a>
  </div>
  <div class='banner-element right'>
    <div class='banner-element'>
      <span class='standard-tooltip clickable' title='Log out' onclick="logOut();"><i class="fas fa-sign-out-alt"></i>Log out</span>
    </div>
  </div>
</div><?php }
}
