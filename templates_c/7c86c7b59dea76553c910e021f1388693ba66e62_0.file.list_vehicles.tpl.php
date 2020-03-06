<?php
/* Smarty version 3.1.30, created on 2020-02-13 19:45:49
  from "C:\develope\repair_tracker_v2\templates\vehicle\list_vehicles.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e45a76d4be4e7_24610747',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7c86c7b59dea76553c910e021f1388693ba66e62' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\vehicle\\list_vehicles.tpl',
      1 => 1581623143,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e45a76d4be4e7_24610747 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 src='js/modules/vehicle/list_vehicles.js'><?php echo '</script'; ?>
>
<link href="css/modules/vehicle/list_vehicles.css" rel="stylesheet">
<?php echo '<script'; ?>
>
  $(document).ready(() => {
    <?php if (isset($_smarty_tpl->tpl_vars['user']->value)) {?>
      Common.setUser(<?php echo $_smarty_tpl->tpl_vars['user']->value;?>
);
    <?php }?>
    const args = {
      vehicles: <?php echo json_encode($_smarty_tpl->tpl_vars['vehicles']->value);?>

     };
    ListVehicles.init(args);
  });
<?php echo '</script'; ?>
>
<div id='listVehiclesWrapper'>
  <table id='vehiclesTable'>
    <thead>
      <tr>
        <th>Name</th>
        <th>Make</th>
        <th>Model</th>
        <th>Year</th>
        <th>Key<br>Code</th>
        <th>Date<br>Purchased</th>
        <th>KM at<br>Purchase</th>
        <th>Purchase<br>Price</th>
        <th>License<br>Plate</th>
        <th>VIN</th>
        <th></th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>
</div><?php }
}
