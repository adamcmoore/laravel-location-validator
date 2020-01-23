## Laravel Location Validator
A Laravel validation rule to check that a lng/lat pair are within an area.


## Installation

```bash
composer require adamcmoore/laravel-location-validator
```

## Usage

```php
use AcMoore\LocationValidator\LocationValidator;

// Validate that latitude & longitude is inside an area
$allowed_area = [
	[48.9675969, 1.7440796],
	[48.4711003, 2.5268555],
	[48.9279131, 3.1448364],
	[49.3895245, 2.6119995],
];
$request->validate(
	[
		'latitude'  => 'latitude',
		'longitude' => 'longitude',
	], 
	[
		'latitude' => new LocationValidator(
			$request->get('longitude'), // Longitude needs to be supplied as an argument when using a Rule Object 
			$allowed_area
		)
	]
);


### Todo
- [ ] Add support for latitude & lognitude in same field, like spatial fields or comma seperated.
- [ ] Allow multiple areas.
- [ ] Add validation rule to `Validator::extend` in a service provider.