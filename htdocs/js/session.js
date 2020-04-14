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
    },
    user: {
      url: 'index.php',
      data: {
        module: 'utility',
        action: 'get_user_data'
      }
    }
  };
  /*******************  end Variables  ****************/

  /*******************  Functions  ********************/

  async function getItem(key) {
    if (sessionStorage.getItem(key)) {
      return JSON.parse(sessionStorage.getItem(key));
    }

    try {
      const result = await $.ajax({
        url: elements[key].url,
        data: elements[key].data
      });
      
       if (typeof result === 'string') {
        sessionStorage.setItem(key, result);
        return JSON.parse(sessionStorage.getItem(key));
      } else {
        console.error(`Session.get(${key}) failed: ${result}`);
      }
    } catch (e) {
      console.error(e);
    }
  }


  /*******************  end Functions  ****************/

  /*******************  Exports  **********************/
  _this.getItem = getItem;
  /*******************  end Exports  ******************/
  return _this;
})();


