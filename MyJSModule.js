var MyJSModule = {
  myJSFunction: function(message, instance) {
    console.log(instance);
    alert('In HerpDerp:' + message);
  }
}

module.exports = MyJSModule;
