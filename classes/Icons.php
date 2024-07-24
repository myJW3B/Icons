<?php
namespace JW3B\gui;

class Icons {

	protected $family = 'iconmonstr';
	protected $size   = 24;

	public $iconmonstr;
	public $bsicons;
	public $icons;

	/**
	 * @oaram string bootstrap or iconmonstr
	 * @param int  width and height of svg
	 *
	 * @return null
	 */
	public function __construct($family = "iconmonstr", &$size = 24) {
		$this->family = $family;
		$this->size = &$size;
	}

	/**
	 * change_family, to switch between the different icon families available
	 *			If you're changing the family being used, You will
	 * 			need to put it within a variable to pass to the function
	 * 			$fam = 'bootstrap';
	 * 			$icon->change_family($fam)->icon('tools');
	 * @param string $fam - bootstrap or iconmonstr
	 * @return self
	 */
	public function change_family($fam) {
		$this->family = $fam;
		return $this;
	}
	/**
	 * change_size, to change icon sizes
	 *			If you're changing the icon size, You will
	 * 			need to put it within a variable to pass to the function
	 * 			$size = 18;
	 * 			$icon->change_size($size)->icon('tools');
	 * @param string $fam - bootstrap or iconmonstr
	 * @return self
	 */
	public function change_size(&$s) {
		$this->size = &$s;
		return $this;
	}

	/**
	 * Set icon based on the key thats below in the array..
	 * @param string icon name
	 *
	 * @return string svg icon
	 */
	public function icon($name) {
		//if ($this->family == 'iconmonstr') {
		//	$get = $this->monstr_icons($name);
		//} else
		if ($this->family == 'bootstrap') {
			$get = $this->bootstrap_icons($name);
		} else {
			$get = $this->monstr_icons($name);
		}
		return $get;
	}

	public function get_all_icons() {
		if ($this->family == 'bootstrap') {
			$this->build_bs_icon_ary();
		} else if ($this->family == 'iconmonstr') {
			$this->build_monstr_icons();
		}
		return $this->icons;
	}

	private function bootstrap_icons($find) {
		$this->build_bs_icon_ary();
		$icons = $this->icons;
		if (isset($icons[$find])) {
			$ret = '<svg data-jw3b-icon="' . $find . '" xmlns="http://www.w3.org/2000/svg" width="' . $this->size . '" height="' . $this->size . '" fill="currentColor" class="bi ' . $icons[$find]['class'] . '" viewBox="0 0 16 16">' . $icons[$find]['path'] . '</svg>';
		} else {
			$ret = '';
		}
		return $ret;
	}

	private function monstr_icons($find) {
		$icons = $this->build_monstr_icons();
		if (isset($icons[$find])) {
			$add = isset($icons[$find]['add-rule']) ? $icons[$find]['add-rule'] : '';
			$ret = '<svg data-jw3b-icon="' . $find . '" xmlns="http://www.w3.org/2000/svg" width="' . $this->size . '" height="' . $this->size . '" fill="currentColor" viewBox="0 0 24 24"' . $add . '>' . $icons[$find]['path'] . '</svg>';
		} else {
			$ret = '';
		}
		return $ret;
	}

	public function build_monstr_icons() {
		if (!isset($this->iconmonstr)) {
			$this->iconmonstr = include __DIR__ . "/../lists/iconmonstr.php";
		}
		$this->icons = $this->iconmonstr;
		return $this->icons;
	}

	public function build_bs_icon_ary() {
		if (!isset($this->bsicons)) {
			$this->bsicons = include __DIR__ . "/../lists/bootstrap-icons.php";
		}
		$this->icons = $this->bsicons;
		return $this->icons;
	}

	public function view_all_icons() {
		$return = '<div class="container"><div class="row g-1"><div class="col-12"><h3>Iconmonstr Icons</h3></div>';
		$iconmonstr = $this->build_monstr_icons();
		ksort($iconmonstr);
		foreach ($iconmonstr as $key => $ary) {
			$class = isset($ary['class']) ? $ary['class'] : '';
			$svg = '<svg data-jw3b-icon="' . $key . '" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi ' . $class . '" viewBox="0 0 24 24">' . $ary['path'] . '</svg>';
			$return .= '<div class="col-2"><div class="p-2 bg-dark border text-center">' . $key . '<br>' . $svg . '</div></div>';
		}

		$return .= '<div class="col-12"><h3>Bootstrap Icons</h3></div>';
		$bs_ary = $this->build_bs_icon_ary();
		ksort($bs_ary);
		foreach ($bs_ary as $key => $ary) {
			$class = isset($ary['class']) ? $ary['class'] : '';
			$svg = '<svg data-jw3b-icon="' . $key . '" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi ' . $class . '" viewBox="0 0 16 16">' . $ary['path'] . '</svg>';
			$return .= '<div class="col-2"><div class="p-2 bg-dark border text-center">' . $key . '<br>' . $svg . '</div></div>';
		}
		$return .= '</div></div>';
		return $return;
	}
}
