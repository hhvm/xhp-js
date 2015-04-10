require=(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){


},{}],"MyJSController":[function(require,module,exports){
function MyJSController(node, message) {
  console.log(node);
  alert('in constructor with message'+message);
}

module.exports = MyJSController;


},{}],"MyJSModule":[function(require,module,exports){
var MyJSModule = {
  myJSFunction: function(message, instance) {
    console.log(instance);
    alert('In HerpDerp:' + message);
  }
}

module.exports = MyJSModule;


},{}],"MyReactClass":[function(require,module,exports){
var React = window.React ? window.React : require('react');

var MyReactClass = React.createClass({displayName: "MyReactClass",
  render: function() {
    return (
      React.createElement("div", null, 
        "I am rendered with React. I have a property: ", this.props.someAttribute
      )
    );
  }
});

module.exports = MyReactClass;


},{"react":1}]},{},[]);
