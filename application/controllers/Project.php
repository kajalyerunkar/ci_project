<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Project extends CI_Controller{

	public function index(){

		$this->load->view('index');
	}

	public function get_brands(){

		$this->load->model('project_model');

		$ans = $this->project_model->getRecords("brand");

		if(is_array($ans)){
			$str="";

			foreach($ans as $val){

				// print_r($val);

				$str = $str ."<li><a href='#' class='br_data' for='".$val->br_id."'>".$val->br_name."</a></li>";
			}
			echo $str;
		}
	}

	public function get_categories(){

		$this->load->model('project_model');

		$ans = $this->project_model->getRecords("categories");

		if(is_array($ans)){
			echo json_encode($ans);
		}
	}

	public function get_products(){

		$this->load->model('project_model');

		$ans = $this->project_model->getAllProducts();

		if(is_array($ans)){
			$str="";

			foreach($ans as $val){

				// print_r($val);

				$str = $str ."<div class='col-sm-4'><div class='product-image-wrapper'><div class='single-products'><div class='productinfo text-center'><img src='".base_url().$val->p_imgpath."' alt='' /><h2>".$val->p_amt."</h2><p>".$val->p_name."</p><a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a></div><div class='product-overlay'><div class='overlay-content'><h2>$56</h2><p>Easy Polo Black Edition</p><a href='#' class='btn btn-default add-to-cart' for='".$val->p_id."'><i class='fa fa-shopping-cart'></i>Add to cart</a></div></div></div><div class='choose'><ul class='nav nav-pills nav-justified'><li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li><li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li></ul></div></div></div>";
			}
			echo $str;
		}
	}

	public function get_products_brandwise(){
		// echo "123";

		$data = $this->input->post('brid');

		//echo $data;

		$this->load->model('project_model');
		$ans= $this->project_model->getAllProducts("and p_brid='$data'");

		if(is_array($ans)){
			$str="";

			foreach($ans as $val){

				// print_r($val);

				$str = $str ."<div class='col-sm-4'><div class='product-image-wrapper'><div class='single-products'><div class='productinfo text-center'><img src='".base_url().$val->p_imgpath."' alt='' /><h2>".$val->p_amt."</h2><p>".$val->p_name."</p><a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a></div><div class='product-overlay'><div class='overlay-content'><h2>$56</h2><p>Easy Polo Black Edition</p><a href='#' class='btn btn-default add-to-cart' for='".$val->p_id."'><i class='fa fa-shopping-cart'></i>Add to cart</a></div></div></div><div class='choose'><ul class='nav nav-pills nav-justified'><li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li><li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li></ul></div></div></div>";
			}
			echo $str;
		}
	}

	function cart(){

		//echo "TEST";

		//print_r($_POST);
		$data= $this ->input->post('proid');
		//echo($data);

		$result = get_cookie("cartproduct");

		//print_r($result);
		//exit;

		if($result == ""){

			set_cookie("cartproduct",$data,time()+3600, "","/");
			$msg= "product Added";
			$cnt= 1;
		}

		else{

			$arr = explode(",", $result);
			// print_r($arr);
			//exit;

			$pos = in_array($data, $arr);

			// print_r($pos);
			// var_dump($pos);
			// exit;

			if($pos){

				$msg= "product exist in cart";
				$cnt = count(explode(",",$result));
			}
			else{

				$newdata = $result.",".$data;
				set_cookie("cartproduct",$newdata,time()+3600,"","/");

				$msg ="product updated";
				$cnt = count(explode(",", $newdata));

			}
		}

		echo $cnt."#".$msg;
	}

	public function get_cart_products(){

		if(get_cookie("cartproduct") && get_cookie("cartproduct")!=""){

			$data = get_cookie("cartproduct");


		$this->load->model('project_model');

		$ans = $this->project_model->getAllProductsCart($data);

		if(is_array($ans)){
			$str="";

			foreach($ans as $val){

				// print_r($val);

				$str = $str ."<div class='col-sm-4'><div class='product-image-wrapper'><div class='single-products'><div class='productinfo text-center'><img src='".base_url().$val->p_imgpath."' alt='' /><h2>".$val->p_amt."</h2><p>".$val->p_name."</p><a href='#' class='btn btn-default delete-to-cart'><i class='fa fa-shopping-cart'></i>Delete</a></div><div class='product-overlay'><div class='overlay-content'><h2>$56</h2><p>Easy Polo Black Edition</p><a href='#' class='btn btn-default delete-to-cart' for='".$val->p_id."'><i class='fa fa-shopping-cart'></i>Delete</a></div></div></div><div class='choose'><ul class='nav nav-pills nav-justified'><li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li><li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li></ul></div></div></div>";
			}
			echo $str;
		}
	}
	else{
			echo "no product in cart";
	}
}
		
		function deletecart()
		{
			//print_r($_POST);
			$id =$_POST['proid'];
			//echo $id;
			$cookiedata = get_cookie("cartproduct");
			//echo $cookiedata;
			$result = explode(",", $cookiedata);
			//print_r($result);
			$pos = array_search($id, $result);
			//echo $pos;
			unset($result[$pos]);

			$newpro = implode(",", $result);
			//echo $newpro;
			set_cookie("cartproduct",$newpro,time()+3600,"","/");
			$msg ="product updated";
			$cnt = count($result);
			echo $cnt."#".$msg;
		}
}

?>