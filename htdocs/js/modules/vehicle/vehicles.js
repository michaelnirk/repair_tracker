Vehicles = (function() {

  let _this = {};

  /***********************  Variables  ***************************/
  let vehicle = null;
  let vehicles = null;
  const dateTimePickerOptions = {
    altField: '#datePurchasedHidden',
    altFormat: 'yy-mm-dd',
    dateFormat: 'dd M yy',
    changeMonth: true,
    changeYear: true
  };
  let noteTemplate = null;
  const errors = [];
  let currencyData;
  let table = null;
  const tableOptions = {
    autoWidth: false,
    order: [[11, 'asc']],
    columnDefs: [
      {width: "14%", targets: 0},
      {width: "10%", targets: 1},
      {width: "14%", targets: 2},
      {width: "5%", targets: 3},
      {width: "6%", targets: 4},
      {width: "7%", targets: 5},
      {width: "7%", targets: 6},
      {width: "7%", targets: 7},
      {width: "7%", targets: 8},
      {width: "14%", targets: 9},
      {width: "8%", targets: 10},
      {visible: false, targets: [11, 12]},
      {orderable: false, sortable: false, targets: 10}
    ],
    columns: [
      {
        data: "name",
        className: "text-left",
        render: function(data) {
          return data;
        }
      },
      {
        data: "make",
        className: "text-left",
        render: function(data) {
          return data;
        }
      },
      {
        data: "model",
        className: "text-left",
        render: function(data) {
          return data;
        }
      },
      {
        data: "year",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "key_code",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "date_purchased",
        className: "text-center",
        render: function(data) {
          if (data) {
            return moment(data).format("DD MMM YYYY");
          } else {
            return "";
          }
        }
      },
      {
        data: "km_at_purchase",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "purchase_price",
        className: "text-center",
        render: function(data, type, row) {
          if (type === "display") {
            let content = "";
            if (data) {
              content = currencyData[row.purchase_currency].currency_symbol_position === "1"
                ? `${currencyData[row.purchase_currency].html_entity}${data}`
                : `${data} ${
                currencyData[row.purchase_currency].html_entity
                }`;
            }
            return content;
          } else {
            return data;
          }
        }
      },
      {
        data: "license_plate",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: "vin",
        className: "text-center",
        render: function(data) {
          return data;
        }
      },
      {
        data: null,
        className: "all-center",
        render: function(data, type, row) {
          const repairCount = row.repair_count;
          const repairCountTitle = (repairCount === '1') ? 'repair' : 'repairs';
          const editVehicleIcon = `<i class="fas fa-edit fa-fw standard-tooltip" title='Edit vehicle' onclick='Vehicles.processEditVehicle(${row.vehicle_id});'></i>`;
          const repairsIcon = `<a href='index.php?module=repair&action=repairs&vehicle_id=${row.vehicle_id}'>
                                     <div class='icon-with-count'>
                                       <i class="fas fa-car-mechanic fa-fw standard-tooltip" title='Vehicle repairs'></i>
                                       <div class='icon-count standard-tooltip' title='This vehicle has ${repairCount} ${repairCountTitle}'>
                                         ${repairCount}
                                       </div>
                                     </div>
                                   </a>`;
          const exportRepairDataIcon = `<a href='index.php?module=vehicle&action=export_pdf&vehicle_id=${row.vehicle_id}' class="standard-tooltip" title="Export vehicle repair data as PDF">
                                          <i class="fas fa-file-export"></i>
                                        </a>`;
          const deleteVehicleIcon = `<i class="fas fa-trash-alt fa-fw standard-tooltip" title='Delete vehicle' onclick='Vehicles.processDeleteVehicle(${row.vehicle_id});'></i>`;
          return `<div class='table-function-icons-wrapper'>${repairsIcon}${editVehicleIcon}${deleteVehicleIcon}${exportRepairDataIcon}</div>`;
        }
      },
      {
        data: "vehicle_id",
        render: function(data) {
          return data;
        }
      },
      {
        data: "archived",
        render: function(data) {
          return data;
        }
      }
    ],
    createdRow: function(row, data) {
      $(row).attr('id', `${data.vehicle_id}`);
    },
    drawCallback: function() {
      initializeStandardTooltip();
    }
  };

  /***********************  end Variables  ***********************/

  /***********************  Functions  ***************************/
  async function init(args) {
    currencyData = await Session.getItem("currencyData");
    populateCurrencySelect();
    vehicles = args.vehicles;
    const tableData = vehicles.filter(vehicle => vehicle.archived === "0");
    tableOptions.data = tableData;
    table = $("#vehiclesTable").DataTable(tableOptions);
    evaluateBackButton();
    $("#datePurchased").datepicker(dateTimePickerOptions);
    //Create template for notes
    const noteTemplateElement = $("div.note.new");
    noteTemplate = noteTemplateElement.first().clone();
    noteTemplateElement.remove();
    noteTemplate.removeClass("new");
    initializeStandardTooltip();
  }

  function populateCurrencySelect() {
    const select = $("#purchaseCurrency");
    for (const currencySymbolID in currencyData) {
      select.append(new Option(
        currencyData[currencySymbolID].currency_symbol,
        currencySymbolID
        )
        );
    }
  }

  function processEditVehicle(vehicleID) {
    if (vehicle) {
      const title = 'Proceed?';
      const message = 'If you continue all of your changes will be lost. Do you really want to proceed?';
      showVerificationMessage(title, message).then(result => {
        if (result) {
          clearForm();
          editVehicle(vehicleID);
        }
      });
    } else {
      editVehicle(vehicleID);
    }
  }

  function editVehicle(vehicleID) {
    vehicle = table.row(`#${vehicleID}`).data();
    setPageTitle(`Edit Vehicle - ${vehicle.name}`);
    fillForm(vehicle);
    showForm();
  }

  function fillForm() {
    $('#name').val(vehicle.name);
    $('#make').val(vehicle.make ? vehicle.make : '');
    $('#model').val(vehicle.model ? vehicle.model : '');
    $('#year').val(vehicle.year ? vehicle.year : '');
    $('#keyCode').val(vehicle.key_code ? vehicle.key_code : '');
    if (vehicle.date_purchased) {
      $("#datePurchased").datepicker('setDate', moment(vehicle.date_purchased).format("DD MMM YYYY")).trigger("change");
    }
    $('#kmAtPurchase').val(vehicle.km_at_purchase ? vehicle.km_at_purchase : '');
    $('#vin').val(vehicle.vin ? vehicle.vin : '');
    $('#licensePlate').val(vehicle.license_plate ? vehicle.license_plate : '');
    if (vehicle.purchase_price) {
      $('#purchasePrice').val(vehicle.purchase_price);
      $("#purchaseCurrency").val(vehicle.purchase_currency);
    }
    if (parseInt(vehicle.archived, 10) === 1) {
      $('#archived').prop('checked', true);
    }
    if (vehicle.notes && vehicle.notes.length) {
      for (const note of vehicle.notes) {
        addNote(note);
      }
    }
  }

  function processAddVehicle() {
    if (vehicle) {
      const title = 'Proceed?';
      const message = 'If you continue all of your changes will be lost. Do you really want to proceed?';
      showVerificationMessage(title, message).then(result => {
        if (result) {
          addVehicle();
        }
      });
    } else {
      addVehicle();
    }
  }
  
  function addVehicle() {
    clearForm();
    showForm();
    setPageTitle('Add New Vehicle');
  }

  function showForm() {
    $('#formVehicleWrapper').slideDown(700, () => {
      $("textarea.auto-expand").each(function() {
        if (this.value) {
          this.style.height = this.scrollHeight + 10 + "px";
        }
      });
      $('div.content').animate({
        scrollTop: $("div.content").offset().top
      }, 600);
    });
  }

  function hideForm() {
    $('#formVehicleWrapper').slideUp(700, () => {
      setPageTitle('Saved Vehicles');
      clearForm();
    });
  }

  function clearForm() {
    vehicle = null;
    $('#vehicleID').val('');
    $('#name').val('');
    $('#make').val('');
    $('#model').val('');
    $('#year').val('');
    $('#keyCode').val('');
    $("#datePurchased").datepicker('setDate', null);
    $('#kmAtPurchase').val('');
    $('#vin').val('');
    $('#licensePlate').val('');
    $('#purchasePrice').val('');
    $("#purchaseCurrency").val('');
    $("#archived").prop("checked", false);
    $("#vehicleNotesWrapper").empty();
  }

  async function processSaveVehicle() {
    if (await validateForm()) {
      //Gather all notes
      const notes = [];
      $(".standard-form-element.note").each(function() {
        const note = {
          note_id: $(this).attr('id'),
          note_text: `${$("textarea", $(this)).val()}`

        };
        notes.push(note);
      });
      $("#notes").val(JSON.stringify(notes));
      if (vehicle) {
        $('#vehicleID').val(vehicle.vehicle_id);
      }
      const vehicleFormData = new FormData(vehicleForm);
      $.ajax({
        url: 'index.php?module=vehicle&action=set_vehicle',
        processData: false,
        contentType: false,
        type: 'post',
        data: vehicleFormData,
        beforeSend: function() {
          showWorking();
        }
      }).done(result => {
        try {
          result = JSON.parse(result);
          if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
            const vehicleData = result.data;
            if (vehicle) {
              for (let i = 0; i < vehicles.length; i++) {
                if (vehicles[i].vehicle_id === vehicleData.vehicle_id) {
                  vehicles[i] = vehicleData;
                  break;
                }
              }
            } else {
              vehicles.push(vehicleData);
            }
            table.rows().remove();
            if ($("#archiveVehiclesButton").hasClass('active')) {
              table.rows.add(vehicles);
            } else {
              const tableData = vehicles.filter(vehicle => vehicle.archived === '0');
              table.rows.add(tableData);
            }
            table.draw();
            const message = vehicle ? "Vehicle information was successfully updated!" : "The vehicle was successfully created!";
            displayMessage([message]);
            hideForm();
          } else if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === false) {
            if (result.data.hasOwnProperty('messages') && result.data.messages.hasOwnProperty('errors') && result.data.messages.errors.length) {
              errors.length = 0;
              const title = 'There are errors!';
              const message = result.data.messages.errors.join('<br>');
              showMessage(title, message);
            }
          } else {
            console.error(`Error setting vehicle: ${result}`);
            const title = 'Error!';
            const message = 'An error has occurred. The vehicle data could not be successfully saved.';
            showMessage(title, message);
          }
        } catch (e) {
          const title = 'Error!';
          const message = 'An error has occurred. The vehicle data could not be successfully saved.';
          showMessage(title, message);
        }
      }).fail((xhr, text, error) => {
        console.error(`Error setting vehicle: ${error}`);
        const title = 'Error!';
        const message = 'An error has occurred. The vehicle data could not be successfully saved.';
        showMessage(title, message);
      }).always(() => {
        hideWorking();
      });
    }
  }

  function validateForm() {
    errors.length = 0;
    let isValid = true;

    const name = $("#name");
    if (name.val().trim()) {
      name.removeClass("invalid");
    } else {
      isValid = false;
      name.addClass("invalid");
      errors.push("Please enter a vehicle name");
    }

    const yearInput = $("#year");
    const yearVal = yearInput.val().trim();
    if (yearVal) {
      if (isNaN(yearVal)) {
        yearInput.addClass("invalid");
        isValid = false;
        errors.push("If a year is entered it must be a number");
      } else if (yearVal.length !== 4) {
        yearInput.addClass("invalid");
        isValid = false;
        errors.push("If a year is entered it must be a 4 digit number");
      } else {
        yearInput.removeClass("invalid");
      }
    } else {
      yearInput.removeClass("invalid");
    }

    const priceInput = $("#purchasePrice");
    const price = priceInput.val().trim();
    const purchaseCurrency = $("#purchaseCurrency");
    if (price) {
      if (isNaN(price)) {
        priceInput.addClass("invalid");
        isValid = false;
        errors.push("If a purchase price is entered it must be a number");
      } else {
        priceInput.removeClass("invalid");
      }
      if (!purchaseCurrency.val()) {
        purchaseCurrency.addClass("invalid");
        isValid = false;
        errors.push("Please select a currency");
      } else {
        purchaseCurrency.removeClass("invalid");
      }
    } else {
      priceInput.removeClass("invalid");
      purchaseCurrency.removeClass("invalid");
    }

    //Make sure any notes contain text
    let notesValid = true;
    $(".standard-form-element.note").each(function() {
      const textArea = $("textarea", $(this));
      if (textArea.val().trim()) {
        textArea.removeClass("invalid");
      } else {
        textArea.addClass("invalid");
        isValid = false;
        notesValid = false;
      }
    });
    if (!notesValid) {
      errors.push("Please enter text for all notes");
    }

    if (!isValid) {
      const title = "There are errors!";
      let message = errors.join("<br>");
      showMessage(title, message);
    }
    return isValid;
  }

  function addNote(note) {
    //Create a clone of the note template
    const newNote = noteTemplate.clone();
    $("i", newNote).addClass("standard-tooltip").on("click.deleteNote", e => {
      Vehicles.processDeleteNote(e.target);
    });
    if (note) {
      newNote.attr('id', `${note.note_id}`);
      const textarea = $('textarea', newNote);
      textarea.val(note.note_text);
    }
    $("#vehicleNotesWrapper").append(newNote);
    initializeStandardTooltip();
  }

  function processDeleteNote(target) {
    const title = "Are you sure?";
    const message = "Do you really want to delete this note?";
    showVerificationMessage(title, message).then(result => {
      if (result) {
        $(target).closest(".standard-form-element.note").remove();
      }
    });
  }

  function processDeleteVehicle(vehicleID) {
    const title = 'Are you sure?';
    const message = 'Do you really want to delete this vehicle?';
    showVerificationMessage(title, message).then(result => {
      if (result) {
        deleteVehicle(vehicleID);
      }
    });
  }

  function deleteVehicle(vehicleID) {
    $.ajax({
      url: 'index.php',
      data: {
        module: 'vehicle',
        action: 'delete_vehicle',
        vehicle_id: vehicleID
      },
      beforeSend: function() {
        showWorking();
      }
    }).done(result => {
      result = JSON.parse(result);
      if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
        if (parseInt(result.data, 10) === parseInt(vehicleID, 10)) {
          vehicles = vehicles.filter(vehicle => parseInt(vehicle.vehicle_id, 10) !== parseInt(result.data, 10));
          table.row(`#${vehicleID}`).remove().draw();
          const message = "Vehicle was successfully deleted!";
          displayMessage([message]);
        }
      } else if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === false) {
        if (result.data.hasOwnProperty('messages') && result.data.messages.hasOwnProperty('errors') && result.data.messages.errors.length) {
          errors.length = 0;
          const title = 'There are errors!';
          const message = result.data.messages.errors.join('<br>');
          showMessage(title, message);
        }
      } else {
        console.error(`Error deleing vehicle: ${result}`);
        const title = 'Error!';
        const message = 'An error has occurred. The vehicle could not be deleted.';
        showMessage(title, message);
      }
    }).fail((xhr, text, error) => {
      console.error(`Error deleting vehicle: ${error}`);
      const title = 'Error!';
      const message = 'An error has occurred. The vehicle could not be deleted.';
      showMessage(title, message);
    }).always(() => {
      hideWorking();
    });
  }

  function toggleArchivedVehicles(target) {
    target = $(target);
    table.rows().remove();
    if (target.hasClass('active')) {
      target.removeClass('active').attr('title', 'Show archived vehicles');
      const tableData = vehicles.filter(vehicle => vehicle.archived === "0");
      table.rows.add(tableData);
    } else {
      target.addClass('active').attr('title', 'Hide archived vehicles');
      table.rows.add(vehicles);
    }
    table.draw();
    initializeStandardTooltip(target[0]);
  }

  function sendTestEmail() {
    $.ajax({
      url: 'index.php',
      data: {
        module: 'vehicle',
        action: 'send_test_email'
      }
    }).done(result => {
      result = JSON.parse(result);
      if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === true) {
        if (parseInt(result.data, 10) === parseInt(vehicleID, 10)) {
          table.row(`#${vehicleID}`).remove().draw();
          const message = "Vehicle was successfully deleted!";
          displayMessage([message]);
        }
      } else if (typeof result === 'object' && result.hasOwnProperty('success') && result.success === false) {
        if (result.data.hasOwnProperty('messages') && result.data.messages.hasOwnProperty('errors') && result.data.messages.errors.length) {
          errors.length = 0;
          const title = 'There are errors!';
          const message = result.data.messages.errors.join('<br>');
          showMessage(title, message);
        }
      } else {
        console.error(`Error deleing vehicle: ${result}`);
        const title = 'Error!';
        const message = 'An error has occurred. The vehicle could not be deleted.';
        showMessage(title, message);
      }
    });
  }
  /***********************  end Functions  ***********************/

  /***********************  Exports  *****************************/
  _this.init = init;
  _this.processEditVehicle = processEditVehicle;
  _this.processSaveVehicle = processSaveVehicle;
  _this.addNote = addNote;
  _this.processDeleteNote = processDeleteNote;
  _this.hideForm = hideForm;
  _this.processAddVehicle = processAddVehicle;
  _this.processDeleteVehicle = processDeleteVehicle;
  _this.toggleArchivedVehicles = toggleArchivedVehicles;
  _this.sendTestEmail = sendTestEmail;
  /***********************  end Exports  *************************/
  return _this;
})();