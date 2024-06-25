
<div class="task">
    <div>
        <p><?php echo $row["task"] ?></p>
    </div>
    <div class="actions">
        <form action="../handlers/add_handler.php" method="POST">
            <input type="hidden" name="task_id" value="<?php echo $row['id'] ?>">
            <input type="text" name="task" placeholder="New task">
            <small class="error"><?php echo $_SESSION['update_error'][$row['id']] ?? '';
                unset($_SESSION['update_error'][$row['id']]); ?>
            </small>
            <button type="submit" name="action" value="update">Edit</button>
        </form>
        <?php if ($row['completed'] == 0) :?>
            <a class="del-btn" href=<?php echo "handlers/add_handler.php?action=delete&id=" . $row['id'] ?>>Delete</a>
            <a class="del-btn" href=<?php echo "handlers/add_handler.php?action=markAs&id=" . $row['id'] . '&checked=1' ?>>Mark
                As Completed</a>
        <?php else: ?>
            <a class="del-btn" href=<?php echo "handlers/add_handler.php?action=delete&id=" . $row['id'] ?>>Delete</a>
            <a class="del-btn" href=<?php echo "handlers/add_handler.php?action=markAs&id=" . $row['id'] . '&checked=0' ?>>Mark
                As In-Completed</a>
        <?php endif; ?>


    </div>
</div>

<!--case 'update_task':-->
<!--if (empty($this->data["task"]) || empty($this->data["task_id"])) {-->
<!--$id = isset($this->data["task_id"]) ? $this->data["task_id"] : null;-->
<!--$this->errors['update_task'][$id] = "Update is required";-->
<!--}-->
<!--break;-->
