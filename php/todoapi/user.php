<?php
// Connect to database
	include("connection.php");
	$db = new dbObj();
	$connection =  $db->getConnstring();
 
	$request_method=$_SERVER["REQUEST_METHOD"];

    switch($request_method)
	{
		case 'GET':
			// Retrive Products
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_user($id);
			}
			else
			{
				get_user();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;

        case 'POST':
            // Insert Product
            insert_user();
            break;
        case 'POST':
            // Update Product
            $id=intval($_GET["id"]);
            update_user($id);
            break;
        case 'DELETE':
           // Delete Product
            $id=intval($_GET["id"]);
            delete_user($id);
            break;
            
	}

    function get_user($id=0)
    {
        global $connection;
        $query="SELECT * FROM test1";
        if($id != 0)
        {
            $query.=" WHERE id=".$id." LIMIT 1";
        }
        $response=array();
        $result=mysqli_query($connection, $query);
        while($row=mysqli_fetch_assoc($result))
        {
            $response[]=$row;
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }




    function insert_user()
	{
		global $connection;

		$data = json_decode(file_get_contents('php://input'), true);
		$name=$data["name"];
		$description=$data["description"];
		$query="INSERT INTO test1 SET name='".$name."', description='".$description."'  ";
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'User Added Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'User Addition Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

    function update_user($id)
	{
		global $connection;
		$post_vars = json_decode(file_get_contents("php://input"),true);
		$name=$post_vars["name"];
		$description=$post_vars["description"];
		$query="UPDATE test1 SET name='".$name."', description='".$description."' WHERE id=".$id;
		if(mysqli_query($connection, $query))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Employee Updated Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Employee Updation Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}

    function delete_user($id)
{
	global $connection;
	$query="DELETE FROM test1 WHERE id=".$id;
	if(mysqli_query($connection, $query))
	{
		$response=array(
			'status' => 1,
			'status_message' =>'Employee Deleted Successfully.'
		);
	}
	else
	{
		$response=array(
			'status' => 0,
			'status_message' =>'Employee Deletion Failed.'
		);
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}


?>