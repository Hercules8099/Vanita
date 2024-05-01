<?php
    include('conn.php');
    session_start();

    if(isset($_POST['submit']))
    {
        $username=$_POST['username'];
        $pass=$_POST['pass'];

        // echo $username." ".$pass;

        $query="SELECT * FROM users WHERE `username`='$username'";
        $result=mysqli_query($conn,$query);
        $row=mysqli_fetch_array($result);
        $rows=mysqli_num_rows($result);
        
        if($rows>=1)
        {
            if($row['pass']==$pass)
            {
                echo '<script>alert("Successfully Loged In!!");</script>';  
				
                $_SESSION['id']=$row['id'];

                echo '<script>window.location="index.php"</script>';  
            }
            else{
                echo '<script>alert("Password Is Inncorrect!!");</script>';
                echo '<script>window.location="login.php"</script>';  
            }
        }
        else{
            echo '<script>alert("Username Is Inncorrect!!");</script>';
            echo '<script>window.location="login.php"</script>';  
        }
    }
?>