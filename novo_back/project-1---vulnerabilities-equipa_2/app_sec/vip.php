<?php include "header.php"; ?>
<?php include "db.php"; ?>
<?php include "functions.php"; ?>

<?php
/* at the top of 'check.php' */
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SESSION['user_type'] != 'admin') {
//if ( $_SERVER['REQUEST_METHOD']=='POST' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    /*
       Up to you which header to send, some prefer 404 even if
       the files does exist for security
    */
    header('HTTP/1.0 403 Forbidden', TRUE, 403);

    /* choose the appropriate page to redirect users */
    die(header('location: /error.php'));

}

echo $_SESSION['user_session'];


?>

    <h3> Esta informação é confidencial: </h3>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Data</th>
            <th scope="col">Promoção</th>
            <th scope="col">Informação pública?</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td scope="col"> 23/11/2021</td>
            <td scope="col"> 45%</td>
            <td scope="col"> Sim</td>
        </tr>
        <tr>
            <td scope="col"> 24/11/2021</td>
            <td scope="col"> 5%</td>
            <td scope="col"> Não</td>
        </tr>
        <tr>
            <td scope="col"> 8/12/2021</td>
            <td scope="col"> 45%</td>
            <td scope="col"> Não</td>
        </tr>
        <tr>
            <td scope="col"> 4/1/2022</td>
            <td scope="col"> 70%</td>
            <td scope="col"> Sim</td>
        </tr>
        </tbody>
    </table>

<?php include "footer.php"; ?>