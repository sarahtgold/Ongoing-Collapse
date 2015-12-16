// REQUIRES
var express = require('express');
var path = require('path');
var app = express();
var http = require('http').Server(app);
var request = require('request');
var async = require('async');

// CONFIG
app.set('port', process.env.PORT || 3000);
app.set('view engine', 'jade');
app.use('/public', express.static(path.join(__dirname, 'public')));

// SECRETS
// Variables
var secretsFile = "./secrets.json"
var secrets;

// Load secrets
try {
	secrets = require(secretsFile);
} catch (err) {
	secrets = {}
	console.log("Unable to load secrets configuration");
	process.exit(1);
}

function pullData() {
	async.parallel({
		national_grid: function(callback) {
			request(kimonoUrl("auy8mwu4"), function (error, response, body) {
			  if (!error && response.statusCode == 200) {
			    var json = JSON.parse(body);
					json = json.results.collection1[0];

					var newJson = {
						demand: json.dmnd.replace('Demand ', '').replace('GW', ''),
						coal: json.cl.replace('Coal ','').replace('\n','').split('(')[1].replace('%)',''),
						nuclear: json.nclr.replace('Nuclear ','').replace('\n','').split('(')[1].replace('%)',''),
						wind: json.wnd.replace('Wind ','').replace('\n','').split('(')[1].replace('%)',''),
						hydro: json.hydr.replace('Hydro ','').replace('\n','').split('(')[1].replace('%)',''),
						biomass: json.bmss.replace('Biomass ','').replace('\n','').split('(')[1].replace('%)',''),
						oil: json.il.replace('Oil ','').replace('\n','').split('(')[1].replace('%)','')
					}

					json = newJson;

					callback(null, json);
			  }
			});
		},
		ppm: function(callback) {
			request(kimonoUrl("71gjzj6w"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results;

					var newJson = {
						now: json.collection1[0].ppmnow,
						one_year_ago: json.collection2[1].ppm1year.replace(' ppm', ''),
						ten_years_ago: json.collection3[0].ppm10y.replace(' ppm', '')
					}

					json = newJson;

					callback(null, json);
				}
			});
		},
		aqi_beijing: function(callback) {
			request(kimonoUrl("3npngwqc"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0].aqichina;

					callback(null, json);
				}
			});
		},
		oil: function(callback) {
			request(kimonoUrl("48eyxfno"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0].oilperbarrel;

					callback(null, json);
				}
			});
		},
		bitcoin: function(callback) {
			request(kimonoUrl("2ljj2quq"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0].bitcoindollar.text.replace('1 BTC = $', '');

					callback(null, json);
				}
			});
		},
		internet: function(callback) {
			request(kimonoUrl("c3uhp26k"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0];

					var newJson = {
						total_users: json.InternetUsers,
						facebook_users: json.FbookUsers,
						twitter_users: json.TwitterUsers,
						traffic: json.InternetTraffic,
						energy_consumption: json.MWh,
						carbon_dioxide_emissions: json.CO2
					}

					json = newJson;

					callback(null, json);
				}
			});
		},
		drones: function(callback) {
			request(kimonoUrl("amqcwpjy"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0];

					var newJson = {
						pakistan: {
							strikes: {
								lower: null,
								upper: null
							},
							casualties: {
								lower: null,
								upper: null
							}
						},
						yemen: {
							strikes: {
								lower: null,
								upper: null
							},
							casualties: {
								lower: null,
								upper: null
							}
						},
						somalia: {
							strikes: {
								lower: null,
								upper: null
							},
							casualties: {
								lower: null,
								upper: null
							}
						}
					}

					// Pakistan
					// Strikes
					newJson.pakistan.strikes.lower = json.Pakttl.split('-')[0];
					if (json.Pakttl.split('-')[1]) {
						newJson.pakistan.strikes.upper = json.Pakttl.split('-')[1];
					} else {
						newJson.pakistan.strikes.upper = json.Pakttl.split('-')[0];
					}

					// Casualties
					newJson.pakistan.casualties.lower = json.Pakkills.split('-')[0];
					if (json.Pakkills.split('-')[1]) {
						newJson.pakistan.casualties.upper = json.Pakkills.split('-')[1];
					} else {
						newJson.pakistan.casualties.upper = json.Pakkills.split('-')[0];
					}

					// Yemen
					// Strikes
					newJson.yemen.strikes.lower = json.Yemttl.split('-')[0];
					if (json.Yemttl.split('-')[1]) {
						newJson.yemen.strikes.upper = json.Yemttl.split('-')[1];
					} else {
						newJson.yemen.strikes.upper = json.Yemttl.split('-')[0];
					}

					// Casualties
					newJson.yemen.casualties.lower = json.Yemkills.split('-')[0];
					if (json.Yemkills.split('-')[1]) {
					  newJson.yemen.casualties.upper = json.Yemkills.split('-')[1];
					} else {
						newJson.yemen.casualties.upper = json.Yemkills.split('-')[0];
					}

					// Somalia
					// Strikes
					newJson.somalia.strikes.lower = json.Somttl.split('-')[0];
					if (json.Somttl.split('-')[1]) {
					  newJson.somalia.strikes.upper = json.Somttl.split('-')[1];
					} else {
					  newJson.somalia.strikes.upper = json.Somttl.split('-')[0];
					}

					// Casualties
					newJson.somalia.casualties.lower = json.Somkills.split('-')[0];
					if (json.Somkills.split('-')[1]) {
					  newJson.somalia.casualties.upper = json.Somkills.split('-')[1];
					} else {
						newJson.somalia.casualties.upper = json.Somkills.split('-')[0];
					}

					json = newJson;

					callback(null, json);
				}
			});
		},
		manmade_space_objects: function(callback) {
			request(kimonoUrl("a92kr19w"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);

					var newJson = {
						active: json.results.collection1[4].objects,
						total: json.results.collection1[10].objects
					}

					json = newJson;

					callback(null, json);
				}
			});
		},
		voyager: function(callback) {
			request(kimonoUrl("b3lqybvi"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);

					json = json.results.collection1[0].voyager1.replace(' KM', '');

					callback(null, json);
				}
			});
		},
		solar_wind: function(callback) {
			request(kimonoUrl("37bnktpm"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);

					json = json.results.collection1[0].windspeed;

					callback(null, json);
				}
			});
		},
		exoplanets: function(callback) {
			request(kimonoUrl("c9xzygd8"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);

					var newJson = {
						total_exoplanets: json.results.collection1[0].Plnts.split('/')[0].trim().replace('Showing ', '').replace(' planets', ''),
						total_exoplanetary_systems: json.results.collection1[0].Plnts.split('/')[1].trim().replace(' planetary systems', '')
					};

					json = newJson;

					callback(null, json);
				}
			});
		},
		lymington_sealevel: function(callback) {
			request(kimonoUrl("9y10cr7a"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0].lymington
					callback(null, json);
				}
			});
		},
		gan_sealevel: function(callback) {
			request(kimonoUrl("aj8v0o58"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0].gan
					callback(null, json);
				}
			});
		},
		earthquakes: function(callback) {
			request(kimonoUrl("51kbueok"), function(error, response, body) {
				if (!error & response.statusCode == 200) {
					var json = JSON.parse(body);
					json = json.results.collection1[0]

					var newJson = {
						location: json.location,
						magnitude: json.magnitude,
						depth: json.depth
					}

					json = newJson;

					callback(null, json);
				}
			});
		}
	},
	function(err, results) {
		console.log("DONE!")

		// Merge sea level data into one object
		// and remove the seperate objects
		results.sea_levels = {
			lymington: results.lymington_sealevel,
			gan: results.gan_sealevel
		}

		delete results.lymington_sealevel;
		delete results.gan_sealevel;

		console.log(results);
	});
}

pullData();

function kimonoUrl(id) {
	return "https://www.kimonolabs.com/api/" + id + "?apikey=" + secrets.kimono_api_key
}

// ROUTES
// Render the app view
app.get('/', function(req, res) {
	res.render('index');
});

// SERVER
http.listen(app.get('port'), function() {
	console.log("Server started on :" + app.get('port'));
});
