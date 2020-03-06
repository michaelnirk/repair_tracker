<?php
/* Smarty version 3.1.30, created on 2020-01-21 20:38:23
  from "/home/nirk/develope/repair_tracker_v2/templates/repair/list_repairs.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e27532f3c70b6_27816932',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76966781296e076cd4ca6a87fe2517b634da326d' => 
    array (
      0 => '/home/nirk/develope/repair_tracker_v2/templates/repair/list_repairs.tpl',
      1 => 1579635215,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e27532f3c70b6_27816932 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src='js/modules/repair/list_repairs.js'><?php echo '</script'; ?>
>
<link href="css/modules/repair/list_repairs.css" rel="stylesheet">
<?php echo '<script'; ?>
>
  $(document).ready(() => {
    const args = {
      repairs: <?php echo json_encode($_smarty_tpl->tpl_vars['repairs']->value);?>
,
      vehicleID: <?php echo $_smarty_tpl->tpl_vars['vehicleID']->value;?>

    };
    ListRepairs.init(args);
  });
<?php echo '</script'; ?>
>
<div id='listRepairsWrapper'>
  <table id='repairsTable'>
    <thead>
      <tr>
        <th>Description</th>
        <th>Repair Date</th>
        <th>KM</th>
        <th>Repair Location</th>
        <th>Repair Cost</th>
        <th></th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div><?php }
}
