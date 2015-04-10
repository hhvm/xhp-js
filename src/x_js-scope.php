<?hh

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
          var XHPJS = window.XHPJS ? window.XHPJS : require('XHPJS');
          new XHPJS(
            {json_encode($instances)},
            {json_encode($calls)}
          );
        </script>
      </x:frag>;
  }
}
