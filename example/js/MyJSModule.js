/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

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
