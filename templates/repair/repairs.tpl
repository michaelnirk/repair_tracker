{strip}
  <link href="css/modules/repair/repairs.css" rel="stylesheet">
  <div id="repairsWrapper">
    <div id='formRepairWrapper' class='standard-form-wrapper'>
      <form id='repairForm'>
        <div class='standard-form-element'>
          <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
          <label class='form-label' for='repairDate'>
            Repair Date
          </label>
          <input type='text' class='width1' id='repairDate' placeholder='e.g. 29 Mar 2014'/>
          <input type='hidden' id='repairDateHidden' name='repair_date'/>
        </div>
        <div class='standard-form-element'>
          <i class="far fa-asterisk required-field standard-tooltip" title='Required field'></i>
          <label class='form-label' for='description'>
            Description
          </label>
          <textarea id="description" name="description" class='width3 auto-expand'></textarea>
        </div>
        <div class='standard-form-element'>
          <label class='form-label' for='kmAtRepair'>
            KM at Repair
          </label>
          <input type='text' class='width1' name='km_at_repair' id='kmAtRepair' placeholder='km'/>
        </div>
        <div class='standard-form-element'>
          <label class='form-label' for='repairLocation'>
            Repair Location
          </label>
          <input type='text' class='width2' name='repair_location' id='repairLocation' placeholder="e.g. Bob's Auto Shop"/>
        </div>
        <div class='standard-form-element'>
          <label class='form-label' for='repairCost'>
            Repair Cost
          </label>
          <div class='price-group'>
            <input type='text' class='width1' name='repair_cost' id='repairCost' placeholder='e.g. 250'/>
            <label class='form-label sub' for='repairCostCurrency'>Currency</label>
            <select id='repairCostCurrency' class='width1' name='repair_cost_currency'>
              <option></option>
            </select>
          </div>
        </div>
        <div class='notes-header'>
          <label class='form-label'>Notes</label>
          <button type='button' class='toolbar-button standard-tooltip add-note' onclick='Repairs.addNote();' title='Add a new note'>
            <i class="far fa-plus fa-fw"></i>
          </button>
        </div>
        <div id='repairNotesWrapper'>
          {include file='note.tpl'}
        </div>
        <div class='button-wrapper'>
          <button type='button' class='std-button standard-tooltip' title='Save repair' onclick='Repairs.processSaveRepair();'>Save Repair</button>
          <button type='button' class='std-button standard-tooltip' title='Cancel' onclick='Repairs.hideForm();'>Cancel</button>
        </div>
        <input type='hidden' name='vehicle_id' id="vehicleID"/>
        <input type='hidden' name='repair_id' id="repairID"/>
        <input type='hidden' name='notes' id='notes'/>
      </form>
    </div>
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
    </div>
  </div>
  <script src='js/modules/repair/repairs.js'></script>
  <script>
            $(document).ready(() => {
              const args = {
                repairs: {$repairs|@json_encode},
                vehicle: {$vehicle|@json_encode}
              };
              Repairs.init(args);
            });
  </script>
{/strip}