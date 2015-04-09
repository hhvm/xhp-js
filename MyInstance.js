function MyInstance(node, message) {
  console.log(node);
  alert('in constructor with message'+message);
}

module.exports = MyInstance;
