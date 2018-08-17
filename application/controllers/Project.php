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

				$str = $str ."<div class='col-sm-4'><div class='product-image-wrapper'><div class='single-products'><div class='productinfo text-center'><img src='".base_url().$val->p_imgpath."' alt='' /><h2>".$val->p_amt."</h2><p>".$val->p_name."</p><a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a></div><div class='product-overlay'><div class='overlay-content'><h2>$56</h2><p>Easy Polo Black Edition</p><a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a></div></div></div><div class='choose'><ul class='nav nav-pills nav-justified'><li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li><li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li></ul></div></div></div>";
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

				$str = $str ."<div class='col-sm-4'><div class='product-image-wrapper'><div class='single-products'><div class='productinfo text-center'><img src='".base_url().$val->p_imgpath."' alt='' /><h2>".$val->p_amt."</h2><p>".$val->p_name."</p><a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a></div><div class='product-overlay'><div class='overlay-content'><h2>$56</h2><p>Easy Polo Black Edition</p><a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a></div></div></div><div class='choose'><ul class='nav nav-pills nav-justified'><li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li><li><a href='#'><i class='fa fa-plus-square'></i>Add to compare</a></li></ul></div></div></div>";
			}
			echo $str;
		}
	}
}

?>