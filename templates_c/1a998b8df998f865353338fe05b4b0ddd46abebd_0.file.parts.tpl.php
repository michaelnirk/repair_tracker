<?php
/* Smarty version 3.1.30, created on 2020-08-17 10:16:15
  from "C:\develop\repair_tracker\templates\part\parts.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5f3a58ef29c1d4_44753122',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1a998b8df998f865353338fe05b4b0ddd46abebd' => 
    array (
      0 => 'C:\\develop\\repair_tracker\\templates\\part\\parts.tpl',
      1 => 1597659363,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:note.tpl' => 1,
  ),
),false)) {
function content_5f3a58ef29c1d4_44753122 (Smarty_Internal_Template $_smarty_tpl) {
?>
<link href="css/modules/part/parts.css" rel="stylesheet"/><div id="partsWrapper"><div id='formPartWrapper' class='standard-form-wrapper'><form id="partForm"><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='description'>Description</label><textarea id="description" name="description" class='width3 auto-expand'></textarea></div><div class='standard-form-element'><label class='form-label' for='partNumber'>Part Number</label><input type='text' class='width3' name='part_number' id='partNumber' placeholder='Part number'/></div><div class='standard-form-element'><label class='form-label' for='source'>Source</label><input type='text' class='width3' name='source' id='source' placeholder='Part source'/></div><div class='standard-form-element'><label class='form-label' for='brand'>Brand</label><input type='text' class='width3' name='brand' id='brand' placeholder='Part brand'/></div><div class='standard-form-element'><label class='form-label' for='partCost'>Part Cost</label><div class='price-group'><input type='number' class='width2' name='part_cost' id='partCost' placeholder='Part price'/><label class='form-label sub' for='partCostCurrency'>Currency</label><select id='partCostCurrency' class='width1' name='part_cost_currency'><option></option></select></div></div><div class='standard-form-element'><i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i><label class='form-label' for='qty'>Quantity</label><input type='number' class='width1' name='qty' id='qty' placeholder='Quantity'/></div><div class='standard-form-element'><label class='form-label' for='purchaseDate'>Purchase Date</label><input type='text' class='width1' id='purchaseDate' placeholder='e.g. 29 Mar 2014'/><input type='hidden' id='purchaseDateHidden' name='purchase_date'/></div><div class='notes-header'><label class='form-label'>Notes</label><button type='button' class='toolbar-button standard-tooltip add-note' onclick='Parts.addNote();' title='Add a new note'><i class="far fa-plus fa-fw"></i></button></div><div id='partNotesWrapper'><?php $_smarty_tpl->_subTemplateRender("file:note.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</div><div class='button-wrapper'><button type='button' class='std-button standard-tooltip' title='Save part' onclick='Parts.processSavePart();'>Save Part</button><button type='button' class='std-button standard-tooltip' title='Cancel' onclick='Parts.hideForm();'>Cancel</button></div><input type='hidden' name='repair_id' id="repairID"/><input type='hidden' name='part_id' id="partID"/><input type='hidden' name='notes' id='notes'/></form></div><div id="listPartsWrapper"><div class="table-wrapper"><table class="table table-bordered whiteText" id='partsTable'><thead><tr><th>Part Description</th><th>Part Number/<br/>Item Number</th><th>Source</th><th>Brand</th><th>Price (ea)</th><th>Quantity</th><th>Purchase<br>Date</th><th></th></tr></thead><tbody></tbody></table></div></div></div><?php echo '<script'; ?>
 src='js/modules/part/parts.js'><?php echo '</script'; ?>
><?php echo '<script'; ?>
>$(document).ready(() => {const args = {parts: <?php echo json_encode($_smarty_tpl->tpl_vars['parts']->value);?>
,repair: <?php echo json_encode($_smarty_tpl->tpl_vars['repair']->value);?>
,vehicle: <?php echo json_encode($_smarty_tpl->tpl_vars['vehicle']->value);?>
};Parts.init(args);});<?php echo '</script'; ?>
><?php }
}
