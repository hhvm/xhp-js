<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

use namespace Facebook\XHP\Core as x;

trait XHPJSCall {
  require extends x\element;

  protected function jsCall(string $module, string $method, ...$args): void {
    $calls = $this->getContext(':x:js-scope/calls', null);
    invariant(
      $calls is Vector<_>,
      "Can not use jsCall unless :x:js-scope is an ancestor in the tree"
    );
    $calls[] = Vector { $module, $method, XHPJS::MapArguments($args) };
  }
}
