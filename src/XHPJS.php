<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

abstract final class XHPJS {
  public static function Element(HasXHPHelpers $element): XHPJSElementRef {
    return new XHPJSElementRef($element);
  }

  public static function Instance(HasXHPJSInstance $element): XHPJSInstanceRef {
    return new XHPJSInstanceRef($element);
  }

  public static function MapArgument(mixed $argument): array<mixed> {
    if (is_scalar($argument) || $argument is Traversable<_>) {
      return ['v', $argument];
    }
    if ($argument is XHPJSElementRef) {
      return ['e', $argument->getElementID()];
    }
    if ($argument is XHPJSInstanceRef) {
      return ['i', $argument->getElementID()];
    }
    throw new Exception("Unsupported argument type");
  }

  public static function MapArguments(
    array<mixed> $arguments,
  ): array<array<mixed>> {
    return array_map(class_meth(self::class, 'MapArgument'), $arguments);
  }
}
