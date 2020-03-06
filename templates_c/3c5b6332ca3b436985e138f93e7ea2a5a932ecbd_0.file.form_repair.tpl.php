<?php
/* Smarty version 3.1.30, created on 2020-02-06 20:05:47
  from "C:\develope\repair_tracker_v2\templates\repair\form_repair.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e3c719b9dfe20_75481444',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c5b6332ca3b436985e138f93e7ea2a5a932ecbd' => 
    array (
      0 => 'C:\\develope\\repair_tracker_v2\\templates\\repair\\form_repair.tpl',
      1 => 1581019544,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:note.tpl' => 1,
  ),
),false)) {
function content_5e3c719b9dfe20_75481444 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>$(document).ready(() => {const args = {<?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>repair: <?php echo json_encode($_smarty_tpl->tpl_vars['repair']->value->getPropertiesArray());
}?>};FormRepair.init(args);});<?php echo '</script'; ?>
><div id='formRepairWrapper' class='standard-form-wrapper'><form id='repairForm' action='?module=repair&action=set_repair' method='post'><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='repairDate'>Repair Date</label><input type='text' class='width1' id='repairDate' placeholder='e.g. 29 Mar 2014'/><input type='hidden' id='repairDateHidden' name='repair_date'/></div><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='description'>Description</label><textarea id="description" name="description" class='width3 auto-expand' rows='2' data-min-rows='2'><?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
echo $_smarty_tpl->tpl_vars['repair']->value->getDescription();
}?></textarea></div><div class='standard-form-element'><label class='form-label' for='kmAtRepair'>KM at Repair</label><input type='text' class='width1' name='km_at_repair' id='kmAtRepair' placeholder='km' <?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['repair']->value->getKMAtRepair();?>
"<?php }?>/></div><div class='standard-form-element'><label class='form-label' for='repairLocation'>Repair Location</label><input type='text' class='width2' name='repair_location' id='repairLocation' placeholder="e.g. Bob's Auto Shop" <?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['repair']->value->getRepairLocation();?>
"<?php }?>/></div><div class='standard-form-element'><label class='form-label' for='repairCost'>Repair Cost</label><div class='price-group'><input type='text' class='width1' name='repair_cost' id='repairCost' placeholder='e.g. 250' <?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>value="<?php echo $_smarty_tpl->tpl_vars['repair']->value->getRepairCost();?>
"<?php }?>/><label class='form-label sub' for='repairCostCurrency'>Currency</label><select id='repairCostCurrency' class='width1' name='repair_cost_currency'><option></option><option value='2'>€</option><option value='1'>$</option></select></div></div><div class='notes-header'><label class='form-label'>Notes</label><button type='button' class='toolbar-button standard-tooltip add-note' onclick='FormRepair.addNote();' title='Add a new note'><i class="far fa-plus"></i></button></div><div id='repairNotesWrapper'><?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
$_smarty_tpl->_assignInScope('notes', $_smarty_tpl->tpl_vars['repair']->value->getNotes());
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notes']->value, 'note');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['note']->value) {
?><div class='standard-form-element note saved' id="<?php echo $_smarty_tpl->tpl_vars['note']->value->getNoteID();?>
"><textarea class='width3 auto-expand' data-min-rows='2'><?php echo $_smarty_tpl->tpl_vars['note']->value->getNoteText();?>
</textarea><i class="fas fa-trash-alt standard-tooltip" title='Delete note' onclick='FormRepair.processDeleteNote(this);'></i></div><?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}
$_smarty_tpl->_subTemplateRender("file:note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div><div class='button-wrapper'><button type='button' class='std-button standard-tooltip' title='Save repair' onclick='FormRepair.processSaveRepair();'>Save Repair</button></div><input type='hidden' name='vehicle_id' value="<?php echo $_smarty_tpl->tpl_vars['vehicleID']->value;?>
"/><input type='hidden' name='repair_id' <?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>value='<?php echo $_smarty_tpl->tpl_vars['repair']->value->getRepairID();?>
'<?php }?>/><input type='hidden' name='notes' id='notes'/></form></div><?php }
}
