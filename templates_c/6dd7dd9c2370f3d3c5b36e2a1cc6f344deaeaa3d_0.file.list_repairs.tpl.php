<?php
/* Smarty version 3.1.30, created on 2020-01-28 18:54:49
  from "C:\develope\repair_tracker_v2\templates\repair\list_repairs.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e3083797899a7_20025382',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6dd7dd9c2370f3d3c5b36e2a1cc6f344deaeaa3d' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\repair\\list_repairs.tpl',
      1 => 1579631614,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e3083797899a7_20025382 (Smarty_Internal_Template $_smarty_tpl) {
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
