<?php

require "vendor/autoload.php";

$user = new Note();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['notes'])) {
        $user->addNotes($_POST['notes']);
    } elseif (isset($_POST['update'])) {
        $user->updateNote($_POST['update'], $_POST['update_id']);
    }
    header('Location: view.php');
    exit();
}

if (isset($_GET['id'])) {
    $user->deleteNote($_GET['id']);
}

$notes = $user->getAllNotes();

?>

<!DOCTYPE html>
<html lang="en">
<?php
    include "Frontend/Head.php";
?>
<body>
    <div class="container mt-4">
        <?php
            include "Frontend/Forma.php";
        ?>
        <?php
            include "Frontend/Update.php";
        ?>
    </div>
</body>
<?php
    include "Frontend/Footer.php";
?>
</html>