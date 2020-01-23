<?php
namespace AcMoore\LocationValidator;

use Illuminate\Contracts\Validation\Rule;
use League\Geotools\Polygon\Polygon;
use League\Geotools\Coordinate\Coordinate;


class LocationValidator implements Rule
{

	/**
	 * The Longitude data to be validated along with the latitude
	 *
	 * @var string
	 */
	protected $longitude;


	/**
	 * The area
	 *
	 * @var array and array of longitude & latitude pairs
	 */
	protected $area;


	/**
	 * Create a new rule instance.
	 *
	 * @param  string  $table
	 * @param  string  $column
	 * @return void
	 */
	public function __construct($longitude, $area)
	{
		$this->longitude = $longitude;

		$this->area = new Polygon($area);
		$this->area->setPrecision(5);
	}


	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string $attribute
	 * @param  mixed  $value
	 *
	 * @return bool
	 */
	public function passes($attribute, $latitude)
	{
		return $this->area->pointInPolygon(new Coordinate([$latitude, $this->longitude]));
	}


	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return ':attribute is ouside of the allowed area.';
	}

}