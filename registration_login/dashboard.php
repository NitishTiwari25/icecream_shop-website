<?php
// it is open only when login page is successful
 session_start();
 if(!isset($_SESSION['userdata'])) {
    header("location:login.php");
}

$userdata=$_SESSION['userdata'];
$groupsdata=$_SESSION['groupsdata'];

if($_SESSION['userdata']['status']==0){
    $status='<b style="color:red">Not Voted</b>';
}else{
    $status='<b style="color:green">Voted</b>';
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Online Voting System</title>
</head>

<body class="bg-info">
    <header class="d-flex flex-row">
        <a  href="../"><button type="back" class="btn btn-primary mr-auto">Back</button></a>
        <br>
        <br>
        <h2 class="text-center m-10">Online Voting System</h2>
       <a href="logout.php"> <button type="Logout" class="btn btn-primary ml-auto" >Logout</button></a>
        <hr>
    </header>

    <br>
    <section class="d-flex flex-row">
    <div class="card p-2 " style="width: 18rem;">
        <img class="card-img-top" src="..." alt="Card image cap">
        <div class="card-body">
            <b class="card-title">Name :</b>
            <?php echo $userdata['name'] ?><br>
            <b class="card-text">E-mail :</b>
            <?php echo $userdata['email'] ?> <br>
            <b class="card-text">Status :</b>
            <?php echo $status ?> <br>
        </div>
    </div>
     
    <div class="card p-2 ml-auto" style="width: 25rem;">
       <?php
    if($_SESSION['groupsdata']){
        for($i=0;$i<count($groupsdata);$i++){
         ?>
        <div>
        <b>Group Name : </b><?php  echo $groupsdata[$i]['name'] ?><br><br>
        <b>Votes      : </b><?php  echo $groupsdata[$i]['votes'] ?><br><br>
        <form action="vote.php" method="POST">
            <input type="hidden" name="gvotes" value="<?php  echo $groupsdata[$i]['votes'] ?>">
            <input type="hidden" name="gid" value="<?php  echo $groupsdata[$i]['id'] ?>">
            <input type="submit" class="btn-btn-primary" name="votebtn" value="vote" id="votebtn">
        </form>
        </div>
        <hr>
        <?php
        }
    }else{

    }
       ?>
    </div>
    </section>

    







</body>

</html>