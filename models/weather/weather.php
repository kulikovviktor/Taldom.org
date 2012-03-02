<?php

class CWeather extends QBE {

	const source_link = 'http://informer.gismeteo.ru/xml/99442_1.xml';
	
	private $xml_obj = null;
	private $forecast_obj = null;

	public function __construct() {}
	
	public function get_xml() {
		$this->xml_obj = simplexml_load_file($this::source_link);
		return $this;
	}
	
	public function get_source_object() {
		return $this->xml_obj;
	}
	
	public function extract_forecast() {
		$this->forecast_obj = $this->xml_obj->REPORT->TOWN->FORECAST;
		return $this;
	}
	
	public function get_forecast() {
		return $this->forecast_obj;
	}
	
	public function save_to_db() {
		
	}

}