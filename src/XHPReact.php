<?hh

trait XHPReact {
  use XHPJSCall;
  require implements HasXHPHelpers;

  protected function constructReactInstance(
    string $module,
    Map<string, mixed> $attributes,
  ) {
    $this->jsCall(
      'XHPReact',
      'renderElement',
      XHPJS::Element($this),
      $module,
      $attributes,
    );
  }
}
