<?php
	class Instagram_Comment extends EE_Object {
	
		public $id;
		public $date;
		public $text = '';
		public $user = NULL;
		
		function __construct($json){
			$this->id = $json->id;
			$this->date = $json->created_time;
			$this->text = $json->text;
			$this->user = new Instagram_User($json->from);
		}
	}