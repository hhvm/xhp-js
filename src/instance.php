<?hh

namespace XHP\JS;

interface HasJSInstance {
  require extends :x:element;

  public function getID(): string;
}

trait JSInstance implements HasJSInstance {
  require implements \HasXHPHelpers;

  protected function constructJSInstance(string $module, ...$args): void {
    $instances = $this->getContext(':x:js-scope/instances', null);
    invariant(
      $instances instanceof Vector,
      "Can not use constructJSInstance unless :x:js-scope is an ancestor in ".
      "tree"
    );
    $instances[] = Vector { $this->getID(), $module, XHP\JS\map_arguments($args) };
  }
}
