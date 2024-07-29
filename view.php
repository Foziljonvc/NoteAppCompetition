<?php

require "src/Note.php";

$user = new User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['notes'])) {
        $user->addNotes($_POST['notes']);
    }
}

$notes = $user->getAllNotes();

if (empty($notes)) {
    echo "Malumotlar bazasi bo'sh";
    return;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTES APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-4">
        <form method="POST" , action="view.php">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Enter your note" name="notes">
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
        <table class="table mt-4">
            <thead>
                <?php foreach ($notes as $note) : ?>
                    <tr>
                        <th scope="row"><?php
                                        echo $note['id']; ?></th>
                        <td><?php
                            echo $note['notes']; ?></td>
                        <td><?php
                            echo $note['data']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>