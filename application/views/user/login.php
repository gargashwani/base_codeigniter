<style>
	#check_email{
		color:red;
	}
</style>


<div class="container">

<h2 id="form_head">Codelgniter Ajax Post</h2><br/>
<hr>	<div class="row">
		
		<div class="col-lg-3"></div>
		
		<div class="col-lg-6">
			<div class="well">
			<h2>User Login</h2>
			
			<?php
			if((isset($msg))&& (isset($alert_class)))
			{ 	echo "<div class=\"alert ". $alert_class ."\">";
				echo $msg;
				echo "<a class=\"alink\" href=\"#\" aria-label=\"close\">&times;</a></div>";
			} ?> 			

			<?php echo form_open('user_login/login_submit'); ?>
			
			<p><label for="email">Email</label>
			<?php echo form_input(['type'=>'email','class'=>'form-control','name'=>'user_email', 'id'=>'user_email',
				'data-validation'=>'email required',
				'data-validation-error-msg'=>'Please enter a proper email format'
			]); ?></p>
			<div id="check_email"></div>
			
			<p><label for="password">Password</label>
			<?php echo form_password(['name'=>'user_password','class'=>'form-control','id'=>'user_password',
				'data-validation'=>'length alphanumeric required',
				'data-validation-length'=>'min3',
				'data-validation-error-msg'=>'Password has to be an alphanumeric value (Min 3 characters)'
			]); ?>
			<br/></p>
			
			<?php echo form_submit(['value'=>'Login','id'=>'submit','class'=>'submit form-control btn btn-success']); ?>
			<?php echo form_close(); ?>				
			
			</div>
			
			<!-- <div id="user_password"></div> -->
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		check_email();
	});

	function check_email()
	{
		$('#user_email').focusout(function(){
		// $('#user_email').keyup(function(){
			var user_email = $('#user_email').val();

			$.ajax({

				type:'POST',
				url:'<?php echo base_url()?>user_login/check_email',
				dataType:'json',
				data:{user_email:user_email},
				success:function(result){
					$("div#check_email").html(result.check_email);
					$('#submit').disabled(true);
				}

			});
		});

	}
</script>
