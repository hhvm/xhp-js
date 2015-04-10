function XHPJS(instances, calls) {
  this.instances = [];
  this.elements = [];

  instances.forEach(this.constructInstance.bind(this));
  calls.forEach(this.call.bind(this));
}

XHPJS.prototype = {
  call: function(data) {
    var module = data[0];
    var method = data[1];
    var args = this.mapArguments(data[2]);

    module = require(module);
    method = module[method];
    method.apply(null, args);
  },

  constructInstance: function(data) {
    var elementId = data[0];
    var module = data[1];
    var args = this.mapArguments(data[2]);

    module = require(module);

    var XHPJSInstance = function(args) {
      return module.apply(this, args);
    }

    XHPJSInstance.prototype = module.prototype;

    var instance = new XHPJSInstance(args);
    console.log(this);
    this.instances[elementId] = instance;
  },

  mapArgument: function(arg) {
    var type = arg[0];
    var data = arg[1];
    if (type == 'v') {
      return data;
    }
    if (type == 'e') {
      return this.getElement(data);
    }
  },

  mapArguments: function(args) {
    return args.map(this.mapArgument, this);
  },

  getElement: function(id) {
    if (typeof this.elements[id] == 'undefined') {
      this.elements[id] = document.getElementById(id);
    }
    return this.elements[id];
  }
}
