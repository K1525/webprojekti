import React from 'react';
import OrderTable from './OrderTable.jsx';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import Button from './Button.jsx';

export default class ListOrdersPage extends React.Component {
    constructor() {
        super();
    }
    render() {
        return (
            <MuiThemeProvider>
                <div id="list-products-page">
                    <h1 className="h1">Tilaukset</h1>
                    <div className="form-group">
                        <input type="text" className="form-control" id="search-orders" placeholder="Haku"/>
                    </div>
                    <OrderTable orders={this.props.orders} />
                    <Button label={"Näytä tiedot"} primary={true} secondary={false} />
                </div>
            </MuiThemeProvider>
        );
    }
}