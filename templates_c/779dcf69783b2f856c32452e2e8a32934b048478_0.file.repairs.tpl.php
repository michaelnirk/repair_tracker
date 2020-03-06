<?php
/* Smarty version 3.1.30, created on 2020-02-25 19:26:55
  from "C:\develope\repair_tracker_v2\templates\repair\repairs.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e5574ffeea9a7_09374162',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '779dcf69783b2f856c32452e2e8a32934b048478' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\repair\\repairs.tpl',
      1 => 1582658812,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:note.tpl' => 1,
  ),
),false)) {
function content_5e5574ffeea9a7_09374162 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link href="css/modules/repair/repairs.css" rel="stylesheet"><div id="repairsWrapper"><div id='formRepairWrapper' class='standard-form-wrapper'><form id='repairForm'><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='repairDate'>Repair Date</label><input type='text' class='width1' id='repairDate' placeholder='e.g. 29 Mar 2014'/><input type='hidden' id='repairDateHidden' name='repair_date'/></div><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='description'>Description</label><textarea id="description" name="description" class='width3 auto-expand'></textarea></div><div class='standard-form-element'><label class='form-label' for='kmAtRepair'>KM at Repair</label><input type='text' class='width1' name='km_at_repair' id='kmAtRepair' placeholder='km'/></div><div class='standard-form-element'><label class='form-label' for='repairLocation'>Repair Location</label><input type='text' class='width2' name='repair_location' id='repairLocation' placeholder="e.g. Bob's Auto Shop"/></div><div class='standard-form-element'><label class='form-label' for='repairCost'>Repair Cost</label><div class='price-group'><input type='text' class='width1' name='repair_cost' id='repairCost' placeholder='e.g. 250'/><label class='form-label sub' for='repairCostCurrency'>Currency</label><select id='repairCostCurrency' class='width1' name='repair_cost_currency'><option></option></select></div></div><div class='notes-header'><label class='form-label'>Notes</label><button type='button' class='toolbar-button standard-tooltip add-note' onclick='Repairs.addNote();' title='Add a new note'><i class="far fa-plus fa-fw"></i></button></div><div id='repairNotesWrapper'><?php $_smarty_tpl->_subTemplateRender("file:note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div><div class='button-wrapper'><button type='button' class='std-button standard-tooltip' title='Save repair' onclick='Repairs.processSaveRepair();'>Save Repair</button><button type='button' class='std-button standard-tooltip' title='Cancel' onclick='Repairs.hideForm();'>Cancel</button></div><input type='hidden' name='vehicle_id' id="vehicleID"/><input type='hidden' name='repair_id' id="repairID"/><input type='hidden' name='notes' id='notes'/></form></div><div id='listRepairsWrapper'><table id='repairsTable'><thead><tr><th>Description</th><th>Repair Date</th><th>KM</th><th>Repair Location</th><th>Repair Cost</th><th></th></tr></thead><tbody></tbody></table></div></div><?php echo '<script'; ?>
 src='js/modules/repair/repairs.js'><?php echo '</script'; ?>
><?php echo '<script'; ?>
>$(document).ready(() => {const args = {repairs: <?php echo json_encode($_smarty_tpl->tpl_vars['repairs']->value);?>
,vehicle: <?php echo json_encode($_smarty_tpl->tpl_vars['vehicle']->value);?>
};Repairs.init(args);});<?php echo '</script'; ?>
><?php }
}
