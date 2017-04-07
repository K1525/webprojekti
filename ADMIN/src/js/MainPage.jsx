import React from 'react';

export default class MainPage extends React.Component {
    constructor() {
        super();
    }
    render() {
        return (
            <div className="text-center" id="main-page">
                <p className="h1" id="title">Black Banana</p>
                <h2>Verkkokaupan hallinnointisivu</h2>
                <p>Valitse toiminto vasemman laidan valikosta.</p>
            </div>
        );
    }
}