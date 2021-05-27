# XHP-JS

XHP-JS is a combination of Hack and Javascript libraries allowing you to easily
call Javascript functions or create Javascript classes that from XHP
components, and to pass these classes or references to the DOM nodes to other
Javascript code.

For convenience, an interface to construct React components is also included.

A short overview is available at https://code.facebook.com/posts/858739974205250

## Examples

A full example is available at https://github.com/hhvm/xhp-js-example

### Calling a Javascript function

```Hack
xhp class JsCallExample extends HTML\element {
  use XHPHTMLHelpers;
  use XHPJSCall;

  <<__Override>>
  protected function renderAsync(): Awaitable<x\node> {
    $this->jsCall(
      'ModuleName',
      'functionName',
      'First argument',
      // This passes the DOM node corresponding to the <div /> below
      $this->toJSElementRef(),
      'Third argument',
    );

    return <div id={$this->getID()} />;
  }
}

$xhp = <html><head /><body>
  <x_js_scope><JsCallExample /><x_js_scope>
</body></html>;
echo await $xhp->toStringAsync();
```

### Creating a Javascript Object

```Hack
xhp class JSInstanceExample extends HTML\element {
  use XHPHTMLHelpers;
  use XHPJSCall;

  <<__Override>>
  protected function renderAsync(): Awaitable<x\node> {
    $this->constructJSInstance(
      'ClassName',
      $this->toJSElementRef(),
      // can pass through other arguments too
    );

    $this->jsCall(
      'MyModule',
      'myFunction',
      // This passes the JS object created above
      $this->toJSInstanceRef(),
    );

    return <div id={$this->getID()} />;
  }
}


$xhp = <html><head /><body>
  <x_js_scope><JSInstanceExample /><x_js_scope>
</body></html>;
```

### Creating a React component

*This functionality was based on an extremely old React version. The example has been removed.*

## Writing your JavaScript

We recommend writing your modules as CommonJS modules, and using Browserify.

Alternatively, you can create them as members of the window object.

XHP-JS looks for modules as members of the window object, and falls back to
attempting to call 'require("ModuleName")' - this requires a require() function
to be defined in the global scope.

For example:

```Hack
$this->jsCall('MyModule', 'myMethod', 'argument');
```

This Hack code can be thought of as creating the following Javascript:

```Javascript
var module = window.MyModule ? window.MyModule : require('MyModule');
module.myMethod('argument');
```

In turn, your JavaScript may look like:

```Javascript
var MyModule = {
  myMethod: function() {
    // ...
  }
};

module.exports = MyModule; // if using CommonJS + Browserify
window.MyModule = MyModule; // if not
```

## Installation

We recommend installing XHP-JS with Composer (for the Hack code) and npm +
Browserify for the Javascript code. Alternatively, you can include xhpjs.js or
xhpjs.min.js directly to declare an XHPJS object in the global scope.

See https://github.com/hhvm/xhp-js-example for a full example.

## License
XHP-JS is BSD-licensed. We also provide an additional patent grant.
