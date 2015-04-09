function XHPJS(instances, calls) {
  this.instances = [];

  instances.forEach(this.constructInstance.bind(this));
  calls.forEach(this.call.bind(this));
}

XHPJS.prototype = {
  call: function(data) {
    var module = data[0];
    var method = data[1];
    var args = data[2];

    module = require(module);
    method = module[method];
    method.apply(null, args);
  },

  constructInstance: function(data) {
    var elementId = data[0];
    var module = data[1];
    var args = data[2];

    var element = document.getElementById(elementId);
    module = require(module);

    var XHPJSInstance = function(args) {
      return module.apply(this, args);
    }

    XHPJSInstance.prototype = module.prototype;

    args.unshift(element);
    var instance = new XHPJSInstance(args);
    console.log(this);
    this.instances[elementId] = instance;
  }
}
