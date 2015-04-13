# XHP-JS

XHP-JS is a combination of Hack and Javascript libraries allowing you to easily
call Javascript functions or create Javascript classes that from XHP
components, and to pass these classes or references to the DOM nodes to other
Javascript code.

For convenience, an interface to construct React components is also included.

## Examples

### Calling a Javascript function

```Hack
class :example:jscall extends :x:element {
  use XHPHelpers;
  use XHPJSCall;

  attribute :xhp:html-element;

  protected function render(): XHPRoot {
    $this->jsCall(
      'ModuleName',
      'functionName',
      'First argument',
      // This pases the DOM node corresponding to the <div /> below
      XHPJS::Element($this),
      'Third arugment',
    );

    return <div id={$this->getID()} />;
  }
}

print
  <html><head /><body>
    <x:js-scope><example:js-call /><x:js-scope>
  </body></html>;
```

### Creating a Javascript Object

```Hack
class :example:jsinstance extends :x:element {
  use XHPHelpers;
  use XHPJSCall;

  attribute :xhp:html-element;

  protected function render(): XHPRoot {
    $this->constructJSInstance(
      'ClassName',
      XHPJS::Element($this),
      // can pass through other arguments too
    );

    $this->jsCall(
      'MyModule',
      'myFunction',
      // This passes the JS object created above
      XHPJS::Instance($this),
    );

    return <div id={$this->getID()} />;
  }
}

print
  <html><head /><body>
    <x:js-scope><example:js-instance /><x:js-scope>
  </body></html>;
```

### Creating a React component

```Hack
class :example:typeahead extends :x:element implements XHPAwaitable {
  use XHPHelpers;
  use XHPReact;
  use XHPAsync;

  attribute :xhp:html-element;

  protected async function asyncRender(): Awaitable<XHPRoot> {
    $friend_names = await FriendsList::fetch($this->getContext('Viewer'));

    $this->constructReactInstance(
      'ReactTypeahead',
      Map { 'friends' => $friend_names },
    );
  }
}

print
  <html><head /><body>
    <x:js-scope><example:typeahead /><x:js-scope>
  </body></html>;
```

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
  myFunction: function() {
    // ...
  }
};

module.exports = MyModule; // if using CommonJS + Browserify
window.MyModule = MyModule; // if not
```

## Installation

We recommend installing XHP-JS with Composer (for the Hack code) and npm +
Browserify for the Javascript code. Alternatively, you can include XHPJS.js or
XHPJS.min.js directly to declare an XHPJS object in the global scope.

## License
XHP-JS is BSD-licensed. We also provide an additional patent grant.
