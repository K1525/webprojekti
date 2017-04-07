import React from 'react';
import DividerForm from './DividerForm.jsx';
import getMuiTheme from 'material-ui/styles/getMuiTheme';
import MuiThemeProvider from 'material-ui/styles/MuiThemeProvider';
import PopoverMenu from './PopoverMenu.jsx';
import Button from './Button.jsx';
import FileDrop from './FileDrop.jsx';
import Paper from 'material-ui/Paper';

const paperStyle = {
  textAlign: 'center',
  display: 'inline-block',
};

export default class AddProductPage extends React.Component {
    constructor() {
        super();
    }
    render() {
        var hintTexts = ["Tuotteen nimi", "Hinta €"];
        var hintTexts2 = ["Kuvaus"];
        var hintTexts3 = ["Tuotetiedot"];
        var dropDownOptions = ["Unisex", "M", "N"];
        var dropDownOptions2 = ["Takit","T-Paidat","Housut","Kengät","Pitkähihaiset","Asusteet","Muut"];
        var buttonLabel = "Lisää tuote";
        return (
            <MuiThemeProvider>
                <div id="add-product-page">
                    <h1 className="h1">Lisää Tuote</h1>
                    <div className="row">
                        <div className="col-md-6 col-md-offset-1">
                            <DividerForm hintTexts={hintTexts} multiLine={false} pre={"p1_"} />
                            <DividerForm hintTexts={hintTexts2} multiLine={true} pre={"p2_"}  /><br/><br/>
                            <DividerForm hintTexts={hintTexts3} multiLine={true} pre={"p3_"}  />
                        </div>
                        <div className="col-md-4">
                            <div id="img-drop-area">
                                <Paper style={paperStyle} zDepth={2} >
                                    <FileDrop  /> 
                                </Paper><br/><br/>
                                <PopoverMenu options={dropDownOptions} label={"Sukupuoli"} />
                                <PopoverMenu options={dropDownOptions2} label={"Kategoria"}/>
                            </div>
                        </div>
                    </div><br/>
                    <div className="col-md-offset-1 col-md-10" id="add-product-btn">
                        <Button label={buttonLabel} secondary={false} primary={true} />
                    </div>
                </div>
            </MuiThemeProvider>
        );
    }
}