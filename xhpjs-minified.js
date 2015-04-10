require=(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){



},{}],"XHPJS":[function(require,module,exports){
function XHPJS(t,n){this.instanceData={},this.instances={},this.elements={},t.forEach(function(t){var n=t[0];this.instanceData[n]=t},this),n.forEach(this.call.bind(this)),t.forEach(function(t){var n=t[0];this.getInstance(n)},this)}XHPJS.prototype={call:function(t){var n=t[0],e=t[1],s=this.mapArguments(t[2]);n=require(n),e=n[e],e.apply(null,s)},mapArgument:function(t){var n=t[0],e=t[1];return"v"==n?e:"e"==n?this.getElement(e):"i"==n?this.getInstance(e):void 0},mapArguments:function(t){return t.map(this.mapArgument,this)},getElement:function(t){return"undefined"==typeof this.elements[t]&&(this.elements[t]=document.getElementById(t)),this.elements[t]},getInstance:function(t){return"undefined"==typeof this.instances[t]&&this.constructInstance(t),this.instances[t]},constructInstance:function(t){var n=this.instanceData[t],e=n[1],s=this.mapArguments(n[2]),i=require(e),a=function(t){return i.apply(this,t)};a.prototype=i.prototype;var r=new a(s);r.__xhpJSModule=e,r.__xhpJSElement=this.getElement(t),this.instances[t]=r}},module.exports=XHPJS;


},{}],"XHPReact":[function(require,module,exports){
var React=window.React?window.React:require("react"),XHPReact={renderElement:function(e,r,t){var a=require(r),c=React.createElement(a,t,null);React.render(c,e)}};module.exports=XHPReact;


},{"react":1}]},{},[]);
