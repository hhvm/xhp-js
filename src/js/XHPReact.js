var React = window.React ? window.React : require('react');

var XHPReact = {
  renderElement: function(domElement, module, attributes) {
    var component = require(module);
    var reactElement = React.createElement(component, attributes, null);
    React.render(reactElement, domElement);
  }
}

module.exports = XHPReact;
