var Chance = require('chance');
var chance = new Chance();

var express = require('express');
var app = express();

app.get('/test', function(req, res){
	res.send('Hello API - test is working');
});

app.get('/', function(req, res){
	res.send(generateLocations());
});

app.listen(3000, function(){
	console.log('Accepting HTTP requests on port 3000.');
});

function generateLocations(){

    var numberOfLocations = chance.integer({
        min: 0,
        max: 20
    });

    console.log(numberOfLocations);

    var locations = [];
    for(var i = 0; i < numberOfLocations; i++){
		var address = chance.address();
		var country = chance.country();
		var postcode = chance.postcode();

        locations.push({
            address: address,
			country: country,
            postcode: postcode,
        });
    };
    console.log(locations);

    return locations;
}