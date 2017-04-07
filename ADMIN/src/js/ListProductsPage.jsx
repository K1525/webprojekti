import React from 'react';
import ProductTable from './ProductTable.jsx';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import Button from './Button.jsx';
import DialogBox from './Dialog.jsx';

export default class ListProductsPage extends React.Component {
    constructor() {
        super();
    }

    render() {
        return (
            <MuiThemeProvider>
                <div id="list-products-page">
                    <h1 className="h1">Tuotteet</h1>
                    <div className="form-group">
                        <input type="text" className="form-control" id="search-product" placeholder="Haku"/>
                    </div>
                    <ProductTable products={this.props.products} />
                    <div className="row col-md-offset-1 col-md-10" id="remove-products-btn">
                        <Button label={"Poista valitut"} primary={true}          
                        secondary={false} />
                        
                    </div>
                </div>
            </MuiThemeProvider>
        );
    }
}