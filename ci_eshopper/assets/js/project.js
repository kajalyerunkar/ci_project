$(document).ready(function(){

	if(localStorage.cartcnt){

		$(".cartcnt").html(localStorage.cartcnt)
	}
	else{

		$(".cartcnt").html(0);
	}

	//console.log(curl)

	$.get(curl+ "get_categories", function(data, status){

		//console.log(status)
		if(status=="success"){

			//console.log(JSON.parse(data))
		}
	});

	$.get(curl+ "get_brands", function(data, status){

		
		console.log(status)
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

	//cart check

	$.get(curl+ "get_cart_products", function(data, status){

		//console.log(status)
		if(status=="success"){

			//console.log(data)

			$(".cart_items").html(data)

		}
	});

})