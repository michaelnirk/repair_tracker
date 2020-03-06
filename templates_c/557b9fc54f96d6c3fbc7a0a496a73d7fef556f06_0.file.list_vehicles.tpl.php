<?php
/* Smarty version 3.1.30, created on 2020-01-22 19:16:16
  from "/home/nirk/develope/repair_tracker_v2/templates/vehicle/list_vehicles.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e289170156cb7_49279900',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '557b9fc54f96d6c3fbc7a0a496a73d7fef556f06' => 
    array (
      0 => '/home/nirk/develope/repair_tracker_v2/templates/vehicle/list_vehicles.tpl',
      1 => 1579633495,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289170156cb7_49279900 (Smarty_Internal_Template $_smarty_tpl) {
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
    Common.init();
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
