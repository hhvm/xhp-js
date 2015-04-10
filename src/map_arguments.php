<?hh

namespace XHP\JS;

function map_argument(mixed $argument): array<mixed> {
  if (is_scalar($argument)) {
    return ['v', $argument];
  }
  if ($argument instanceof ElementRef) {
    return ['e', $argument->getElementID()];
  }
  throw new Exception("Unsupported argument type");
}
function map_arguments(array $arguments): array<mixed> {
  return array_map(fun('XHP\JS\map_argument'), $arguments);
}
