<div class="container">

	<div class="row">

		<button id="add_row" class="btn btn-success"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Row</button>
		<table id="myhometable" class="table table-responsive table-striped">
			<thead>
				<th>Sr No</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Edit</th>
				<th>Delete</th>
			</thead>
			<tbody>
				<?php
					$sr = 1;
					foreach ($get_data as $data) :
				?>
				<tr>
				  	<td><?= $sr; ?></td>
				  	<td><?= $data['name']; ?></td>
				  	<td><?= $data['email']; ?></td>
				  	<td><?= $data['phone']; ?></td>
                  <td><a class="btn btn-primary btn-sm" href="<?= base_url('user/edit_data/' . $data['id']) ?>"><span class="glyphicon glyphicon-edit"></span> Edit</a></td>
                  <td><a class="btn btn-danger btn-sm" href="<?= base_url('user/data_delete?row_id=' . $data['id']) ?>" onclick="if(confirm('Are your sure want to delete !'));else{ return false}"><span class="glyphicon glyphicon-trash"></span> Delete</a></td>
				  	
				<?php $sr++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

</div>

<script>
$(document).ready(function(){
	add_row();
	show_data();
    
});	

	function add_row()
	{
		$('#add_row').click(function(){
			$('#modalAdd_row').modal('show'); // Calling modal with id = modalAdd_row
			$('#submit').click(function(e){
			e.preventDefault();
			var name = $('#name').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			alert(name + " : " + email +" : "+ phone);
			$('#modalAdd_row').modal('hide'); 
			show_data();
			});
		});
	}

	function show_data()
	{
			$.ajax({

				type:'POST',
				url:'<?php echo base_url()?>user/add_row',
				dataType:'json',
				success:function(result){

					$("table#myhometable").html(result.show_table);
					// $('#submit').disabled(true);
				}

			});		
	}

</script>


<!-- Modal -->
<div id="modalAdd_row" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Add new row here</p>
		<form class="form-inline" id="formAddrow">

		  <div class="form-group">
		    <label class="sr-only" for="name">Name</label>
		    <input type="text" class="form-control" id="name" placeholder="Name">
		  </div>

		  <div class="form-group">
		    <label class="sr-only" for="email">Email</label>
		    <input type="email" class="form-control" id="email" placeholder="Email">
		  </div>
		  <div class="form-group">
		    <label class="sr-only" for="phone">Phone:</label>
		    <input type="number" class="form-control" id="phone" placeholder="Phone">
		  </div>
		  <button type="submit" id="submit" class="btn btn-default">Submit</button>
		</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>