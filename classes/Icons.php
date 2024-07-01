<?php
namespace JW3B\gui;

class Icons {

	public $family;
	public $size;
	public $icons;

	/**
	 * @oaram string bootstrap or iconmonstr
	 * @param int  width and height of svg
	 *
	 * @return null
	 */
	public function __construct($family="bootstrap", $size=24){
		$this->family = $family;
		$this->size = $size;
	}

	/**
	 * change_family, to switch between the different icon families available
	 *
	 * @param string $fam - bootstrap or iconmonstr
	 * @return self
	 */
	public function change_family($fam){
		$this->family = $fam;
		return $this;
	}

	/**
	 * Set icon based on the key thats below in the array..
	 * @param string icon name
	 *
	 * @return string svg icon
	 */
	public function icon($name){
		if($this->family == 'bootstrap'){
			$get = $this->bootstrap_icons($name);
		} else if($this->family == 'iconmonstr'){
			$get = $this->monstr_icons($name);
		}
		return $get;
	}

	public function change_size($s){
		$this->size = $s;
		return $this;
	}

	public function get_all_icons(){
		if($this->family == 'bootstrap'){
			$this->build_bs_icon_ary();
		} else if($this->family == 'iconmonstr'){
			$this->build_monstr_icons();
		}
		return $this->icons;
	}

	private function bootstrap_icons($find){
		$this->build_bs_icon_ary();
		$icons = $this->icons;
		if(isset($icons[$find])){
			$ret = '<svg data-jw3b-icon="'.$find.'" xmlns="http://www.w3.org/2000/svg" width="'.$this->size.'" height="'.$this->size.'" fill="currentColor" class="bi '.$icons[$find]['class'].'" viewBox="0 0 16 16">'.$icons[$find]['path'].'</svg>';
		} else {
			$ret = '';
		}
		return $ret;
	}

	private function monstr_icons($find){
		$icons = $this->build_monstr_icons();
		if(isset($icons[$find])){
			$add = isset($icons[$find]['add-rule']) ? $icons[$find]['add-rule'] : '';
			$ret = '<svg data-jw3b-icon="'.$find.'" xmlns="http://www.w3.org/2000/svg" width="'.$this->size.'" height="'.$this->size.'" fill="currentColor" viewBox="0 0 24 24"'.$add.'>'.$icons[$find]['path'].'</svg>';
		} else {
			$ret = '';
		}
		return $ret;
	}

	public function build_monstr_icons(){
		$this->icons = include __DIR__."/../lists/iconmonstr.php";
		return $this->icons;
	}

	public function build_bs_icon_ary(){
		$this->icons = 	include __DIR__."/../lists/bootstrap-icons.php";
		return $this->icons;
	}
}
