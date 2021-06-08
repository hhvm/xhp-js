<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

final class XHPJSInstanceRef {

  public function __construct(private HasXHPJSInstance $element) {
  }

  public function getElementID(): string {
    return $this->element->getID();
  }
}
