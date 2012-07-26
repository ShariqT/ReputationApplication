// JavaScript Document
var hotelArray = new Array(
					   'Fairfield Inn and Suites by Marriott Albany',
							'Courtyard by Marriott Albany',
							'Courtyard by Marriott Alexandria',
							'Fairfield Inn Birmingham Inverness',
							'Courtyard Birmingham Trussville',
							'SpringHill Suites Boise ParkCenter',
							'Residence Inn Boston Marlborough',
							'Residence Inn Boston Westford',
							'Residence Inn Beaumont',
							'Courtyard Brownsville',
							'SpringHill Suites Baton Rouge North/Airport',
							'Courtyard Santa Clarita Valencia',
							'TownePlace Suites Columbia Southeast/Fort Jackson',
							'Courtyard Charlottesville - University Medical Center',
							'Fairfield Inn and Suites Charlotte Matthews',
							'Fairfield Inn and Suites Columbus',
							'Residence Inn Columbus',
							'SpringHill Suites Columbus',
							'TownePlace Suites Columbus',
							'TownePlace Suites Dallas Las Colinas',
							'SpringHill Suites Dallas Downtown/West End',
							'Residence Inn Denver Highlands Ranch',
							'Residence Inn Fort Worth Cultural District',
							'SpringHill Suites Arlington Near Six Flags',
							'TownePlace Suites Arlington Near Six Flags',
							'TownePlace Suites Fort Worth Downtown',
							'Fairfield Inn Dothan',
							'Courtyard Dothan',
							'Residence Inn Dothan',
							'Courtyard West Orange',
							'Residence Inn Fayetteville Cross Creek',
							'SpringHill Suites Greensboro',
							'Courtyard Hattiesburg',
							'Residence Inn Hattiesburg',
							'Residence Inn Houston West/Energy Corridor',
							'Fairfield Inn Huntsville',
							'Residence Inn Huntsville',
							'TownePlace Suites Huntsville',
							'Courtyard Wichita East',
							'Courtyard Carolina Beach',
							'Fairfield Inn and Suites Wilmington/Wrightsville Beach',
							'Fairfield Inn Jacksonville Orange Park',
							'Residence Inn Kansas City Overland Park',
							'SpringHill Suites Pasadena Arcadia',
							'Residence Inn Santa Clarita Valencia',
							'Fairfield Inn Santa Clarita Valencia',
							'SpringHill Suites Lafayette South at River Ranch',
							'Courtyard Cypress Anaheim/Orange County',
							'Residence Inn Laredo Del Mar',
							'Fairfield Inn and Suites Kansas City Overland Park',
							'Residence Inn Kansas City County Club Plaza',
							'SpringHill Suites Kansas City Overland Park',
							'Courtyard Orlando Lake Mary/North',
							'SpringHill Suites Orlando North/Sanford',
							'Courtyard Montgomery Prattville',
							'SpringHill Suites Montgomery',
							'Courtyard Troy',
							'Courtyard Miami at Dolphin Mall',
							'Courtyard Jackson',
							'Residence Inn Manassas Battlefield Park',
							'TownePlace Suites Jacksonville',
							'Residence Inn San Bernardino',
							'Courtyard Suffolk Chesapeake',
							'Norfolk Marriott Chesapeake',
							'Courtyard Virginia Beach Oceanfront/South',
							'Courtyard Virginia Beach Oceanfront/North 37th Street',
							'TownePlace Suites Suffolk Chesapeake',
							'Residence Inn Portland West/Hillsboro',
							'Courtyard Portland Hillsboro',
							'Residence Inn Portland Downtown/RiverPlace',
							'TownePlace Suites Portland Hillsboro',
							'SpringHill Suites Vancouver Columbia Tech Center',
							'Courtyard Panama City',
							'TownePlace Suites Panama City',
							'Courtyard Pensacola',
							'Fairfield Inn Pensacola',
							'Fairfield Inn and Suites Rogers',
							'Residence Inn Rogers',
							'Courtyard San Diego Rancho Bernardo',
							'Residence Inn San Diego Downtown',
							'TownePlace Suites San Antonio Northwest',
							'TownePlace Suites San Antonio Airport',
							'SpringHill Suites Savannah Midtown',
							'TownePlace Suites Seattle Southcenter',
							'Residence Inn Seattle Downtown/Lake Union',
							'Courtyard Seattle Kirkland',
							'TownePlace Suites Seattle North/Mukilteo',
							'Courtyard Harrisonburg',
							'Residence Inn Provo',
							'Courtyard Santa Ana John Wayne Airport/Orange County',
							'Courtyard Somerset',
							'Residence Inn Springdale',
							'Courtyard Tuscaloosa',
							'Fairfield Inn Tuscaloosa',
							'Fairfield Inn Tallahassee North/I-10',
							'SpringHill Suites St. Petersburg Clearwater',
							'Residence Inn Lakeland',
							'Courtyard Lakeland',
							'Courtyard Bristol',
							'Courtyard Johnson City',
							'Residence Inn Tucson Airport',
							'Courtyard Texarkana',
							'TownePlace Suites Texarkana',
							'Courtyard Valdosta'
					   );




var links = [];
var casper = require('casper').create();

//for(var i = 0; i < length(hotelArray); i++){
	         casper.start('http://www.expedia.com/Hotels', function(){
						this.fill('#hot-wiz-form', {
								  'hotelSearchWizard_inpSearchNear': 'Albany, GA',
								  'hotelSearchWizard_inpHotelName': 'Fairfield Inn and Suites by Marriott Albany'
								  }, true );
				});
			 
			 casper.then(function(){
					    this.click('div.main-description a');
						return this.echo(this.fetchText('h2'));
			    });
			 
			 
			 casper.then(function(){
							var url  = this.getCurrentUrl() + '#reviews';
							this.click('#xp_hotelInfo_navTab_2 a');
							return this.echo(url);
				});
			 
			 
			 casper.then(function(){
					 this.evaluate(function(){
							var text = document.querySelector('div.BVRRContentReview').text();
					   });
						
					return this.echo(text);
				});
			 
			 casper.run(function(){
					this.exit();			 
				});