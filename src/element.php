<?hh

namespace XHP\JS;

class ElementRef {

  public function __construct(private \HasXHPHelpers $element) {
  }

  public function getElementID(): string {
    return $this->element->getID();
  }
}

function element(\HasXHPHelpers $element): ElementRef {
  return new ElementRef($element);
}
