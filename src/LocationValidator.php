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
	protected ?string $longitude;


	/**
	 * The area
	 *
	 * @var Polygon of longitude & latitude pairs
	 */
	protected Polygon $area;


	/**
	 * Create a new rule instance.
	 *
	 * @param $longitude
	 * @param array $area
	 */
	public function __construct($longitude, array $area)
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
	public function passes($attribute, $value): bool
	{
		return $this->area->pointInPolygon(new Coordinate([$value, $this->longitude]));
	}


	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message(): string
	{
		return ':attribute is outside of the allowed area.';
	}

}