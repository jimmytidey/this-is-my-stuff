$(document).ready(function() {
	things = {}; 
	
	$("#search_submit").click(function(){ 
		var search_term = $('#search_term').val();
		$('#results_container').html("<img src='images/ajax-loader.gif' id='loader' />"); 
		$.getJSON('proxy.php?query='+search_term , function(data){
			$("#loader").remove();
			things.product_data = data; 
			$.each(data, function(index, value) { 
				$('#results_container').append("<div class='product'>");
				$('#results_container').append("<p class='description'>" + value.fn + "</p>");
				$('#results_container').append('<img class="image" src="'+ value.photo + '" />');
				//$('#results_container').append('<input class="add_btn" data-index='+ index + ' value="this is my thing &raquo;" type="button" />');
				$('#results_container').append("<div class='added_link'><input type='button' data-index='"+ index + "' value='I have this' class='action' data-action='has' /> <input type='button' data-index='"+ index + "' class='action' data-action='wants' value='I want this' /> </div>");
				$('#results_container').append("</div>");
				 attachAddProductHandler();
			});  
		});
	})
	
	function attachAddProductHandler() { 
		$('.action').unbind('click'); 
		$('.action').click(function()  {
			addProduct(this);
		}); 
	}
	
	function addProduct(elem) {
		
		var data_index = $(elem).attr('data-index'); 
		var action = $(elem).attr('data-action'); 
		var user_id = $("#session_id").val();

		$(elem).parent(".added_link").html("Making you an ADI &nbsp; &nbsp;<img src='images/ajax-loader.gif' id='loader' />"); 

		//test to see if the product is in the DB already
		var id = things.product_data[data_index]['id'];
		var query = '{id:"'+id+'"}'; 	
		$.get("data/products/search/"+query, function(search_result) {
			if (search_result.data.length == 0) { // save this product 
				var product_data = encodeURIComponent(JSON.stringify(things.product_data[data_index])); 
				$.get("data/products/create/?json_string=true&json_data=" + product_data, function(created_product) {
					product_id = created_product.data.id;
					//alert("making new product: " + product_id);
					adi_data = {"product_id":product_id, "user_id":user_id, "action":action};
					var adi_data_clean = encodeURIComponent(JSON.stringify(adi_data));
					$.get("data/adi/create/?json_string=true&json_data=" + adi_data_clean, function(adi_data) {
						window.location = "adi.php?id="+adi_data.data["_id"]["$oid"];
					});
				});
			}
			
			else {
				product_id = search_result['data'][0]['id'];
				//alert("Product already exists: " + product_id);
				adi_data = {"product_id":product_id, "user_id":user_id, "action" : action };
				var adi_data_clean = encodeURIComponent(JSON.stringify(adi_data));
				$.get("data/adi/create/?json_string=true&json_data=" + adi_data_clean, function(data) {
					window.location = "adi.php?id="+adi_data.data["_id"]["$oid"];			
				});	
			}
		});		
	}
}); 