<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

use namespace /*HHAST_IGNORE_ERROR[UseStatementWithAs]*/ Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\HasXHPHTMLHelpers;
use namespace HH\Lib\Vec;

interface HasXHPJSInstance {
  require extends x\element;

  public function getID(): string;
}

trait XHPJSInstance implements HasXHPJSInstance {
  require implements HasXHPHTMLHelpers;

  protected function constructJSInstance(string $module, mixed ...$args): void {
    $instances = $this->getContext('x_js_scope/instances', null);
    invariant(
      $instances is ScriptDataList,
      'Can not use constructJSInstance unless x_js_scope is an ancestor in tree',
    );
    $instances->append(tuple(
      $this->getID(),
      $module,
      Vec\map(
        $args,
        $arg ==>
          /* HHAST_FIXME[NamespacePrivate] Fix when picking a namespace for this project */
          _Private\to_js_value($arg),
      ),
    ));
  }

  protected function toJSInstanceRef(): XHPJSInstanceRef {
    return new XHPJSInstanceRef($this);
  }
}
