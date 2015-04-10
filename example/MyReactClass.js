var React = window.React ? window.React : require('react');

var MyReactClass = React.createClass({
  render: function() {
    return (
      <div>
        I am rendered with React. I have a property: {this.props.someAttribute}
      </div>
    );
  }
});

module.exports = MyReactClass;
