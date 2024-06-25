<?php
$page = "index";
include 'db_connection/db.php';
include 'utils/util.php';
include 'model/tasks.php';
include 'template/header.php';
protect();
session_start();
is_user_loggedin();
$_SESSION['id'] = get_current_user();
?>
    <div class="container-fluid bg-warning-subtle bg-success p-2 text-dark bg-opacity-50">
    <h1>Todo List</h1>

    <?php print_user_info(); ?>
    <form action="handlers/add_handler.php" method="POST">
        <input type="text" name="task" placeholder="Enter task">
        <small class="error"><?php echo $_SESSION['task_error'] ?? '';
            unset($_SESSION['task_error']); ?></small>
        <input type="hidden" value="add_task" name="action">
        <button type="submit">Add Task</button>
    </form>
    <!--// Display logged-in user's tasks-->
    <?php
    ?>
    <div class="task-wrapper">
        <div class="completed-tasks task-width">
            <h3 class="text-align-center">Completed Task</h3>
            <?php
            $newCompleted = get_tasks(1);
            if (count($newCompleted) > 0) {
                foreach ($newCompleted as $row) {
                    include './template/singlePrint.php';
                }
            } else {
                echo "no Task";
            }
            ?>
        </div>
        <!--        THE CODE IS HERE IN-COMPLETED TASKS    -->

        <div class="incompleted-tasks task-width">
            <h3 class="text-align-center">In-Completed Task</h3>
            <?php
            $isNotCompleted = get_tasks(0);
            if (count($isNotCompleted) > 0) {
                foreach ($isNotCompleted as $row) {
                    include './template/singlePrint.php';
                }
            } else {
                echo "no Task";
            }
            ?>
        </div>
    </div>

<?php
include 'template/footer.php';








