<?php 

class Twitter {

	private $username = "bezdoom";
	private $password = "53b0b511";
	private $last_error = null;

	public function addMessage($message)
	{
		if ($message) {
			$context = stream_context_create(array(
			    'http' => array(
				'method'  => 'POST',
				'header'  => sprintf("Authorization: Basic %s\r\n", base64_encode($this->username.':'.$this->password)).
				                   "Content-type: application/x-www-form-urlencoded\r\n",
				'content' => http_build_query(array('status' => $message)),
				'timeout' => 5,
			),
			));

			$result_xml = file_get_contents('http://twitter.com/statuses/update.xml', false, $context);
			if (!$result_xml) {
				$this->last_error = "Пустой ответ";
				return false;
			} else {
				try {
					$xml = new SimpleXMLElement($result_xml);
					if($xml->id) {
						return $xml->id;
					} else {
						return false;
					}
				} catch (Exception $e) {
					$this->last_error = '$xml is not a valid xml string: '.$result_xml;
				}
			}
		}
	}

	public function getLastError () {
		return $this->last_error;
	}

}