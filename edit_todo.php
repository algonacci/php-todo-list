<?php
require "config/config.php";
require "config/db.php";

$id     = mysqli_real_escape_string($conn, $_GET["id"]);
$query  = "SELECT * FROM todos WHERE id = " . $id;
$result = mysqli_query($conn, $query);
$todos  = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<?php include "include/header.php"; ?>

<div class="container">
    <h1>To Do List</h1>
        <div id="newtask">
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
                <input type="text" placeholder="Add Tasks" name="todo">
                <input type="submit" id="push" class="submit" value="Submit" name="submit">
            </form>
        </div>
    <div id="tasks">
        <?php $counter = 1; ?>
        <?php foreach ($todos as $todo): ?>
            <h3 class="card">
                <p class="todo"><?php echo $counter . " " . $todo["todo"]; ?></p>
                <button>Edit</button>
                <button>Delete</button>
            </h3>
            <?php $counter++; ?>
        <?php endforeach; ?>
    </div>
</div>

<?php require "include/footer.php"; ?>