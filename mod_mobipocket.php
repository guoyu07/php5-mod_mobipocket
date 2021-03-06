<?php
/**
 * mod_mobipocket.php
 * 
 * (c)2013 mrdragonraaar.com
 */
include_once('mobipocket/mobipocket.php');

$mod_mobipocket = new ModMOBIPocket();

/* Metadata */
if ($mod_mobipocket->is_display_metadata())
{
	$mod_mobipocket->display_metadata();
	return;
}

/* Text */
if ($mod_mobipocket->is_display_text())
{
	$mod_mobipocket->display_text();
	return;
}

$mod_mobipocket->send_file();


/**
 * Mod MOBIPocket.
 */
class ModMOBIPocket
{
	const TEMPLATE_METADATA = 'templates/template_metadata.php';
	const TEMPLATE_TEXT = 'templates/template_text.php';
	const TEMPLATE_HEADER = 'templates/template_header.php';
	const TEMPLATE_FOOTER = 'templates/template_footer.php';

	public $filename = '';
	public $header = '';
	public $footer = '';
	public $mobipocket = null;

	/**
         * Create new ModMOBIPocket instance.
         */
	function __construct()
	{
		$this->_init();
	}

	/**
         * Initialise ModMOBIPocket instance.
         */
	private function _init()
	{
		$this->filename = getenv('PATH_TRANSLATED');
		$this->header = apache_getenv('MOBIPocketHeader', true);
		$this->footer = apache_getenv('MOBIPocketFooter', true);
		$this->_init_mobipocket();
	}

	/**
         * Load mobipocket.
         */
	private function _init_mobipocket()
	{
		$mobipocket = new mobipocket();
		if ($mobipocket->load($this->filename))
			$this->mobipocket = $mobipocket;
	}

	/**
         * Check if metadata should be displayed.
         * @return non-zero if metadata should be displayed.
         */
	public static function is_display_metadata()
	{
		return isset($_GET['D']) && ($_GET['D'] == 'M');
	}

	/**
         * Check if text should be displayed.
         * @return non-zero if text should be displayed.
         */
	public static function is_display_text()
	{
		return isset($_GET['D']) && ($_GET['D'] == 'T');
	}

	/**
         * Display metadata.
         */
	public function display_metadata()
	{
		$this->display_template(self::TEMPLATE_METADATA);
	}

	/**
         * Display text.
         */
	public function display_text()
	{
		$this->display_template(self::TEMPLATE_TEXT);
	}

	/**
         * Display template.
         * @param $template template file.
         */
	private function display_template($template)
	{
		if (isset($this->mobipocket))
		{
			$this->display_header();
			include($template);
			$this->display_footer();
		}
	}

	/**
         * Display header.
         */
	private function display_header()
	{
		if ($this->header && is_file($this->header))
			include_once($this->header);
		else
			include_once(self::TEMPLATE_HEADER);
	}

	/**
         * Display footer.
         */
	private function display_footer()
	{
		if ($this->footer && is_file($this->footer))
			include_once($this->footer);
		else
			include_once(self::TEMPLATE_FOOTER);
	}

	/**
         * Send file.
         */
	public function send_file()
	{
		header("Content-Type: application/x-mobipocket-ebook");
		header("Content-Disposition: attachment; filename=\"" . basename($this->filename) . "\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($this->filename));
		readfile($this->filename);
	}
}

?>
