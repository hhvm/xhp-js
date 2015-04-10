var MyJSModule = {
  myJSFunction: function(message, instance) {
    console.log(instance);
    alert('In HerpDerp:' + message);
  }
}

if (typeof module != 'undefined') {
  module.exports = MyJSModule;
} else {
  window.MyJSModule = MyJSModule;
}
