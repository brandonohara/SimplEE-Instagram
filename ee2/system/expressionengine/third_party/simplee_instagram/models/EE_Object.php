<?php

	class EE_Object {
	
		function is_assoc($array){
			if(!is_array($array))
				return FALSE;
			return (bool)count(array_filter(array_keys($array), 'is_string'));
		}
		
		function get_array($object = NULL){
			$object = ($object ? $object : $this);
			$post = array();
			foreach(get_object_vars($object) as $key => $value){
				if(is_subclass_of($value, get_class())){
					$value = array($this->get_array($value));
				} else if(is_array($value) && isset($value[0]) && is_subclass_of($value[0], get_class())){
					$arr = array();
					foreach($value as $val){
						array_push($arr, $this->get_array($val));
					}
					$value = $arr;
				}
			
				$post[$key] = $value;
			}
			return $post;
		}
	}