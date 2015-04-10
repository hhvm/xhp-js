<?hh

class XHPJSElementRef {

  public function __construct(private \HasXHPHelpers $element) {
  }

  public function getElementID(): string {
    return $this->element->getID();
  }
}
