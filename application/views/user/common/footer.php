
<!-- Footer Starts -->
<script>
	// Message alert box 
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 5000);
</script>
<style> 
/* for alert popup cross button floating */
  .alink{
          float: right;
         }
</style>

<script>
	// Form validation script for http://www.formvalidator.net/
  $.validate({
    lang: 'es'
  });
</script>


</body>
</html>