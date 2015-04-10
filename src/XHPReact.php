<?hh

trait XHPReact {
  use XHPJSCall;
  require implements HasXHPHelpers;

  protected function constructReactInstance(
    string $module,
    Map<string, mixed> $attributes,
  ) {
    $this->jsCall(
      'XHPJS',
      'renderReactElement',
      XHPJS::Element($this),
      $module,
      $attributes,
    );
  }
}
