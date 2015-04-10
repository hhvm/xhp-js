<?hh

final class XHPJSInstanceRef {

  public function __construct(private HasXHPJSInstance $element) {
  }

  public function getElementID(): string {
    return $this->element->getID();
  }
}
