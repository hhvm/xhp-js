<?hh

require_once('vendor/autoload.php');
require_once('src/map_arguments.php');
require_once('src/element.php');

class :x:js-scope extends :x:element implements XHPAwaitable {
  use XHPAsync;

  protected async function asyncRender(): Awaitable<XHPRoot> {
    $calls = Vector { };
    $instances = Vector { };
    $this->setContext(':x:js-scope/calls', $calls);
    $this->setContext(':x:js-scope/instances', $instances);
    await $this->__flushElementChildren();

    return
      <x:frag>
        {$this->getChildren()}
        <script>
          {file_get_contents(__DIR__.'/jsimpl.js')}
          new XHPJS(
            {json_encode($instances)},
            {json_encode($calls)}
          );
        </script>
      </x:frag>;
  }
}


trait XHPJSCall {
  require extends :x:element;

  protected function jsCall(string $module, string $method, ...$args): void {
    $calls = $this->getContext(':x:js-scope/calls', null);
    invariant(
      $calls instanceof Vector,
      "Can not use jsCall unless :x:js-scope is an ancestor in the tree"
    );
    $calls[] = Vector { $module, $method, XHP\JS\map_arguments($args) };
  }

}

interface HasXHPJSInstance {
  require extends :x:element;

  public function getID(): string;
}

trait XHPJSInstance implements HasXHPJSInstance {
  require implements HasXHPHelpers;

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

class :test extends :x:element {
  use XHPHelpers;
  use XHPJSCall;
  use XHPJSInstance;

  attribute :xhp:html-element;

  protected function render(): XHPRoot {
    $this->jsCall('Herp', 'Derp', 'hello, world.');
    $this->constructJSInstance('MyInstance', XHP\JS\element($this), 'herp derp');
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
