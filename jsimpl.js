function XHPJS(instances, calls) {
  this.instances = [];

  instances.forEach(this.constructInstance);
  calls.forEach(this.call);
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
    var elementID = data[0];
    var module = data[1];
    var args = data[2];

    var element = document.getElementByID(elementID);
    module = require(module);

    var constructor = function(args) {
      return module.apply(this, args);
    }

    constructor.prototype = module.prototype;

    args.unshift(element);
    var instance = new constructor(args);
    this.instances[elementID] = instance;
  }
}
