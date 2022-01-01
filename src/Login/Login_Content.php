<?php
$usernames = GetUsernames();

?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
            </div>
            <div class="card-body">
                <form action='Login_Authenticate.php' method='POST'>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <select name="txtUsername" class="form-select" aria-label="select user">
                            <option selected disabled="disabled">-- Select User --</option>
                                <?php foreach ($usernames as $username) { ?>
                            <option value="<?= $username['MedicalPersonId'] ?>"><?= $username['Username'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="username">Password</label>
                        <input type="password" name="txtPassword" class="form-control" disabled value="*******">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>