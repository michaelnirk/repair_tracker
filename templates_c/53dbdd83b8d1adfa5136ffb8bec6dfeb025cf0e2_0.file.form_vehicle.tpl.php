<?php
/* Smarty version 3.1.30, created on 2020-02-10 19:58:24
  from "C:\develope\repair_tracker_v2\templates\vehicle\form_vehicle.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e41b5e0036152_20603276',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '53dbdd83b8d1adfa5136ffb8bec6dfeb025cf0e2' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\vehicle\\form_vehicle.tpl',
      1 => 1581364701,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:note.tpl' => 1,
  ),
),false)) {
function content_5e41b5e0036152_20603276 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link href="css/modules/vehicle/form_vehicle.css" rel="stylesheet">
<?php echo '<script'; ?>
>
  $(document).ready(() => {
    const args = {
      <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>
      vehicle: <?php echo json_encode($_smarty_tpl->tpl_vars['vehicle']->value->getPropertiesArray());?>

      <?php }?>
    };
    FormVehicle.init(args);
  });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src='js/modules/vehicle/form_vehicle.js'><?php echo '</script'; ?>
>
<div id='formVehicleWrapper' class='standard-form-wrapper'>
  <form id='vehicleForm' action='?module=Vehicle&action=set_vehicle' method='post'>
    <div class='standard-form-element'>
      <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
      <label class='form-label' for='name'>
        Vehicle Name
      </label>
      <input type='text' class='width3' name='name' id='name' placeholder="e.g. Bob's ride" <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getName();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='make'>
        Make
      </label>
      <input type='text' class='width2' name='make' id='make' placeholder='e.g. Skoda' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getMake();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='model'>
        Model
      </label>
      <input type='text' class='width2' name='model' id='model' placeholder='e.g. Octavia' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getModel();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='year'>
        Year
      </label>
      <input type='text' class='width1' name='year' id='year' placeholder='e.g. 2011' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getYear();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='keyCode'>
        Key Code
      </label>
      <input type='text' class='width1' name='key_code' id='keyCode' placeholder='e.g. 8004 acg' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getKeyCode();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='datePurchased'>
        Date Purchased
      </label>
      <input type='text' class='width1' id='datePurchased' placeholder='e.g. 29 Mar 2014'/>
      <input type='hidden' id='datePurchasedHidden' name='date_purchased'/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='kmAtPurchase'>
        KM at Purchase
      </label>
      <input type='text' class='width1' name='km_at_purchase' id='kmAtPurchase' placeholder='e.g. 11200' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getKmAtPurchase();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='vin'>
        VIN
      </label>
      <input type='text' class='width2' name='vin' id='vin' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getVin();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='licensePlate'>
        License Plate Number
      </label>
      <input type='text' class='width1' name='license_plate' id='licensePlate' placeholder='e.g. SW AD 2011 ' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getLicensePlate();?>
"<?php }?>/>
    </div>
    <div class='standard-form-element'>
      <label class='form-label' for='purchasePrice'>
        Purchase Price
      </label>
      <div class='price-group'>
        <input type='text' class='width1' name='purchase_price' id='purchasePrice' placeholder='e.g. 25000' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getPurchasePrice();?>
"<?php }?>/>
        <label class='form-label sub' for='currency'>Currency</label>
        <select id='purchaseCurrency' class='width1' name='purchase_currency'>
          <option></option>
        </select>
      </div>
    </div>
    <div class='notes-header'>
      <label class='form-label'>Notes</label>
      <button type='button' class='toolbar-button standard-tooltip add-note' onclick='FormVehicle.addNote();' title='Add a new note'>
        <i class="far fa-plus"></i>
      </button>
    </div>
    <div id='vehicleNotesWrapper'>
      <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>
          <?php $_smarty_tpl->_assignInScope('notes', $_smarty_tpl->tpl_vars['vehicle']->value->getNotes());
?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notes']->value, 'note');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['note']->value) {
?>
            <div class='standard-form-element note saved' id="<?php echo $_smarty_tpl->tpl_vars['note']->value->getNoteID();?>
">
              <textarea class='width3 auto-expand' data-min-rows='2'><?php echo $_smarty_tpl->tpl_vars['note']->value->getNoteText();?>
</textarea>
              <i class="fas fa-trash-alt standard-tooltip" title='Delete note' onclick='FormVehicle.processDeleteNote(this);'></i>
            </div>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      <?php }?>
      <?php $_smarty_tpl->_subTemplateRender("file:note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </div>
    <div class='button-wrapper'>
      <button type='button' class='std-button standard-tooltip' title='Save vehicle' onclick='FormVehicle.processSaveVehicle();'>Save Vehicle</button>
    </div>
    <input type='hidden' name='vehicle_id' <?php if (isset($_smarty_tpl->tpl_vars['vehicle']->value)) {?>value='<?php echo $_smarty_tpl->tpl_vars['vehicle']->value->getVehicleID();?>
'<?php }?>/>
    <input type='hidden' name='notes' id='notes'/>
  </form>
</div><?php }
}
