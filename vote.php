<html>
    <head>
    
    <link rel="stylesheet" href="main_style.css">
    <link rel="stylesheet" href="assets/fonts/leaves/stylesheet.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Lavató - Szavazás</title>
    </head>
<body class="bg">
    <?php
        require("navbar.php")
        
    ?>

    <div class="code-box">
            <form action="javascript:alert('success')" id="code-form" method="GET">
                <p>
                    <label>Code:</label>
                    <input type="text" id="hash" name="hash" >
                </p>
                <p>
                    <input type="submit" id="btn" value="Go">
                </p>     
                     
            </form>
          
    </div>
    <?php 
   
        if ($submitted == "true"){
            function html_escape($html_escape) {
                $html_escape =  htmlspecialchars($html_escape, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                return $html_escape;
            }
            $hash = html_escape($_GET['hash']);
    
            mysql_connect("localhost", "duszmo", "ThanosPapa9?");
            mysql_select_db("duszmo");
    
            $result = mysql_query("select * from lavato_keys where hash = '$hash'")
                or die("Failed to connect query database ".mysql_error());
    
            $row = mysql_fetch_array($result);
    
    
            if ($row['hash'] == NULL)
            {
                echo "nyet";
            } elseif ($row['hash'] == $hash) {
                echo "Szavazz!";
                
            }
        }

       

?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>

