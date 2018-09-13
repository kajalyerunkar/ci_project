<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Project extends CI_Controller{

	public function __construct(){

		parent::__construct();
		$this->load->model('project_model');
		header('Access-Control-Allow-Origin: *');
	}

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

		function registerAction(){
			//print_r($_POST);

			$this->form_validation->set_rules('login_name','User name','trim|required|min_length[3]|alpha_numeric_spaces');

			$this->form_validation->set_rules('login_mobile','User mobile','trim|required|regex_match[/^[1-9][0-9]{9}$/]');

			$this->form_validation->set_rules('login_email','User email','trim|required|valid_email|is_unique[login.login_email]');

			$this->form_validation->set_rules('login_password','User password','trim|required|alpha_numeric|min_length[4]|max_length[12]');

			$this->form_validation->set_rules('login_cpassword','Password Confirmation','required|matches[login_password]');

			if($this->form_validation ->run() == false){
				echo validation_errors();
			}
			else{
				//echo "ohk";

				$_POST['login_password']=do_hash($_POST['login_password']);
				unset($_POST['login_cpassword']);
				//print_r($_POST);
				$ans = $this->project_model->insertData("login",$_POST);
				if($ans){

					// $this->email->set_mailtype("html");
					// $this->email->from('vishal@php-training.in','vishal');
					// $this->email->to($_POST['log_email']);

					// $this->email->subject('Email Test');
					// $base = base_url();
					// $msg = "<a href='".$base."index.php/project/verifyAccount/1/$ans'>Verify</a>";
					// $this->email->message($msg);

					// $re->$this->email->send();

					echo "User Added";

				}
			}
		}

		function verifyAccount(){

			$this->project_model->update_status($status,$id);

			redirect("http://localhost/ci_eshopper/login.html");
		}

		function loginAction(){
			//print_r($_POST);

			$this->form_validation->set_rules('login_email','User email','trim|required|valid_email');

			$this->form_validation->set_rules('login_password','User password','trim|required|alpha_numeric|min_length[4]|max_length[12]');

			if($this->form_validation->run() == false ){
				echo validation_errors();
			}
			else{
				//echo "successful";
				//print_r($_POST);
				$_POST['login_password']= do_hash($_POST['login_password']);
				if($this->project_model->auth($_POST)){

					//echo "valid";
					$ans_users = $this->project_model->getuserdata($_POST['login_email']);

					//print_r($ans_users);
					//$_SESSION[xyz]=111;
					if($ans_users[0]['login_status']== 0){

						echo "verify your Account";

					}
					else{

						$this->session->set_userdata("login_id",$ans_users[0]['login_id']);

						$this->session->set_userdata("login_name",$ans_users[0]['login_name']);

						$this->session->set_userdata("login_mobile",$ans_users[0]['login_mobile']);

						$this->session->set_userdata("login_email",$ans_users[0]['login_email']);

						$this->session->set_userdata("login_status",$ans_users[0]['login_status']);

						echo "ok#".$ans_users[0]['login_status']."#".$ans_users[0]['login_name'];
					}
					
				}
				else{
					echo "invalid";
				}

			}

		}

		function logout(){
			$this->session->unset_userdata("login_id");
			$this->session->unset_userdata("login_name");
			$this->session->unset_userdata("login_email");
			$this->session->unset_userdata("login_mobile");
			$this->session->unset_userdata("login_status");
			$this->session->sess_destroy();
			redirect("http://localhost/ci_eshopper/index.html");
		}

		function check_users(){

			if(!$this->session->userdata("login_id") && $this->session->userdata("login_id")==""){
				echo 0;
			}

			else{

				echo 1;
			}
		}

}

?>