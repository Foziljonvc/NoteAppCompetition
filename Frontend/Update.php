<?php if (isset($_GET['edit'])): ?>
    <form action="index.php" method="POST">
        <input type="text" name="update" class="form-control" placeholder="Enter the Update text">
        <input type="hidden" name="update_id" value="<?php echo $_GET['edit'] ?>">
        <button type="submit" class="btn btn-success"> Update </button>
    </form>
<?php endif; ?>