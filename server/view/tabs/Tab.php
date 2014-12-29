<?php
interface Tab {
	public $id;
	public $title;
	// contains the whole content of the tab,
	// generated with information, stored in the database
	public $content;
}
?>