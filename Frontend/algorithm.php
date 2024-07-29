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
                <a href="index.php?id=<?php echo $note['id']; ?>" class="btn btn-danger"><i class="bi bi-trash3-fill"></i>  Delete</a>
            </td>
            <td>
                <a href="index.php?edit=<?php echo $note['id']; ?>" class="btn btn-danger"><i class="bi bi-pencil-fill"></i>  Edit</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php endif; ?>