<?php
/* Smarty version 3.1.30, created on 2020-01-22 19:32:26
  from "/home/nirk/develope/repair_tracker_v2/templates/repair/form_repair.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5e28953ab7dc51_13101425',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '200908308a78b807b344ebab8d98304b41a728d0' => 
    array (
      0 => '/home/nirk/develope/repair_tracker_v2/templates/repair/form_repair.tpl',
      1 => 1570734101,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e28953ab7dc51_13101425 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once '/home/nirk/develope/repair_tracker_v2/Smarty/plugins/modifier.date_format.php';
echo '<script'; ?>
>
    <?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>
        FormRepair.repairJSON = <?php echo $_smarty_tpl->tpl_vars['repairJSON']->value;?>
;
    <?php }
echo '</script'; ?>
>
<div class="form-repair-wrapper-div contentContainer topContainer container">
    <div class="row center" id="topRow">
        <div class="col-md-6 col-md-offset-3 whiteText">
            <?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>
                <h1>Edit repair for <?php echo $_smarty_tpl->tpl_vars['vehicleName']->value;?>
</h1>
                <h2>
                    Edit data for this repair by typing the 
                    <br>new data into the fields below and then clicking
                    <br>'Update Repair'
                </h2>
            <?php } else { ?>
                <h1>Add a new repair for <?php echo $_smarty_tpl->tpl_vars['vehicleName']->value;?>
</h1>
                <h2>
                    Enter data for new repair into the form below and then click<br>'Add Repair'
                </h2>
            <?php }?>
            
            <?php if (isset($_smarty_tpl->tpl_vars['errors']->value)) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
                  <div class="alert alert-danger"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
            <?php if (isset($_smarty_tpl->tpl_vars['messages']->value)) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
?>
                  <div class="alert alert-success"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
        </div>    
    </div>
    <div class="col-md-5 col-md-offset-3">
        <form id="repairForm" class="form-horizontal" role="form" method="post" action="index.php?module=Repair&action=saverepair">
            <div class="form-group form-group-sm">
                <label class="control-label col-xs-5 whiteText"><span class="redText">*</span> Indicates required field</label>
            </div>
            <div class="form-group">
                <label for="repairdescription" class="control-label col-xs-5 whiteText"><span class="redText">* </span>Repair Description</label>
                <div class='col-xs-7'>
                    <textarea rows='3' name='repair_descrip' id="repairDescription" placeholder='Repair Description' class="form-control" required><?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
echo $_smarty_tpl->tpl_vars['repair']->value->getRepair_descrip();
}?></textarea>
                </div>              
            </div>
            <div class="form-group">
                <label for="repairdate" class='control-label col-xs-5 whiteText'><span class="redText">* </span>Repair Date</label>
                <div class='col-xs-7'>
                    <input class="form-control"
                           id="repairDate"
                           name="repair_date" 
                           type='text' 
                           placeholder='Repair Date' 
                           value="<?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['repair']->value->getRepair_date(),"%d %b %Y");
}?>"
                           required
                    />
                </div>              
            </div>
            <div class="form-group">
                <label for="km" class='control-label col-xs-5 whiteText'>KM at Repair</label>
                <div class='col-xs-7'>
                    <input class="form-control" 
                           name="km_at_repair" 
                           type='number' 
                           placeholder='KM at Repair' 
                           value="<?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
echo $_smarty_tpl->tpl_vars['repair']->value->getKm_at_repair();
}?>"
                    />
                </div>              
            </div>              
            <div class="form-group">
                <label for="repairlocation" class='control-label col-xs-5 whiteText'><span class="redText">* </span>Repair Location</label>
                <div class='col-xs-7'>
                    <input class="form-control" 
                           name="repair_loc" 
                           id="repairLocation"
                           type='text' 
                           placeholder='Repair Location' 
                           value="<?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
echo $_smarty_tpl->tpl_vars['repair']->value->getRepair_loc();
}?>"
                           required
                    />
                </div>              
            </div>
            <div class="form-group">
                <label for="cost" class='control-label col-xs-5 whiteText'>Repair Cost</label>
                <div class='col-xs-7'>
                    <input class="form-control" 
                           name="cost" 
                           type='number' 
                           min="0" 
                           step='.01' 
                           placeholder='Repair Cost' 
                           value="<?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
echo $_smarty_tpl->tpl_vars['repair']->value->getCost();
}?>"
                    />
                </div>              
            </div>
            <div class="form-group marginBottom">
                <label for="notes" class='control-label col-xs-5 whiteText'>Notes</label>
                <div class='col-xs-7'>
                    <textarea class='form-control' id='repairNotes' rows='3' name="notes" placeholder='Notes'><?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {
echo $_smarty_tpl->tpl_vars['repair']->value->getNotes();
}?></textarea>
                </div>              
            </div>
            <div class="form-group marginBottom">
                <label class='col-xs-6'></label>
                <?php if (isset($_smarty_tpl->tpl_vars['repair']->value)) {?>
                    <button class='btn btn-success' id='editRepair' type='button'>Update Repair</button>
                    <button class='btn btn-danger' id='cancelEdit' type='button'>Cancel</button>
                    <input id='repairID' type='hidden' name='repair_ID' value="<?php echo $_smarty_tpl->tpl_vars['repair']->value->getRepair_ID();?>
">
                <?php } else { ?>
                    <button class='btn btn-success' id='addRepair' type='button'>Add Repair</button>
                    <button class='btn btn-danger' id='cancelAdd' type='button'>Cancel</button>
                <?php }?>   
            </div>
        </form>                    
    </div>
</div><?php }
}
