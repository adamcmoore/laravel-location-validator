<?php
namespace AcMoore\LocationValidator\Tests;

use Validator;
use AcMoore\LocationValidator\LocationValidator;


class ValidatorTest extends TestCase
{

	protected function makeValidator($latitude, $longitude, $area)
	{
		return Validator::make(
			['latitude' => $latitude], 
			['latitude' => new LocationValidator($longitude, $area)]
		);
	}


    public function testLocationValidator()
    {
    	$area = [
			[48.9675969, 1.7440796],
			[48.4711003, 2.5268555],
			[48.9279131, 3.1448364],
			[49.3895245, 2.6119995],
		];

		$validator = $this->makeValidator(49.1785607, 2.4444580, $area);
		$this->assertTrue($validator->passes());

		$validator = $this->makeValidator(49.1785607, 5, $area);
		$this->assertTrue($validator->fails());
    }
}