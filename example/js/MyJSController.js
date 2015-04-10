function MyJSController(node, message) {
  console.log(node);
  alert('in constructor with message'+message);
}

if (typeof module != 'undefined') {
  module.exports = MyJSController;
} else {
  window.MyJSController = MyJSController;
}
