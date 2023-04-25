<?php require_once 'header.php'; ?>
<br>
<h3>Posts</h3>
<br>
<?php
if (isset($_SESSION['postdelete']) && $_SESSION['postdelete'] == "true") {
    echo '<div class="alert alert-success">Post is successfully deleted.</div>';
    unset($_SESSION['postdelete']);
}
?>
<?php
if (isset($_SESSION['postupdate']) && $_SESSION['postupdate'] == "true") {
    echo '<div class="alert alert-success">Post is successfully updated.</div>';
    unset($_SESSION['postupdate']);
}
?>
<?php
if (isset($_SESSION['postadded']) && $_SESSION['postadded'] == "true") {
    echo '<div class="alert alert-success">Post is successfully added.</div>';
    unset($_SESSION['postadded']);
}
?>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Post Title</th>
            <th>Post Author</th>
            <th>Post Date</th>
            <th>View Post</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php

        // Her bir kayıt için post-preview HTML bloğu oluşturma
        while ($row = $stmt_user->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_seo_url = $row['post_seo_url'];
        ?>

            <tr>
                <td><?php echo $post_title; ?></td>
                <td><?php echo $post_author; ?></td>
                <td><?php echo $post_date; ?></td>
                <td><a target="_blank" href="http://www.<?php echo $_SERVER['HTTP_HOST']; ?>/<?php echo $post_seo_url; ?>"><button class="btn btn-success btn-sm">View</button></a></td>
                <td>
                    <form action="" method="POST">
                        <button type="submit" name="postdelete" value="<?php echo $post_id; ?>" class="btn btn-danger btn-sm">Delete</button>
                        <a href="edit.php?post_id=<?php echo $post_id; ?>"><button type="button" class="btn btn-dark btn-sm">Edit</button></a>
                    </form>


                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>






</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/Turkish.json"
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>