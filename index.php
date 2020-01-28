<!DOCTYPE html>
<html>
<head>
	<title>ajaxtutorial</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<h1 class="text-primary text-uppercase text-center">ajax crud operation</h1>
		<div class="d-flex justify-content-end">
			<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Open modal</button>
		</div>
		<h2 class="btn btn-success text-uppercase">all records</h2>
		<div id="record-contant"></div>
		<!-- The Modal -->
		<div class="modal" id="myModal">
		  <div class="modal-dialog">
		    <div class="modal-content">

		      <!-- Modal Header -->
		      <div class="modal-header">
		        <h4 class="modal-title">Modal Heading</h4>
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      </div>

		      <!-- Modal body -->
		      <div class="modal-body">
		        <div class="form-group">
		        	<label for="name">Name:</label>
		        	<input type="text" name="" id="name" class="form-control" placeholder="Name">
		        	<label>Email:</label>
		        	<input type="email" name="" id="email" class="form-control" placeholder="Email">
		        	<label>Phone:</label>
		        	<input type="text" name="" id="phone" class="form-control" placeholder="Phone">
		        </div>
		      </div>

		      <!-- Modal footer -->
		      <div class="modal-footer">
		      	<button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- updatemodal -->
		<div class="modal" id="update_user_modal">
	  	<div class="modal-dialog">
		    <div class="modal-content">
		      <!-- Modal Header -->
			    <div class="modal-header">
			       <h4 class="modal-title">Crud Ajax Example</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>

			      <!-- Modal body -->
			      <div class="modal-body">
			      	<div class="form-group">
				        <label>Update_Name:</label>
			        	<input type="text" name="" id="update_name" class="form-control" placeholder="Update_Name">
			        	<label>Update_Email:</label>
			        	<input type="email" name="" id="update_email" class="form-control" placeholder="Update_Email">
			        	<label>Update_Phone:</label>
			        	<input type="text" name="" id="update_phone" class="form-control" placeholder="Update_Phone">
		        	</div>
			      </div>

			      <!-- Modal footer -->
			      <div class="modal-footer">
			      	<button type="button" class="btn btn-success" data-dismiss="modal" onclick="UpdateUserDetail()">Update</button>
			        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			        <input type="hidden" name="" id="hidden_user_id">
			      </div>
		    </div>
  		</div>
</div>

	</div>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		$(document).ready(function(){
  			readRecords();
  		});
  		function readRecords(){
  			var readrecord =  "readrecord";	
  			$.ajax({
  				url:"db.php",
  				type:"post",
  				data: 
  				{readrecord:readrecord},
  				success :function(data, status){
  					$('#record-contant').html(data);
  				}
  			});
  		}
	  	function addRecord(){
	  		var name = $('#name').val();
	  		console.log(name);
	  		var email = $('#email').val();
	  		console.log(email);
	  		var phone = $('#phone').val();
	  		console.log(phone);
	  		$.ajax({
	  			url:"db.php",
	  			type:"post",
	  			data: {
	  			name :name,
	  			email :email,
	  			phone :phone 
	  			},
	  			success:function(data,status){
	  				readRecords();
	  			} 
	  		});
	  	}
	  	function DeleteUser(deleteid){
	  		var conf = confirm('Are U Sure ');
	  		if(conf == true){
	  			$.ajax({
	  				url:"db.php",
	  				type:"post",
	  				data:{
	  				deleteid : deleteid
	  				},
	  			success:function(data,status){
	  				readRecords();
	  			}
	  			});
	  		}
	  	}
	  	function GetUserDetails(id){
	  		$('#hidden_user_id').val(id);
	  		//console.log(id);
	  		$.post("db.php",{
	  			id:id
	  		}, function(data,status){
	  			var user = JSON.parse(data);
	  			//alert(JSON.parse(data));
	  			$('#update_name').val(user.name);
	  			$('#update_email').val(user.email);
	  			$('#update_phone').val(user.phone);
	  		}
	  		);
	  		$('#update_user_modal').modal("show");
	  	}
	  	function UpdateUserDetail(){
	  		var name = $('#update_name').val();
	  		var email = $('#update_email').val();
	  		var phone = $('#update_phone').val();
	  		var hidden_user_id = $('#hidden_user_id').val();
	  		$.post("db.php",{
	  			hidden_user_id:hidden_user_id,
	  			name:name,
	  			email:email,
	  			phone:phone,
	  		},
	  		function(data,status){
	  			$('#update_user_modal').modal('hide');
	  			 readRecords();
	  		}
	  		);
	  	}
  	</script>
</body>
</html>