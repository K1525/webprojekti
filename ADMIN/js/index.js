// Import CSS
import '../css/main.scss';
import Bootstrap from 'bootstrap/dist/css/bootstrap.css';

// Import React and JS
import React from 'react';
import ReactDOM from 'react-dom'
import NavBar from './navbar.js';

/*export default class HelloText extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return <p>asd, {this.props.name}!</p>
    }
}

export default class HelloBox extends React.Component {
    constructor() {
        super();
    }

    render() {
        return <div>
            <HelloText name="Teste" />
        </div>
    }
}
*/

// Render!
ReactDOM.render(<NavBar />, document.getElementById('top-bar')[0]);
