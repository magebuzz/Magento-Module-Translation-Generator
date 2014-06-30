<?php

class TranslationGenerator {

	protected $extension_path;

	protected $need_to_translate = array();

	function __construct($extension_path) {
		$this->extension_path = $extension_path;
		$this->_getFromPHPfiles();
		$this->_getFromPHTMLfiles();
		$this->_getFromXMLfiles();
		$this->_validate();
	}

	public function getTranslationString() {
		$string = '';
		foreach ($this->need_to_translate as $item) {
			$string .= $item.','.$item."\n";
		}
		return $string;
	}

	public function getTranslationHTMLcode() {
		$string = '<p>';
		foreach ($this->need_to_translate as $item) {
			$string .= $item.','.$item."</br>";
		}
		$string .= '</p>';
		return $string;
	}

	public function getTranslationCsv() {

	}

	protected function _getFromPHPfiles() {
		$directory = new RecursiveDirectoryIterator($this->extension_path);
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
		$php_files = iterator_to_array($regex);

		foreach ($php_files as $key => $value) {
			# code...
			$file_path = $key;
			$file_content = file_get_contents($file_path);
			$tokens = token_get_all($file_content);
			foreach ($tokens as $key => $token) {
				if (($token[0] == 307)&&($token[1]=='__')) {
					$this->need_to_translate[] = ($tokens[$key + 2][1]);
				}
			}
		}
	}

	protected function _getFromPHTMLfiles() {
		$directory = new RecursiveDirectoryIterator(dirname(__FILE__));
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($iterator, '/^.+\.phtml$/i', RecursiveRegexIterator::GET_MATCH);
		$phtml_files = iterator_to_array($regex);


		foreach ($phtml_files as $key => $value) {
			# code...
			$file_path = $key;
			$file_content = file_get_contents($file_path);
			$tokens = token_get_all($file_content);
			foreach ($tokens as $key => $token) {
				if (($token[0] == 307)&&($token[1]=='__')) {
					$this->need_to_translate[] = ($tokens[$key + 2][1]);
				}
			}
		}
	}


	protected function _getFromXMLfiles() {
		$directory = new RecursiveDirectoryIterator(dirname(__FILE__));
		$iterator = new RecursiveIteratorIterator($directory);
		$regex = new RegexIterator($iterator, '/^.+\.xml$/i', RecursiveRegexIterator::GET_MATCH);
		$xml_files = iterator_to_array($regex);

		foreach ($xml_files as $key => $value) {
			# code...
			$file_path = $key;
			$file_content = file_get_contents($file_path);
			$xml = simplexml_load_string($file_content);
		  $list = $xml->xpath("//*[@translate]");
		  foreach ($list as $key => $item) {
		  	$translate_element = (string) $item->attributes()->translate;
		  	$this->need_to_translate[] = (string) $item->{$translate_element};
		  }
		}
	}

	protected function _validate() {
		$this->need_to_translate = array_unique($this->need_to_translate);
		asort($this->need_to_translate);
	}
}




