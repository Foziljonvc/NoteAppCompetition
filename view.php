<?php

require "src/Note.php";

$user = new User();

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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTES APP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-4">
        <form method="POST" , action="view.php">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Enter your note" name="notes">
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NOTE</th>
                        <th scope="col">DATA</th>
                        <th scope="col">DELETE</th>
                        <th scope="col">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($notes)): ?>
                        <?php foreach ($notes as $note) : ?>
                            <tr>
                                <th scope="row"><?php echo $note['id']; ?></th>
                                <td>
                                    <?php echo $note['notes']; ?>
                                </td>
                                <td>
                                    <?php echo $note['data']; ?>
                                </td>
                                <td>
                                    <a href="view.php?id=<?php echo $note['id']; ?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i>  Delete</a>
                                </td>
                                <td>
                                    <a href="view.php?edit=<?php echo $note['id']; ?>" class="btn btn-danger"><i class="bi bi-pencil-fill"></i>  Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
        <?php if (isset($_GET['edit'])): ?>
            <form action="view.php" method="POST">
                <input type="text" name="update" class="form-control" placeholder="Enter the Update text">
                <input type="hidden" name="update_id" value="<?php echo $_GET['edit'] ?>">
                <button type="submit" class="btn btn-success"> Update </button>
            </form>
        <?php endif; ?>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>