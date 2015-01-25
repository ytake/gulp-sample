/**
 *
 * @type {*|React.ReactComponentFactory<P>}
 */
var Content = React.createClass({
    getInitialState: function () {
        return {
            value: 'gulp.Sample from React.js'
        };
    },
    render: function () {
        return (
            <h2>{this.state.value}</h2>
        );
    }
});
React.renderComponent(
    <Content />,
    document.getElementById('reactContent')
);
