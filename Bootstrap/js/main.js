/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function() {
    $('.search').keydown(function(event) {
        if (event.keyCode == 13) {
            this.form.submit();
            return false;
         }
    });
});

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
			scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

function add_to_cart(id){
	console.log(id);
	$.ajax({
		url: $('.baseurl').text() + 'Cart/addItem',
		type: 'POST',
		dataType: 'text',
		data: {add_item: id},
		success : function(data){
			if (data =='error'){
				swal({title: "Xin lỗi! Sản phẩm này hiện không còn đủ số lượng bạn cần mua!",type: "error"});
				}
			else				                        
			swal({title: data + " đã được đưa vào giỏ hàng",type: "success", confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
				  if (isConfirm) {
				   location.reload(true);
				  } 
				});
		}
	});
}
function add_to_cart_quantity(id){
	var quantity = document.getElementsByClassName('cart_quantity_input '+id)[0].value;
	event.preventDefault();
	$.ajax({
		url: $('.baseurl').text() + 'cart/change_quantity_cart',
		type: 'POST',
		dataType: 'text',
		data: {key_quantity_cart: id,
				quantity: quantity
		},

		success : function(data){
			if (data== "format"){
				swal({title: "Xin lỗi! Chỉ nhập số dương!",type: "error",confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
					  if (isConfirm) {
					  	var elem = document.getElementsByClassName("cart_quantity_input "+id);
						elem[0].value = 1;
            			location.reload(true);
					  } 
				});
			}else if (data.indexOf("error") >= 0){
					var quantity1 = data.split('|')[1];
					if(quantity1==0)
						swal({title: "Xin lỗi! Sản phẩm này đã hết, mong quý khách thông cảm!",type: "error"}, function(isConfirm){
					  	var elem = document.getElementsByClassName("cart_quantity_input "+id);
						elem[0].value = "";
					});
					else
						swal({title: "Xin lỗi! Sản phẩm này chỉ còn "+quantity1+" quyển, mong quý khách thông cảm!",type: "error"}, function(isConfirm){
					  	var elem = document.getElementsByClassName("cart_quantity_input "+id);
						elem[0].value = quantity1;
					});
			}
			else{
				swal({title: "Đã thêm thành công vào giỏ hàng",type: "success", confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
				  if (isConfirm) {
				   location.reload(true);
				  } 
				});
				}
		}
	});
}

function load_ajaxlogin(){
	var URL =$('.baseurl').text()+"user/checklogin";
     $.ajax({
        url : URL,
        type : "post",
        dataText : "text",
        data:{
            mail : $('#email').val(),
            pass : $('#password').val()
        },
        success : function(data){
        	if(data == "email")
        		swal({title: "Bạn chưa điền email",type: "error"});
        	else if(data == "email_error")
        		swal({title: "Định dạng email không đúng",type: "error"});
        	else if(data =="pass")
        		swal({title: "Bạn chưa điền mật khẩu",type: "error"});
        	else if(data =="null")
        		swal({title: "Email hoặc mật khẩu không trùng khớp",type: "error"});
        	else
        		{
        			swal({title: "Đăng nhập thành công",type: "success", confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
					  if (isConfirm) {
            			window.location.href = $('.baseurl').text();
					  } 
					});
        		}
        }
     });
}

function load_ajax(){
	 var data = {
	    name : $('#name').val(),
	    email : $('#email1').val(),
	    pass : $('#pass').val(),
	    passconfirm : $('#repassword').val(),
	    // captcha : $('#captcha').val()
	};
     $.ajax({
        url : URL =$('.baseurl').text()+"user/signup",
        type : "post",
        dataText : "text",
        data: data,
        success : function(data){
    		swal({title: "Thành công",type: "success", confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
			  if (isConfirm) {
    			location.reload(true);
			  } 
			});
        }
     });
}

function buy(){
	event.preventDefault();
	$.ajax({
		url : $('.baseurl').text() + 'order/buy',
		type : "post",
		datatype : "text",
		data : {
			city: $('#city').find(':selected').val(),
			district: $('#district').find(':selected').val(),
			address : $('.user_address').val(),
			receiver : $('.receiver').val(),
			phone : $('.phone').val(),
		},
		success : function(data){
			if(data =="login")
			swal({title: "Phải đăng nhập trước khi mua hàng",type: "error", confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
			  if (isConfirm) {
				window.location.href = $('.baseurl').text() + 'user/account';
			  } 
			});

			else if(data == "null")
				swal({title: "Chọn sản phẩm cần mua",type: "error"});
			else if(data == "city" ||data == "district"||data == "address"||data == "receiver"||data == "phone")
				swal({title: "Bạn cần điền thông tin địa chỉ",type: "error"});
			else if(data.indexOf("error") >= 0){
				var name = data.split('|')[1];
				var quantity = data.split('|')[2];
				if(quantity==0)
					swal({title: "Sản phẩm "+name+" đã hết, mong quý khách thông cảm.",type: "error",confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
					if (isConfirm) {
						window.location.href = $('.baseurl').text() + 'cart/';
					} 
				});
				else
				swal({title: "Sản phẩm "+name+" chỉ còn "+quantity+" quyển, mong quý khách thông cảm.",type: "error",confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
					if (isConfirm) {
						window.location.href = $('.baseurl').text() + 'cart/';
					} 
				});

			}
			else
			swal({title: "Mua hàng thành công",type: "success", confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
			  if (isConfirm) {
    			// window.location.href = "order-details.php?id="+data;
    			window.location.href = $('.baseurl').text() + 'order-details/' +data;
			  } 
			});

		}
	});
}
function add_quantity(id){
	$.ajax({
		url : $('.baseurl').text() + 'cart/add_cart',
		type : "post",
		datatype : "text",
		data : {add_cart : id,
		},
		success : function(data){
			if (data == "error")
				swal({title: "Xin lỗi! Sản phẩm này hiện không còn đủ số lượng bạn cần mua!",type: "error"});
			else
				location.reload(true);
		}
	});
}
function minus_quantity(id){
	$.ajax({
		url : $('.baseurl').text() + 'cart/minus_cart',
		type : "post",
		datatype : "text",
		data : {minus_cart : id,
		},
		success : function(data){
			location.reload(true);
		}
	});
}
function remove_cart(id){
	$.ajax({
		url : $('.baseurl').text() + 'cart/remove_cart',
		type : "post",
		datatype : "text",
		data : {remove_cart : id},
		success : function(data){
			location.reload(true);
		}
	});
}

function deleted_order(id){
	swal({
	  title: "Hủy đơn hàng?",
	  text: "Bạn có chắc chắn muốn hủy đơn hàng này?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Đồng ý",
	  cancelButtonText: "Không",
	  closeOnConfirm: false,
	  closeOnCancel: true
	},
	function(isConfirm){
		if (isConfirm) {
			$.ajax({
				url : $('.baseurl').text() + 'order/delete',
				type : "post",
				datatype : "text",
				data : {order : id},
				success : function(data){
					swal({title: "Hủy đơn hàng thành công",type: "success", confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
						if (isConfirm) {
							window.location.href = $('.baseurl').text() + 'order-lists/'+data;
						 } 
					});
				}
			});
		}
	});			
}
//thay đối số lượng ô input
function myFunction(val,id) { //thay doi so luong o input
    event.preventDefault();
    $.ajax({
		url : $('.baseurl').text() + 'cart/change_quantity',
		type : "post",
		datatype : "text",
		data : {key_quantity : id,
				quantity: val
		},
		success : function(data){
			// alert(data);
			if (data.indexOf("format") >= 0){
				var quantity = data.split('|')[1];
				swal({title: "Xin lỗi! Chỉ nhập số dương!",type: "error",confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
					  if (isConfirm) {
					  	var elem = document.getElementsByClassName("cart_quantity_input "+id);
						elem[0].value = quantity;
            			location.reload(true);
					  } 
				});
			}else if (data.indexOf("error") >= 0){
					var quantity = data.split('|')[1];
					if(quantity==0)
						swal({title: "Xin lỗi! Sản phẩm này đã hết, mong quý khách thông cảm!",type: "error",confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
					  if (isConfirm) {
					  	var elem = document.getElementsByClassName("cart_quantity_input "+id);
						elem[0].value = quantity;
            			location.reload(true);
					  } 
					});
					else
						swal({title: "Xin lỗi! Sản phẩm này chỉ còn "+quantity+" quyển, mong quý khách thông cảm!",type: "error",confirmButtonText: "OK", closeOnConfirm: false}, function(isConfirm){
					  if (isConfirm) {
					  	var elem = document.getElementsByClassName("cart_quantity_input "+id);
						elem[0].value = quantity;
            			location.reload(true);
					  } 
					});
			}
			else{
				location.reload(true);
			}
		}
	});
}

// function loadCity(){
// 	$.ajax({
// 		type: "POST",
// 		url: "quan.php",
// 		data: "get=city"
// 	})
// 	.done(function(data) {
// 		result = JSON.parse(data);
// 		$(result).each(function(){
// 			$("#city").append($('<option>',{
// 				value: this.id,
// 				text: this.ten
// 			}));
// 		})
// 	});
// }


// function loadDistrict(cityId){
//         $("#district").children().remove();
//         $.ajax({
//             type: "POST",
//             url: "quan.php",
//             data: "get=district&cityId=" + cityId
//             }).done(function( data ) {
//             	// alert(data);
//             	result = JSON.parse(data);
            	
//                 $(result).each(function(){
//                     $("#district").append($('<option>', {
//                         value: this.id,
//                         text: this.ten
//                     }));
//                 })
//             });
// }				   