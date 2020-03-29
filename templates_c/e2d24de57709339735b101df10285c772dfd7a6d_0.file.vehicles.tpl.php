<?php
/* Smarty version 3.1.30, created on 2020-03-29 11:08:39
  from "C:\develop\repair_tracker\templates\vehicle\vehicles.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e8081b7747301_40039167',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2d24de57709339735b101df10285c772dfd7a6d' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\vehicle\\vehicles.tpl',
      1 => 1585477761,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:note.tpl' => 1,
  ),
),false)) {
function content_5e8081b7747301_40039167 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link href="css/modules/vehicle/vehicles.css" rel="stylesheet">
<div id='vehiclesWrapper'><div id='formVehicleWrapper' class='standard-form-wrapper'><form id='vehicleForm'><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='name'>Vehicle Name</label><input type='text' class='width3' name='name' id='name' placeholder="e.g. Bob's ride"/></div><div class='standard-form-element'><label class='form-label' for='make'>Make</label><input type='text' class='width2' name='make' id='make' placeholder='e.g. Skoda'/></div><div class='standard-form-element'><label class='form-label' for='model'>Model</label><input type='text' class='width2' name='model' id='model' placeholder='e.g. Octavia'/></div><div class='standard-form-element'><label class='form-label' for='year'>Year</label><input type='text' class='width1' name='year' id='year' placeholder='e.g. 2011'/></div><div class='standard-form-element'><label class='form-label' for='keyCode'>Key Code</label><input type='text' class='width1' name='key_code' id='keyCode' placeholder='e.g. 8004 acg'/></div><div class='standard-form-element'><label class='form-label' for='datePurchased'>Date Purchased</label><input type='text' class='width1' id='datePurchased' placeholder='e.g. 29 Mar 2014'/><input type='hidden' id='datePurchasedHidden' name='date_purchased'/></div><div class='standard-form-element'><label class='form-label' for='kmAtPurchase'>KM at Purchase</label><input type='text' class='width1' name='km_at_purchase' id='kmAtPurchase' placeholder='e.g. 11200'/></div><div class='standard-form-element'><label class='form-label' for='vin'>VIN</label><input type='text' class='width2' name='vin' id='vin' placeholder="e.g. WVWZZZ6NZXY162235"/></div><div class='standard-form-element'><label class='form-label' for='licensePlate'>License Plate Number</label><input type='text' class='width1' name='license_plate' id='licensePlate' placeholder='e.g. SW AD 2011 '/></div><div class='standard-form-element'><label class='form-label' for='purchasePrice'>Purchase Price</label><div class='price-group'><input type='text' class='width1' name='purchase_price' id='purchasePrice' placeholder='e.g. 25000'/><label class='form-label sub' for='currency'>Currency</label><select id='purchaseCurrency' class='width1' name='purchase_currency'><option></option></select></div></div><div class='notes-header'><label class='form-label'>Notes</label><button type='button' class='toolbar-button standard-tooltip add-note' onclick='Vehicles.addNote();' title='Add a new note'><i class="far fa-plus fa-fw"></i></button></div><div id='vehicleNotesWrapper'><?php $_smarty_tpl->_subTemplateRender("file:note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div><div class='button-wrapper'><button type='button' class='std-button standard-tooltip' title='Save vehicle' onclick='Vehicles.processSaveVehicle();'>Save Vehicle</button><button type='button' class='std-button standard-tooltip' title='Cancel' onclick='Vehicles.hideForm();'>Cancel</button></div><input type='hidden' name='vehicle_id' id="vehicleID"/><input type='hidden' name='notes' id='notes'/></form></div><div id='listVehiclesWrapper'><table id='vehiclesTable'><thead><tr><th>Name</th><th>Make</th><th>Model</th><th>Year</th><th>Key<br>Code</th><th>Date<br>Purchased</th><th>KM at<br>Purchase</th><th>Purchase<br>Price</th><th>License<br>Plate</th><th>VIN</th><th></th><th></th></tr></thead><tbody></tbody></table></div></div>    
<?php echo '<script'; ?>
 src='js/modules/vehicle/vehicles.js'><?php echo '</script'; ?>
>
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
  Vehicles.init(args);
});
<?php echo '</script'; ?>
><?php }
}
