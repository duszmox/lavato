<?php
require_once("snippets.php");
require_once("navbar.php");
$is_hidden = "hidden";
if (!is_admin()) {
    goBack();
};
if (isset($_POST["passwordChange"])) {

    $_SESSION["temp_userchange"] = $_POST["username"];

?>
    <script>
        Swal.fire({
            title: 'Írd be az új jelszót!',
            html: '<input type="hidden" name="username" id="username" value="<?php echo $_POST["username"] ?>"><input type="password" id="password1" class="swal2-input" placeholder="Enter new password"></input>' +
                '<input type="password" id="password2" class="swal2-input" placeholder="Enter new password again"></input>',
            confirmButtonText: 'Rendben',
            preConfirm: () => {
                let password1 = Swal.getPopup().querySelector('#password1').value;
                let password2 = Swal.getPopup().querySelector('#password2').value;
                let username = Swal.getPopup().querySelector("#username").value;
                if (password1 === '' || password2 === '') {
                    Swal.showValidationMessage(`You have to fill both of the forms!`)
                }
                if (password1 !== password2) {
                    Swal.showValidationMessage(`Password confirmation doesn't match the password`)
                }

                let data = {
                    "password1": password1,
                    "password2": password2,
                    "username": username
                };
                $.ajax({
                    type: "POST",
                    url: 'users.php',
                    data: {
                        json: JSON.stringify(data)
                    },
                })
            }
        })
    </script>
    <?php
}

if (isset($_POST["json"])) {
    $json = json_decode($_POST["json"], true);
    change_user_password($json["username"], $json["password1"]);
}

if (isset($_POST["adminRightChanger"])) {
    $is_admin = is_admin_table($_POST["username"]);
    if ($is_admin == 0) {
        make_admin($_POST["username"]);
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sikeresen admin jogot adtál <?php echo $_POST["username"] ?> felszanálónak!',
                text: '',
            })
        </script>
    <?php
    } else {
        remove_admin($_POST["username"]);
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sikeresen elvetted <?php echo $_POST["username"] ?> admin jogosultságait!',
                text: '',
            })
        </script>
    <?php
    }
}
if (isset($_POST["deleteUser"])) {
    delete_user($_POST["username"]);
    ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Sikeresen törölted <?php echo $_POST["username"] ?> felhasználót!',
            text: '',
        })
    </script>
<?php
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
        $('#usersTable').DataTable({
            "bPaginate": false,
            "sScrollX": "110%",
            "sScrollY": "400px",
            "bScrollCollapse": true,
            "autoWidth": true,

        });
        $('.dataTables_filter').addClass('filter-css');
    });
</script>
<div class="main-container container">
    <h1 class="register-h1">Felhasználók</h1>
    <hr class="register-hr">
    <div class="alert alert-success" role="alert" <?php echo $is_hidden; ?>>
        Sikeresen megváltoztattad <?php echo $_POST["username"] ?> jelszavát!
    </div>
    <div class="log-table">
        <table id="usersTable" class="table table-striped table-bordered" style="max-width: none !important; width: 100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="th-sm style='white-space:nowarp'">id</th>
                    <th class="th-sm" style='white-space:nowarp'>Felhasználónév</th>
                    <th class="th-sm" style='white-space:nowarp'>Admin</th>
                    <th class="th-sm" style='white-space:nowarp'>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                <?php get_users(); ?>
            </tbody>
        </table>
    </div>
</div>