<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

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
