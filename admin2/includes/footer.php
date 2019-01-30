<div class="text-right">
  <div class="credits">
      <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
      -->
      Designed by @Hypro D3
    </div>
</div>
</section>

<script>
function updateSizes(){
  var sizeString = '';
  for (var i = 1;i <= 12;i++){
    if(jQuery('#size'+ i).val() != ''){
      sizeString += jQuery('#size' +i).val() + ':' + jQuery('#qty' +i).val() + ',';
    }

  }
  jQuery('#sizes').val(sizeString);
}
  function get_child_options(selected){
    //if (typeof selected == 'undefined') {
      //var selected = '';

    //}
    var parentID = jQuery('#parent').val();
    jQuery.ajax({
      url: '/Baine/admin2/parsers/child_categories.php',
      type: 'POST',
      data: {parentID : parentID},
      success: function(data){
        jQuery('#child').html(data);
      },
      error: function(){alert("Sorry!, Something is wrong with the child options. ")},
    });
  }
  jQuery('select[name="parent"]').change(get_child_options);
    //function(){
    //get_child_options();
  //});
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
<!-- container section end -->
<!-- javascripts -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- nice scroll -->
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<!--custome script for all page-->
<script src="js/scripts.js"></script>


</body>

</html>
