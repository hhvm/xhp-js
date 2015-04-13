<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

trait XHPReact {
  use XHPJSCall;
  require implements HasXHPHelpers;

  protected function constructReactInstance(
    string $module,
    Map<string, mixed> $attributes,
  ) {
    $this->jsCall(
      'XHPJS',
      'renderReactElement',
      XHPJS::Element($this),
      $module,
      $attributes,
    );
  }
}
