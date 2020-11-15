<?hh
/**
 * Copyright (c) 2015-present, Facebook, Inc.
 * All rights reserved.
 *
 * This source code is licensed under the BSD-style license found in the
 * LICENSE file in the root directory of this source tree. An additional grant
 * of patent rights can be found in the PATENTS file in the same directory.
 */

use namespace Facebook\XHP\Core as x;
use type Facebook\XHP\HTML\script;
use namespace HH\Lib\Vec;

xhp class x_js_scope extends x\element {
  protected async function renderAsync(): Awaitable<x\node> {
    $calls = new ScriptDataList();
    $instances = new ScriptDataList();
    $this->setContext('x_js_scope/calls', $calls);
    $this->setContext('x_js_scope/instances', $instances);

    $child_waithandles = vec[];
    foreach ($this->getChildren() as $child) {
      if ($child is x\node) {
        $child->__transferContext($this->getAllContexts());
        // Can't use Vec\map_async, since we want these Awaitables to start
        // when the entire tree is x\node only and all contexts have been transferred.
        $child_waithandles[] = (async () ==> await $child->__flushSubtree())();
      } else {
        invariant_violation(
          '%s is not an x\node',
          is_object($child) ? get_class($child) : gettype($child),
        );
      }
    }
    $children = await Vec\from_async($child_waithandles);
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
