<?hh

require_once('vendor/autoload.php');

class :test extends :x:element {
  use XHPHelpers;
  use XHPJSCall;
  use XHPJSInstance;

  attribute :xhp:html-element;

  protected function render(): XHPRoot {
    $this->jsCall('Herp', 'Derp', 'hello, world.');
    $this->constructJSInstance('MyInstance', XHPJS::Element($this), 'herp derp');
    return <div id={$this->getID()}>In :test::render()</div>;
  }
}

$xhp = 
  <html>
    <head>
      <script src="bundle.js"></script>
    </head>
    <body>
      <x:js-scope>
        <test />
      </x:js-scope>
    </body>
  </html>;
print $xhp;
