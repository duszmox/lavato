<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sikeresen szavaztál</title>
</head>
<body>
<script>
Swal.fire(
        'Sikeres szavazás!',
        'Szavazatod elmentésre került!',
        'success'
      ).then((result) => {
        if (result.value) {
            window.location.href = "/lavato/";
      }});
</script>
</body>
</html>
