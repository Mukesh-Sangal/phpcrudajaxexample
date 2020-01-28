<?php
$host = "localhost";
$user = "root";
$pass = "root";
$dbname= "thapajax";
$conn = mysqli_connect($host,$user,$pass,$dbname);
extract($_POST);
//print_r($_POST);

if(isset($_POST['readrecord'])){
	$data = '<table class="table table-bordered table-striped">
	<tr>
		<th>Id</th>
		<th>Name</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Edit Action</th>
		<th>Delete Action</th>
	</tr>';
	$displayquery = " SELECT * FROM `ajaxtable` ";
	$result = mysqli_query($conn,$displayquery);
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$data .= '
			<tr>
				<td>'.$row['id'].'</td>
				<td>'.$row['name'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['phone'].'</td>
				<td>
				<button onclick="GetUserDetails('.$row['id'].')" class= "btn btn-success">Edit</button>
				</td>
				<td>
				<button onclick="DeleteUser('.$row['id'].')" class= "btn btn-danger">Delete</button>
				</td>
			</tr>';
		}
	}
	$data .= '</table>';
}

echo $data;

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])){
	$query = "INSERT INTO `ajaxtable`(`name`,`email`,`phone`) VALUES ('$name', '$email', '$phone')";
	mysqli_query($conn,$query);

}
//Delete user record
	if(isset($_POST['deleteid'])){
		$userid = $_POST['deleteid'];
		$deletequery = " DELETE FROM `ajaxtable` WHERE id = '$userid'";
		mysqli_query($conn,$deletequery); 
	}
	//Get userid to update user detail
	if(isset($_POST['id']) && isset($_POST['id']) != ""){

		$user_id = $_POST['id']; 
		//print_r($user_id); die(123);
		 $query = "SELECT * FROM `ajaxtable` WHERE id = '$user_id'";
		if(!$result = mysqli_query($conn,$query)){
			exit(mysqli_error());
		}
		 $response = array();
		// print_r($response);die();
		if(mysqli_num_rows($result) > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				$response = $row;
			}
		}else{
			$response['status'] = 200;	
			$response['message'] = "Data Not found" ;
		}
		echo json_encode($response);
	}
	else{
		$response['status'] = 200;	
		$response['message'] = "invalid_required" ;
	}
	//update table
	if(isset($_POST['hidden_user_id'])){
		$hidden_user_id = $_POST['hidden_user_id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$query = "UPDATE `ajaxtable` SET `name`='$name',`email`='$email',`phone`='$phone' WHERE id = '$hidden_user_id' ";
		mysqli_query($conn,$query);
	}
?>