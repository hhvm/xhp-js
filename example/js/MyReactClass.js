/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

var React = window.React ? window.React : require('react');

var MyReactClass = React.createClass({
  render: function() {
    return (
      <div>
        I am rendered with React. I have a property: {this.props.someAttribute}
      </div>
    );
  }
});

if (typeof module != 'undefined') {
  module.exports = MyReactClass;
} else {
  window.MyReactClass = MyReactClass;
}
