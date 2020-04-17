<?php
require_once("snippets.php");
require_once("navbar.php");
if (!is_admin()) {
    goBack();
};
if (isset($_POST["passwordChange"])) {
    
    
    
    ?>
    <script>
        Swal.fire({
            title: 'Credentials',
            html: '<input type="password" id="password1" class="swal2-input" placeholder="Enter new password"></input>' +
            '<input type="password" id="password2" class="swal2-input" placeholder="Enter new password again"></input>',
            confirmButtonText: 'Login',
            preConfirm: () => {
                let password1 = Swal.getPopup().querySelector('#password1').value
                let password2 = Swal.getPopup().querySelector('#password2').value
                if (password1 === '' || password2 === '') {
                    Swal.showValidationMessage(`You have to fill both of the forms!`)
                }
                if (password1 !== password2) {
                    Swal.showValidationMessage(`Password confirmation doesn't match the password`)
                }
                return {
                    password1: password1,
                    password2: password2
                }
            }
        }).then((result) => {
            let data = {
                password1: "password1",
                password2: "password2"
            };
            $.ajax({
                type: "POST",
                url: 'users.php',
                data: JSON.stringify(data),
            });
        })
        </script>
<?php
}
$changePassUser = $_POST["username"];

if (isset($_POST["password1"]) && isset($_POST["password2"])) {
    change_user_password($changePassUser, $_POST["password1"]);
}


?>


<head>
    <title>Lavató - Felhasználók</title>
    <link href="assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <script src="assets/js/jquery-3.3.1.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        $('#usersTable').DataTable();
    });
</script>
<div class="main-container container">
    <h1 class="register-h1">Felhasználók</h1>
    <hr class="register-hr">
    <div class="log-table">
        <table id="usersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="th-sm">id</th>
                    <th class="th-sm">Felhasználónév</th>
                    <th class="th-sm">Admin</th>
                    <th class="th-sm">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php get_users(); ?>
            </tbody>
        </table>
    </div>
</div>