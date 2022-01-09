<?php
session_start();

if ($_SESSION["medicalPersonId"] == null && basename($_SERVER['PHP_SELF']) != "Login.php") {
    header('Location: ../Login/Login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Vaccination Tracker</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='/MasterPages/Master.css'>

    <!-- External CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- PHP Code Files -->
    <?php include("DatabaseHelpers.php"); ?>
</head>

<body>
    <div class="container">
        <?php if (basename($_SERVER['PHP_SELF']) != "Login.php") { ?>
            <div style="float: right; margin-top: 10px;">
                <a href="/Login/Logout.php" class="btn btn-danger"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </div>
        <?php } ?>

        <h1 style="margin-bottom: 40px;"><?php echo $page_header ?></h1>

        <?php include($page_content); ?>
    </div>

    <!-- External Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>