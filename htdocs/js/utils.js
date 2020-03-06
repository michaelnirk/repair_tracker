function showMessage(title, message) {
  return new Promise(resolve => {
    $("<div></div>").html(message).dialog({
      closeOnEscape: false,
      modal: true,
      draggable: false,
      dialogClass: "no-close",
      maxHeight: $(".content").outerHeight(),
      title: title,
      buttons: [
        {
          text: "Ok",
          click: function() {
            resolve(true);
            $(this).remove();
          }
        }
      ]
    });
  });
}

function showVerificationMessage(title, message) {
  return new Promise(function(resolve) {
    $("<div></div>").html(message).dialog({
      closeOnEscape: false,
      modal: true,
      resizeable: false,
      draggable: false,
      title: title,
      dialogClass: "no-close",
      maxHeight: $(".content").outerHeight(),
      buttons: [
        {
          text: "Ja",
          click: function() {
            $(this).dialog("close");
            resolve(true);
          }
        },
        {
          text: "Nein",
          click: function() {
            $(this).dialog("close");
            resolve(false);
          }
        }
      ],
      close: function() {
        $(this).remove();
      }
    });
  });
}

function displayMessage(messages) {
  const text = messages.join('<br>');
  $('.content').animate({scrollTop: 0}, function() {
    $('#jsMessagesWrapper').html(`${text}`).slideDown(400, () => {
      setTimeout(() => {
        $('#jsMessagesWrapper').slideUp(400, function() {
          $(this).html('');
        });
      }, 4000);
    });
  });
}

function initializeStandardTooltip(target) {
  let elements = target
    ? $(target)
    : $(".standard-tooltip:not(.tooltipstered)");
  elements.tooltipster({
    theme: "tooltipster-light"
  });
}

function evaluateBackButton() {
  if (window.history.length > 1) {
    $(".back-button").removeClass("disabled");
  }
}

function logOut() {
  sessionStorage.clear();
  window.location.href = "index.php?module=login&action=logout";
}

function autoresize(textarea) {
  textarea.style.height = "0px"; //Reset height, so that it not only grows but also shrinks
  textarea.style.height = textarea.scrollHeight + 10 + "px"; //Set new height
}

function showWorking() {
  $('#working').removeClass('hidden');
}

function hideWorking() {
  $('#working').addClass('hidden');
}

function setPageTitle(text) {
  $('#pageTitle').html(text);
}

