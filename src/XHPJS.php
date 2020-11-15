<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

use namespace HH\Lib\Vec;
use type Facebook\XHP\HTML\HasXHPHTMLHelpers;

abstract final class XHPJS {
  public static function Element(HasXHPHTMLHelpers $element): XHPJSElementRef {
    return new XHPJSElementRef($element);
  }

  public static function Instance(HasXHPJSInstance $element): XHPJSInstanceRef {
    return new XHPJSInstanceRef($element);
  }

  public static function MapArgument(mixed $argument): (string, mixed) {
    if (is_scalar($argument) || $argument is Traversable<_>) {
      return tuple('v', $argument);
    }
    if ($argument is XHPJSElementRef) {
      return tuple('e', $argument->getElementID());
    }
    if ($argument is XHPJSInstanceRef) {
      return tuple('i', $argument->getElementID());
    }
    throw new Exception("Unsupported argument type");
  }

  public static function MapArguments(
    Traversable<mixed> $arguments,
  ): vec<(string, mixed)> {
    return Vec\map($arguments, $a ==> self::MapArgument($a));
  }
}
