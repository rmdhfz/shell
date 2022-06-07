<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	public function backupdb()
	{
		$this->load->dbutil();
		$prefs = [
			'format' => 'zip',
			'filename' => 'db - '. date("d-M-Y:H-i-s") .'.sql',
			'add_drop' => TRUE,
			'add_insert' => TRUE,
			'new_line' => '\n'
		];
		$backup =& $this->dbutil->backup($prefs);
		$file_name = '(backup) Database - '. date("d-M-Y:H-i-s") .'.zip';
		$this->zip->download($file_name);
	}
	public function backupapp()
	{
		$this->load->library('zip');
		$this->zip->read_dir(FCPATH, TRUE);
		$cms = '(backup) Application - '. date("d-M-Y:H-i-s") .'.zip';
		$this->zip->download($cms);
	}
}