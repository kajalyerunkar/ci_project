<?php 

	if(!function_exists('url')){

		function url(){

			return base_url();
		}
	}

	if(!function_exists('css')){

		function css(){

			return base_url().'assets/css/';
		}
	}

	if(!function_exists('ctrl')){

		function ctrl(){

			return base_url().'index.php/project/';
		}
	}

	if(!function_exists('js')){

		function js(){

			return base_url().'assets/js/';
		}
	}
	if(!function_exists('pre')){

		function pre($data){

			echo "<pre>";print_r($data);echo "</pre>";
		}
	}
?>