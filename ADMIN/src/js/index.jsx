// CSS
import '../css/main.scss';
import Bootstrap from 'bootstrap/dist/css/bootstrap.css';

// React, JS, JSX
import React from 'react';
import ReactDOM from 'react-dom';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import $ from 'jquery';
import { SideNav, Nav } from 'react-sidenav';
import MainPage from './MainPage.jsx';
import AddProductPage from './AddProductPage.jsx';
import ListProductsPage from './ListProductsPage.jsx';
import AddUserPage from './AddUserPage.jsx';
import ListOrdersPage from './ListOrdersPage.jsx';
import ListUsersPage from './ListUsersPage.jsx';
import Snackbar from './Snackbar.jsx';
//import DialogBox from './Dialog.jsx';
import './script.jsx';
import injectTapEventPlugin from 'react-tap-event-plugin';
injectTapEventPlugin();

var navi = [
    { id: 'menu-products', text: 'Tuotehallinta',
        navlist: [
          { id: 'menu-add-products' ,text: 'Lisää Tuote' },
          { id: 'menu-list-products' ,text: 'Näytä Tuotteet' }
        ]
    },
    { id: 'menu-users', text: 'Käyttäjähallinta',
        navlist: [
          { id: 'menu-add-users' ,text: 'Lisää Käyttäjä' },
          { id: 'menu-list-users' ,text: 'Käyttäjät' }
        ]
    },
    { id: 'menu-orders', text: 'Tilaukset'},
    { id: 'menu-store', text: 'Takaisin Verkkokauppaan'},
    { id: 'menu-logout', text: 'Kirjaudu Ulos'},
];

const SideNavComponent = React.createClass({
    getInitialState() {
        return { selected: '' };
    },
    onSelection(selection) {
        this.setState({selected: selection.id});
        switch (selection.id){
            case 'menu-add-products': animateRender(<AddProductPage />); break;
            case 'menu-list-products': getProducts(); break;
            case 'menu-add-users': animateRender(<AddUserPage />); break;
            case 'menu-list-users': getUsers(); break;
            case 'menu-orders': getOrders(); break;
            case 'menu-store': window.location.href = "../"; break;
            case 'menu-logout': confirmLogout(); break;
        }
    },
    render() {
        return <div ><SideNav selected={this.state.selected} navs={navi} 
        onSelection={this.onSelection} /></div>
    }
});

var main = $("#main-management");
var container = $("#container");

function animateRender(reactElement){
    container.fadeOut(400,function(){
        container.fadeIn(400);
        ReactDOM.render(reactElement,container[0]);
    })
}

function confirmLogout(){
    $.ajax({
 		url: "./php/logout.php"
    });
}

function getProducts(){
	$.ajax({
 		url: "./php/get_products.php"
    }).done(function(data) {
        data = $.parseJSON(data);
        animateRender(<ListProductsPage products={data} />);
	});
}

function getOrders(){
	$.ajax({
 		url: "./php/get_orders.php"
    }).done(function(data) {
        console.log("Data: "+data);
        data = $.parseJSON(data);
        animateRender(<ListOrdersPage orders={data} />);
	});
}

function getUsers(){
	$.ajax({
 		url: "./php/get_users.php"
    }).done(function(data) {
        console.log("Data: "+data);
        data = $.parseJSON(data);
        animateRender(<ListUsersPage users={data} />);
	});
}

$(document).ready(function(){
    container.fadeIn(600);
    ReactDOM.render(<SideNavComponent />, $("#left-nav")[0]);
    ReactDOM.render(<MainPage />, container[0]);    
    ReactDOM.render(<Snackbar />, $("#footer")[0]);
});