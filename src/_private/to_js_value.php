<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

namespace _Private;

use namespace /*HHAST_IGNORE_ERROR[UseStatementWithAs]*/ Facebook\XHP\Core as x;

function to_js_value(mixed $argument): (string, mixed) {
  // This check is a best effort.
  // It tries to ensure you are encoding sensible things.
  // Scalars and JsonSerializable are always sensible,
  // but Container<_> could contain a raw xhp object,
  // which should be wrapped in a XHPJS_Ref to make sense.
  // We could decide to recurse down, which would increase
  // runtime cost, but catch more mistakes.
  if (
    (
      \is_scalar($argument) ||
      $argument is Container<_> ||
      $argument is \JsonSerializable
    ) &&
    !$argument is x\node
  ) {
    return tuple('v', $argument);
  }
  if ($argument is \XHPJSElementRef) {
    return tuple('e', $argument->getElementID());
  }
  if ($argument is \XHPJSInstanceRef) {
    return tuple('i', $argument->getElementID());
  }

  if ($argument is x\node) {
    throw new \Exception(
      'Raw xhp classes can not be used directly.'.
      'Did you forget to call `toJSInstance` or `toJSElement` on '.
      \get_class($argument).
      '?',
    );
  }

  throw new \Exception(
    'Unsupported argument type '.\is_object($argument)
      ? \get_class($argument)
      : \gettype($argument),
  );
}
