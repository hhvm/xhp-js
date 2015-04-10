<?hh

require_once('vendor/autoload.php');

class :test extends :x:element {
  use XHPHelpers;
  use XHPJSCall;
  use XHPJSInstance;

  attribute :xhp:html-element;

  protected function render(): XHPRoot {
    /* Roughly equivalent to:
     *
     * var MyJSModule = require('MyJSModule');
     * MyJSModule.myJSFunction(
     *  'hello, world',
     *  <result of constructJSInstance() call below>
     * );
     *
     * The JS code realizes it needs to construct the JS class first, despite
     * the call below.
     */
    $this->jsCall(
      'MyJSModule',
      'myJSFunction',
      'hello, world.',
      XHPJS::Instance($this)
    );

    /*
     * var MyJSController = require('MyJSController');
     * new MyJSController(
     *   document.getElementById(< $this->getID() >);
     *   'herp derp'
     * );
     */
    $this->constructJSInstance(
      'MyJSController',
      XHPJS::Element($this),
      'herp derp',
    );

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
