<?php
// $usernames = [
//     [
//         'MedicalPersonId' => 1,
//         'Username' => 'John Doe'
//     ],
//     [
//         'MedicalPersonId' => 2,
//         'Username' => 'Bilal Asghar'
//     ],
//     [
//         'MedicalPersonId' => 3,
//         'Username' => 'Khadijah Asghar'
//     ]
// ];

$usernames = GetUsernames();
?>

<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3><i class="fas fa-sign-in-alt"></i> Login</h3>
            </div>
            <div class="card-body">
                <form action='' method=''>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select
                                <?php foreach ($usernames as $username) { ?>
                            <option value="<?= $username['Id'] ?>"><?= $username['Name'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top: 10px;">
                        <label for="username">Password</label>
                        <input type="text" name="password" class="form-control" disabled value="****">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>