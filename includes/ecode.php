<!-- <script src="/vendor/jquery/jquery-3.2.1.js"></script>
<script src="/vendor/jquery/jquery-3.2.1.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<!-- <script>
 jQuery('#size').change(function(){
 var available = jQuery('#size option:selected').data("available");
 jQuery('#available').val(available);
 });
</script> -->

<script>
jQuery('#size').change(function(){
var available = jQuery('#size option:selected').data("available");
jQuery('#available').val(available);
});



function closeModal(){
  jQuery('#modal1').removeClass('show-modal1');
  setTimeout(function(){
    jQuery('#modal1').remove();
    jQuery('.overlay-modal1').remove();
  }, 500);
}
</script>

<script>

function detailsmodal(id){
  var data = {"id" : id};
  jQuery.ajax({
    url : '/Baine/includes/modal.php',
    method : 'post',
    data : data,
    success : function(data){
      jQuery('.inner').prepend(data);
      jQuery('.js-modal1').addClass('show-modal1');
    },
    error : function(){
      alert("Something Went Wrong!");
    }
  });

}

function update_cart(mode,edit_id,edit_size){
  var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
  jQuery.ajax({
    url : '/Baine/admin2/parsers/update_cart.php',
    method: "post",
    data : data,
    success : function(){
      location.reload();
    },
    error : function(){
      alert("something went wrong.");
    },
  })
}

function update_wish_list(mode,edit_id,edit_size){
  var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
  jQuery.ajax({
    url : '/Baine/admin2/parsers/update_wish-list.php',
    method: "post",
    data : data,
    success : function(){
      location.reload();
    },
    error : function(){
      alert("something went wrong.");
    },
  })
}


function add_to_wish_list(id,size){
  var data = {"id" : id, "size" : size};
  jQuery.ajax({
    url : '/Baine/admin2/parsers/add_wish-list.php',
    method: "post",
    data : data,
    success : function(){
  			var nameProduct = '';//jQuery('#name').html();
  			swal(nameProduct, "is added to wishlist !", "success").then(function(){
    location.reload();
});
    },
    error : function(){
      alert("something went wrong.");
    },
  })


  }
function add_to_cart() {

jQuery('#modal_errors').html("");
var size = jQuery('#size').val();
var quantity = jQuery('#quantity').val();
var available = jQuery('#available').val();
var nameProduct = jQuery('#product_name').val();
var error = '';
var data = jQuery('#add_product_form').serialize();
if(size == '' || quantity == '' || quantity == 0 || quantity < 1 ){
  error += '<p class="text-center alert alert-success">Please choose your preferred size and Quantity</p>';
  jQuery('#modal_errors').html(error);
  return;
}
else if(quantity > available){
  error += '<p class="text-center alert alert-success"> There are only '+available+' available.</p>';
  jQuery('#modal_errors').html(error);
  return;
}
else{
  jQuery.ajax({
    url : '/Baine/admin2/parsers/add_cart.php',
    method : 'post',
    data : data,
    success : function(){
  			swal(nameProduct, "is added to cart !", "success").then(function(){
    location.reload();
});
    },
    error : function(){
      alert("something went wrong");
    }
  });
}

}





  function login(){
    jQuery('#sidebar_errors').html("");
    var email = jQuery('#email2').val();
    var password = jQuery('#password').val();
    //var ln = password.length;
    function validateEmail(e) {
      var re = /\S+@\S+\.\S+/;
      return re.test(e);
}
    var error = '';
    var data = jQuery('#login_form').serialize();
    if(email == '' || password == ''){
      error += '<p class="text-center alert alert-success">Enter your Email Address and Password</p>';
      jQuery('#sidebar_errors').html(error);
      return;
    }
    else if(password.length < 6){
      error += '<p class="text-center alert alert-success">Invalid Password entered, password must be at least 6 characters Long.</p>';
      jQuery('#sidebar_errors').html(error);
      return;
    }
    else if(validateEmail(email)){
      jQuery.ajax({
        url : '/Baine/login.php',
        method : 'post',
        data : data,
        success : function(){
          location.reload();
        },
        error : function(){
          alert("something went wrong")

        }
      });
    }
    else{
      error += '<p class="text-center alert alert-success">You must enter a valid email.</p>';
      jQuery('#sidebar_errors').html(error);
      return;

    }

  }

  // jQuery('document').ready(function(){
  //   get_lga_options('< $lga; ?>');
  // });

  function get_lga_options(selected){
    //if (typeof selected == 'undefined') {
      //var selected = '';

    //}
    var parentID = jQuery('#state').val();
    jQuery.ajax({
      url: '/Baine/admin2/parsers/lga.php',
      type: 'POST',
      data: {parentID : parentID},
      success: function(data){
        jQuery('#lga').html(data);
      },
      error: function(){alert("Sorry!, Something is wrong with the child options. ")},
    });
  }
  jQuery('select[name="state"]').change(get_lga_options);
    //function(){
    //get_child_options();
  //});



</script>


<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
	<script>


		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

	</script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});


	</script>

<!--===============================================================================================-->
	<script src="js/main.js"></script>
