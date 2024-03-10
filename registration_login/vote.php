<?php

session_start();
include("../API/connect.php");

$votes=$_POST['gvotes'];
$total_votes=$votes+1;
$gid=$_POST['gid'];
$uid=$_SESSION['userdata']['id'];

$updatevotes=mysqli_query($con,"UPDATE user SET votes=$otal_votes WHERE id='gid'");
$updateuserstatus=mysqli_query($con,"UPDATE user SET status-1 WHERE id='uid'");

if($updatevotes and $updateuserstatus){
    $groups=mysqli_query($con,"SELECT id,name,votes FROM user WHERE role=2");
    $groupsdata=mysqli_fetch_all($groups,MYSQLI_ASSOC);

    $_SESSION['userdata']['status']=1;
    $_SESSION['groupsdata']=$groupsdata;

    echo '
    <script> 
    alert("Voting successful");
    window.location="dashboard.php";
    </script>
    ';

}else{
    echo '
            <script> 
            alert("Some error occured");
            window.location="dashboard.php";
            </script>
            ';
}

?>