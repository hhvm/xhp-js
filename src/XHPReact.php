<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

use type Facebook\XHP\HTML\HasXHPHTMLHelpers;

/**
 * @deprecated This does not work with modern versions of React.
 * @see https://github.com/hhvm/xhp-js/issues/8
 */
trait XHPReact {
  use XHPJSCall;
  require implements HasXHPHTMLHelpers;

  <<__Deprecated('This does not work with modern versions of React.')>>
  protected function constructReactInstance(
    string $module,
    dict<string, mixed> $attributes,
  ): void {
    $this->jsCall(
      'XHPJS',
      'renderReactElement',
      $this->toJSElementRef(),
      $module,
      $attributes,
    );
  }
}
