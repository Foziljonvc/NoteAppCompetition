<form method="POST" , action="index.php">
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
            <?php
                include "Frontend/algorithm.php"
            ?>
        </tbody>
    </table>
</form>