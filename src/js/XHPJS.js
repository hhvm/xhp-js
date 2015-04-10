function XHPJS(instances, calls) {
  this.instanceData = {};
  this.instances = {};
  this.elements = {};

  instances.forEach(function(instance) {
    var elementId = instance[0];
    this.instanceData[elementId] = instance;
  }, this);

  calls.forEach(this.call.bind(this));

  instances.forEach(function(instance) {
    var elementId = instance[0];
    this.getInstance(elementId);
  }, this);
}

XHPJS.prototype = {
  call: function(data) {
    var module = data[0];
    var method = data[1];
    var args = this.mapArguments(data[2]);

    module = window[module] ? window[module] : require(module);
    method = module[method];
    method.apply(null, args);
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
    if (type == 'i') {
      return this.getInstance(data);
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
  },

  getInstance: function(id) {
    if (typeof this.instances[id] == 'undefined') {
      this.constructInstance(id);
    }
    return this.instances[id];
  },

  constructInstance: function(elementId) {
    var data = this.instanceData[elementId];
    var moduleName = data[1];
    var args = this.mapArguments(data[2]);

    var module = window[moduleName] ? window[moduleName] : require(moduleName);

    var XHPJSInstance = function(args) {
      return module.apply(this, args);
    }

    XHPJSInstance.prototype = module.prototype;

    var instance = new XHPJSInstance(args);

    // Handy for debugging :)
    instance.__xhpJSModule = moduleName;
    instance.__xhpJSElement = this.getElement(elementId);

    this.instances[elementId] = instance;
  }
}

XHPJS.renderReactElement = function(domElement, module, attributes) {
  var React = window.React ? window.React : require('react');

  var component = require(module);
  var reactElement = React.createElement(component, attributes, null);
  React.render(reactElement, domElement);
}

module.exports = XHPJS;
