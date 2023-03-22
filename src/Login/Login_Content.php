<?php
$usernames = GetUsernames();
?>

<div class="row">
    <div class="col-md-6 mx-auto" style="padding-bottom: 50px;">
    <h1 class="display-3" style="text-align: center;">Vaccination Tracker</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
            </div>
            <div class="card-body">
                <form action='Login_Authenticate.php' method='POST'>
                    <div class="form-group">
                        <label for="username">Username <i class="fas fa-info-circle fa-sm text-info" style="color: #337eff;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Log in as <b><u>Administrator</u></b> to view reports.<br/> Log in as <b><u>Vaccinator</u></b> to add patient vaccinations and view Vaccinator history."></i></label>
                        <select name="txtUsername" class="form-select" aria-label="select user">
                            <option selected disabled="disabled">-- Select Administrator --</option>
                            <option value="DemoAdministrator">Demo Administrator</option>
                            <option disabled="disabled"></option>
                            <option disabled="disabled">-- Select Vaccinator --</option>
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

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>