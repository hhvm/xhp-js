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
use namespace HH\Lib\Vec;
use type Facebook\XHP\HTML\HasXHPHTMLHelpers;

trait XHPJSCall {
  require extends x\element;

  protected function jsCall(string $module, string $method, mixed ...$args): void {
    $calls = $this->getContext('x_js_scope/calls', null);
    invariant(
      $calls is ScriptDataList,
      "Can not use jsCall unless x_js_scope is an ancestor in the tree"
    );
    $calls->append(tuple($module, $method, Vec\map($args, $arg ==> _Private\to_js_value($arg))));
  }

  protected function toJSElementRef(
  ): XHPJSElementRef where this as HasXHPHTMLHelpers {
    return new XHPJSElementRef($this as HasXHPHTMLHelpers);
  }
}
