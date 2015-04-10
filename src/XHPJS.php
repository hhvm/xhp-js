<?hh

abstract final class XHPJS {
  public static function Element(HasXHPHelpers $element): XHPJSElementRef {
    return new XHPJSElementRef($element);
  }

  public static function Instance(HasXHPJSInstance $element): XHPJSInstanceRef {
    return new XHPJSInstanceRef($element);
  }

  public static function MapArgument(mixed $argument): array<mixed> {
    if (is_scalar($argument)) {
      return ['v', $argument];
    }
    if ($argument instanceof XHPJSElementRef) {
      return ['e', $argument->getElementID()];
    }
    if ($argument instanceof XHPJSInstanceRef) {
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
