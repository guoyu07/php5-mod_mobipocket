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

	public $filename;
	public $header;
	public $footer;

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
		if ($fh = fopen($this->filename, "r"))
		{
			$mobipocket = new mobipocket();
			if ($mobipocket->read($fh))
			{
				$this->display_header($mobipocket);
				include($template);
				$this->display_footer($mobipocket);
			}

			fclose($fh);
		}
	}

	/**
         * Display header.
         * @param $mobipocket MOBIPocket.
         */
	private function display_header($mobipocket)
	{
		if ($this->header && is_file($this->header))
			include_once($this->header);
		else
			include_once(self::TEMPLATE_HEADER);
	}

	/**
         * Display footer.
         * @param $mobipocket MOBIPocket.
         */
	private function display_footer($mobipocket)
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
