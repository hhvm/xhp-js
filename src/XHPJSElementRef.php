<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

final class XHPJSElementRef {

  public function __construct(private HasXHPHelpers $element) {
  }

  public function getElementID(): string {
    // UNSAFE: HasXHPHelpers should define 'getID' and so on :)
    return $this->element->getID();
  }
}
