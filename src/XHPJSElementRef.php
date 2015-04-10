<?hh

final class XHPJSElementRef {

  public function __construct(private HasXHPHelpers $element) {
  }

  public function getElementID(): string {
    // UNSAFE: HasXHPHelpers should define 'getID' and so on :)
    return $this->element->getID();
  }
}
