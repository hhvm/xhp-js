<?hh

require_once('vendor/autoload.php');

class :x:js-scope extends :x:element implements XHPAwaitable {
  use XHPAsync;

  protected async function asyncRender(): Awaitable<XHPRoot> {
    $calls = Vector { };
    $this->setContext(':x:js-scope/calls', $calls);
    await $this->__flushElementChildren();

    return
      <x:frag>
        {$this->getChildren()}
        <script>
          var xhpJSCalls = {json_encode($calls)};
          xhpJSCalls.forEach(function(call) {'{'}
            var module = call[0];
            var method = call[1];
            var args = call[2];

            module = require(module);
            method = module[method];
            method.apply(null, args);
          {'}'});
        </script>
      </x:frag>;
  }
}

trait XHPJS {
  require extends :x:element;

  protected function jsCall(string $module, string $method, ...$args) {
    $calls = $this->getContext(':x:js-scope/calls', null);
    invariant(
      $calls instanceof Vector,
      "Can not use jsCall unless :x:js-scope is an ancestor in the tree"
    );
    $calls[] = Vector { $module, $method, $args };
  }
}

class :test extends :x:element {
  use XHPJS;

  protected function render(): XHPRoot {
    $this->jsCall('Herp', 'Derp', 'hello, world.');
    return <div>In :test::render()</div>;
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
