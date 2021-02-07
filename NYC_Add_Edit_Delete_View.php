<?php

$host = "localhost";
$user = "root";
$password ="";
//input database, use localhost.
$database = " ";

$student_id = "";
$student_fname = "";
$student_lname = "";
$age = "";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//DB connection
try{
    $connect = mysqli_connect($host, $user, $password, $database);
} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}

// get values from the form
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['student_id'];
    $posts[1] = $_POST['student_fname'];
    $posts[2] = $_POST['student_lname'];
    $posts[3] = $_POST['age'];
    return $posts;
}

// View
if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM users WHERE student_id = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $id = $row['student_id'];
                $student_fname = $row['student_fname'];
                $student_lname = $row['student_lname'];
                $age = $row['age'];
            }
        }else{
            echo 'No Data For This student_id';
        }
    }else{
        echo 'Result Error';
    }
}


// Add
if(isset($_POST['insert']))
{
    $data = getPosts();
    $insert_Query = "INSERT INTO `users`(`student_fname`, `student_lname`, `age`) VALUES ('$data[1]','$data[2]',$data[3])";
    try{
        $insert_Result = mysqli_query($connect, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Inserted';
            }else{
                echo 'Data Not Inserted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

// Edit
if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query = "UPDATE `users` SET `student_fname`='$data[1]',`student_lname`='$data[2]',`age`=$data[3] WHERE `id` = $data[0]";
    try{
        $update_Result = mysqli_query($connect, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Data Updated';
            }else{
                echo 'Data Not Updated';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}

// Delete
if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `users` WHERE `student_id` = $data[0]";
    try{
        $delete_Result = mysqli_query($connect, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($connect) > 0)
            {
                echo 'Student Deleted';
            }else{
                echo 'Student Not Deleted';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

// View
if(isset($_POST['search']))
{
    $data = getPosts();
    
    $search_Query = "SELECT * FROM users WHERE student_id = $data[0]";
    
    $search_Result = mysqli_query($connect, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $id = $row['student_id'];
                $student_fname = $row['student_fname'];
                $student_lname = $row['student_lname'];
                $age = $row['age'];
            }
        }else{
            echo 'No Data For This student_id';
        }
    }else{
        echo 'Result Error';
    }
}

?>


<!DOCTYPE Html>
<html>
    <body bgcolor="blue">
        <form action="php_insert_update_delete_search.php" method="post">
            <input type="number" name="student_id" placeholder="STUDENT ID" value="<?php echo $student_id;?>"><br><br>
            <input type="text" name="student_fname" placeholder="FIRST NAME" value="<?php echo $student_fname;?>"><br><br>
            <input type="text" name="student_lname" placeholder="LAST NAME" value="<?php echo $student_lname;?>"><br><br>
            <input type="number" name="age" placeholder="Age" value="<?php echo $age;?>"><br><br>
            <div>
                <!-- Input For Add Values To Database-->
                <input type="submit" name="insert" value="Add">
                
                <!-- Input For Edit Values -->
                <input type="submit" name="update" value="Edit">
                
                <!-- Input For Clear Values -->
                <input type="submit" name="delete" value="Delete">
                
                <!-- Input For Find Values With The given ID -->
                <input type="submit" name="search" value="View">
            </div>
        </form>
    </body>
</html>