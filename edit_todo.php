<?php
require "config/config.php";
require "config/db.php";

if (isset($_POST["submit"])) {
 $update_id   = mysqli_real_escape_string($conn, $_POST["update_id"]);
 $update_todo = mysqli_real_escape_string($conn, $_POST["todo"]);

 $query = "UPDATE todos SET
              todo = '$update_todo'
              WHERE id = $update_id";

 if (mysqli_query($conn, $query)) {
  header("Location: " . ROOT_URL . "");
 } else {
  echo "Error " . mysqli_error($conn);
 }
}

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
                <input type="text" placeholder="Add Tasks" name="todo" value="<?php echo $todos[0]["todo"]; ?>">
                <input type="hidden" name="update_id" value="<?php echo $todos[0]["id"]; ?>">
                <input type="submit" id="push" class="submit" value="Edit Task" name="submit">
            </form>
        </div>
</div>

<?php require "include/footer.php"; ?>