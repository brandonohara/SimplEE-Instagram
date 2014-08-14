<?php
	class Instagram_Post extends EE_Object {
	
		public $id;
		public $type;
		public $link;
		public $date;
		
		public $user;
		public $caption;
		public $tags = array();
		
		public $location;
		public $latitude;
		public $longitude;
		
		public $filter;
		public $url;
		public $thumbnail;
		
		public $likes = 0;
		public $comment_count = 0;
		public $comments = array();
		
		function __construct($json){
			$this->id = $json->id;
			$this->type = $json->type;
			$this->link = $json->link;
			$this->date = $json->created_time;
			
			$this->user = new Instagram_User($json->user);
			$this->caption = (isset($json->caption) ? $json->caption->text : "");
			foreach($json->tags as $tag){
				array_push($this->tags, array('tag' => $tag));
			}
			
			if($json->location){
				$this->location = (isset($json->location->name) ? $json->location->name : NULL);
				$this->latitude = (isset($json->location->latitude) ? $json->location->latitude : NULL);;
				$this->longitude = (isset($json->location->longitude) ? $json->location->longitude : NULL);;
			}
			
			if($this->type == "image"){
				$this->url = $json->images->standard_resolution->url;
			} else if($this->type == "video"){
				$this->url = $json->videos->standard_resolution->url;
			}

			$this->thumbnail = $json->images->thumbnail->url;
			$this->low_resolution = $json->images->low_resolution->url;

			$this->filter =  $json->filter;
			
			$this->likes = $json->likes->count;
			$this->comment_count = $json->comments->count;
			foreach($json->comments->data as $comment){
				array_push($this->comments, new Instagram_Comment($comment));
			}
			$this->comments = array_reverse($this->comments);
		}
		
	}