<?php

namespace Blocks\PAMagazines;

use Blocks\Block;
use Extended\LocalData;
use WordPlate\Acf\Fields\Text;

/**
 * Class PAMagazines
 * @package Blocks\PAMagazines
 */
class PAMagazines extends Block {

    public function __construct() {
		// Set block settings
        parent::__construct([
            'title' 	  => __('IASD - Magazines', 'iasd'),
            'description' => __('Block to show magazines content in carousel format.', 'iasd'),
            'category' 	  => 'pa-adventista',
			'keywords' 	  => ['list', 'magazine'],
			'icon' 		  => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve"><g><path d="M23.893,99.814l67.774-1.427l-2.514-7.271C80.054,94.246,57.218,98.129,23.893,99.814z"/><path d="M33.489,96.572c19.712-1.942,46.58-5.633,58.178-10.892l-4.074-10.618C75.021,84.099,51.143,91.763,33.489,96.572z"/><path d="M70.229,0.186c0,0-4.149,10.028-20.229,19.364c-11,6.387-28.527,10.719-28.527,10.719L8.333,98.388   c0,0,30.31-8.893,53.25-24.55C83.367,58.969,86.48,51.016,86.48,51.016L70.229,0.186z M55.401,47.467   c-10.74,6.236-25.497,10.939-33.457,13.219l4.903-25.42c6.027-1.709,17.787-5.404,26.278-10.334   c6.602-3.833,11.409-7.8,14.863-11.315l6.264,19.59C69.807,37.662,63.706,42.645,55.401,47.467z"/><path d="M63.922,77.264c-7.517,5.132-20.503,11.541-28.229,15.159C51.901,87.755,79.517,77.548,88.9,68.651l-3.755-8.896   C81.336,63.919,74.857,69.801,63.922,77.264z"/></g></svg>',
        ]);
    }
	
	/**
	 * setFields Register ACF fields with WordPlate/Acf lib
	 *
	 * @return array Fields array
	 */
	protected function setFields(): array {
		return [
			Text::make(__('Title', 'iasd'), 'title')
				->defaultValue(__('IASD - Magazines', 'iasd')),
			LocalData::make(__('Itens', 'iasd'), 'items')
				->postTypes(['post'])
				->initialLimit(5)
				->hideFields(['content']),		
		];
	}
	    
    /**
     * with Inject fields values into template
     *
     * @return array
     */
    public function with(): array {
        return [
            'title' => get_field('title'),
            'items' => get_field('items')['data'],
        ];
    }
}
