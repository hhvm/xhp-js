<?hh

trait XHPJSCall {
  require extends :x:element;

  protected function jsCall(string $module, string $method, ...$args): void {
    $calls = $this->getContext(':x:js-scope/calls', null);
    invariant(
      $calls instanceof Vector,
      "Can not use jsCall unless :x:js-scope is an ancestor in the tree"
    );
    $calls[] = Vector { $module, $method, XHPJS::MapArguments($args) };
  }
}
