$(document).ready(function(){

	if(localStorage.cartcnt){

		$(".cartcnt").html(localStorage.cartcnt)
	}
	else{

		$(".cartcnt").html(0);
	}

	$.get(curl+"check_users", function(data , status){

		//console.log(data)
		if(data == 0){

			//console.log(localStorage)
			localStorage.removeItem("username");
			localStorage.removeItem("userstatus");
			var link = "<li><a href='cart.html'>Cart(<span class='cartcnt'></span>)</a></li><li><a href='forgot_password.html'>forgot password</a></li><li><a href='login.html'><i class='fa fa-lock'></i>login</a></li>"
		}

		else{

			uname = localStorage.username
			ustatus = localStorage.userstatus
			var link = "<li><a href='cart.html'>Cart(<span class='cartcnt'></span>)</a></li><li><a href='add_category.html'>category</a></li><li><a href='add_product.html'>product</a></li><li><a href='change_password.html'>password</a></li><li><a href='"+curl+"logout'><i class= 'fa fa-lock'></i>logout("+uname+")</a></li>";
		}

		$('#links').html(link)
	});

	

	//console.log(curl)

	$.get(curl+ "get_categories", function(data, status){

		//console.log(status)
		if(status=="success"){

			$(".category_data").html(data)
		}
	});

	$.get(curl+ "get_brands", function(data, status){

		
		//console.log(status)
		if(status=="success"){

			//console.log(data)

			$(".brands_data").html(data)

		}
	});

	$.get(curl+ "get_products", function(data, status){

		//console.log(status)
		if(status=="success"){

			//console.log(data)

			$(".features_items").html(data)

		}
	});

	$(document).on("click",".br_data",function(aobj){

		aobj.preventDefault();
		var id= $(this).attr("for")
		//alert(id);

		//alert("brid="+id)
		$.ajax({
			type:"post",
			data:"brid="+id,
			url: curl+"get_products_brandwise",
			success:function(response){

				//alert(response);
				$(".features_items").html(response)

			}
		})
	})

	$(document).on("click",".add-to-cart",function(aobj){

		aobj.preventDefault();
		var id= $(this).attr("for");
		//alert(id);

		//alert("p_id="+id)
		$.ajax({
			type:"post",
			data:"proid="+id,
			url: curl+"cart",
			success:function(response){

				//alert(response);
				//$(".features_items").html(response)
				rans = response.split("#")
				$(".cartcnt").html(rans[0])
				localStorage.cartcnt = rans[0];
				alert(rans[1]);

			}
		})

	})

	$(document).on("click",".add-to-wishlist",function(aobj){

		aobj.preventDefault();
		var id= $(this).attr("for");
		alert(id);

		//alert("p_id="+id)
		$.ajax({
			type:"post",
			data:"proid="+id,
			url: curl+"wishlist",
			success:function(response){

				alert(response);
				//$(".features_items").html(response)
				// rans = response.split("#")
				// $(".cartcnt").html(rans[0])
				// localStorage.cartcnt = rans[0];
				// alert(rans[1]);

			}
		})

	})

	//cart check

	$.get(curl+ "get_cart_products", function(data, status){

		//console.log(status)
		if(status=="success"){

			//console.log(data)

			$(".cart_items").html(data)

		}
	});

	$(document).on("click",".delete-to-cart",function(obj){
		if(confirm("want to delete")){
			curele = $(this);
			obj.preventDefault();
			id = $(this).attr("for");
		}

		//alert(id);
		$.ajax({
			type:"post",
			data:"proid="+id+"&x=10",
			url: curl+"deletecart",
			success:function(response){

				//console.log(response);

				rans = response.split("#")
				$(".cartcnt").html(rans[0])
				localStorage.cartcnt = rans[0];
				//alert(rans[1]);

				curele.parent().parent().parent().parent().fadeOut(1000)
				

			}
		})


	});

	$("#register_form").submit(function(obj){
		obj.preventDefault();
		//alert("submitted");

		$.ajax({
			type:"post",
			data:$(this).serialize(),
			url:curl+ "registerAction",
			success:function(response){

				//console.log(response)
				$(".err_register").html(response);
			}
		})
	})

	$("#login_form").submit(function(obj){
		obj.preventDefault();
		//alert("submitted");

		$.ajax({
			type:"post",
			data:$(this).serialize(),
			url:curl+ "loginAction",
			success:function(response){

				// console.log(response)
				//ok#1
				ans = response.split("#")
				if(ans[0]== "ok"){
					//console.log(ans[2])
					//console.log(ans[1])
					//console.log(ans[0])
					localStorage.setItem("userstatus",ans[1])
					localStorage.setItem("username",ans[2])
					window.location.href = "index.html"
				}
				else{
						$(".err_login").html(response);
				}
			}
		})
	});

	$("#changepass_form").submit(function(obj){
		obj.preventDefault();

		$.ajax({
			type:"post",
			data:$(this).serialize(),
			url:curl+"updateAction",
			success:function(response){

				 console.log(response)
				//ok#1
						$(".err_update").html(response);
		
			}
		})

	})

	$("#form3,#form2").hide();
	
	$(".btn-forgot1").click(function(){
		// alert(1)
		$.ajax({

			type:"post",
			data:$("#forgot1_form").serialize(),
			url:curl+"forgot1_action",
			success:function(response){
				if(response=="ok"){

					$("#form1,#form2").slideToggle();
				}
				else{

					$(".err_forgot1").html(response);
				}
			}
		})
				
	});

	$(".btn-category").click(function(){
		//alert(1);
		//alert(curl)
		$.ajax({

			type:"post",
			data:$("#category_form").serialize(),
			url:curl+"category_action",
			success:function(response){
				//console.log(response);
				$(".err_category").html(response);
			}
		})
	})


	$.get(curl+ "get_category_option", function(data, status){

		//console.log(status)
		if(status=="success"){

			$("#p_caid").html(data)
		}
	});

	$.get(curl+ "get_brands_option", function(data, status){

		
		//console.log(status)
		if(status=="success"){

			//console.log(data)

			$("#p_brid").html(data)

		}
	});

	// add product by ajax
	$(".btn-product").click(function(){

		var formobj = document.getElementById("form_data");
		var formDataobj = new FormData(formobj);
		//alert(1)
		$.ajax({

			type:"post",
			data:formDataobj,
			contentType:false,
			processData:false,
			url:curl+"product_action",
			success:function(response){
				//console.log(response);
					$(".err_product2").html(response);
			}
		})
				
	});


})