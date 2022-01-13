$(function() {
	console.log("Loading locations");

	function loadLocations() {
		$.getJSON( "/api/students/", function(locations) {
			console.log(locations);
			var message = "No location";
			if (locations.length > 0) {
				message = locations[0].address + " "+ locations[0].country;
			}
			$(".myClass").text(message);
		});
	};
	
	loadLocations();
	setInterval(loadLocations, 5000);
});
