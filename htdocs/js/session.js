Session = (function() {
  const _this = {};
  /*******************  Variables  ********************/
  const elements = {
    currencyData: {
      url: 'index.php',
      data: {
        module: 'utility',
        action: 'list_currency_data'
      }
    }
  };
  /*******************  end Variables  ****************/

  /*******************  Functions  ********************/
  function getItem(key) {
    return new Promise((resolve, reject) => {
      if (sessionStorage.getItem(key)) {
        resolve(JSON.parse(sessionStorage.getItem(key)));
      }
      $.ajax({
        url: elements[key].url,
        data: elements[key].data
      }).done(result => {
        if (typeof result === 'string') {
          sessionStorage.setItem(key, result);
          resolve(JSON.parse(sessionStorage.getItem(key))); 
        } else {
          reject(`Session.get(${key}) failed: ${result}`);
        }
      }).fail((xhr, statusText, error) => {
        reject(`Session.get(${key}) ajax failed: status text: ${statusText}\nerror: ${error}`);
      });
    });
  }
  
  
  /*******************  end Functions  ****************/

  /*******************  Exports  **********************/
  _this.getItem = getItem;
  /*******************  end Exports  ******************/
  return _this;
})();


