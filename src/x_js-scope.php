<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the MIT license found in the
 * LICENSE file in the root directory of this source tree.
 */

use namespace /*HHAST_IGNORE_ERROR[UseStatementWithAs]*/ Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\script;
use namespace HH\Lib\Vec;

xhp class x_js_scope extends x\element {
  <<__Override>>
  protected async function renderAsync(): Awaitable<x\node> {
    $calls = new ScriptDataList();
    $instances = new ScriptDataList();
    $this->setContext('x_js_scope/calls', $calls);
    $this->setContext('x_js_scope/instances', $instances);

    $children = await Vec\map_async($this->getChildren(), async $c ==> {
      invariant($c is x\node,
        '%s is not an x\node',
        is_object($c) ? get_class($c) : gettype($c),
      );
      $c->__transferContext($this->getAllContexts());
      return await $c->__flushSubtree();
    });

    $this->replaceChildren();

    return
      <x:frag>
        {$children}
        <script>
          var XHPJS = window.XHPJS ? window.XHPJS : require('xhpjs');
          new XHPJS(
            {json_encode($instances)},
            {json_encode($calls)}
          );
        </script>
      </x:frag>;
  }
}
