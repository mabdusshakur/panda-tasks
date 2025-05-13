<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panda Tasks</title>
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f8f9fa;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1NiIgaGVpZ2h0PSIxMDAiPgo8cmVjdCB3aWR0aD0iNTYiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjBmMGYwIj48L3JlY3Q+CjxwYXRoIGQ9Ik0yOCA2NkwwIDUwTDAgMTZMMjggMEw1NiAxNkw1NiA1MEwyOCA2NkwyOCAxMDAiIGZpbGw9IiNlOGU4ZTgiPjwvcGF0aD4KPC9zdmc+');
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: 3px solid #333;
        }

        h1 {
            color: #333;
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 30px;
            position: relative;
        }

        h1:after {
            content: '🐼';
            position: absolute;
            right: 20px;
            top: 0;
        }

        .task {
            margin: 15px 0;
            padding: 15px;
            background-color: #fff;
            border-radius: 15px;
            border: 2px solid #333;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }

        .task:hover {
            transform: translateX(10px);
            background-color: #f8f9fa;
        }

        .delete-btn {
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            transition: background-color 0.2s;
        }

        .delete-btn:hover {
            background-color: #ff4444;
        }

        .add-form {
            margin-bottom: 30px;
            display: flex;
            gap: 10px;
        }

        input[type="text"] {
            padding: 12px;
            width: 100%;
            border: 2px solid #333;
            border-radius: 20px;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 12px 25px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            font-size: 16px;
            transition: background-color 0.2s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            color: #333;
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 3px solid #333;
        }

        .empty-message {
            text-align: center;
            color: #666;
            font-style: italic;
            margin: 20px 0;
        }

        .task-text {
            font-size: 18px;
            color: #333;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .task:hover .task-text {
            animation: bounce 0.5s ease infinite;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Panda Tasks</h1>

        <?php
        // Initialize the tasks array if it doesn't exist in the session
        session_start();
        if (!isset($_SESSION['tasks'])) {
            $_SESSION['tasks'] = array();
        }

        // Handle form submission to add a new task
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['task']) && !empty($_POST['task'])) {
                $_SESSION['tasks'][] = $_POST['task'];
            }

            // Handle task deletion
            if (isset($_POST['delete'])) {
                $index = $_POST['delete'];
                if (isset($_SESSION['tasks'][$index])) {
                    unset($_SESSION['tasks'][$index]);
                    $_SESSION['tasks'] = array_values($_SESSION['tasks']); // Reindex array
                }
            }
        }
        ?>

        <!-- Form to add new tasks -->
        <form class="add-form" method="POST">
            <input type="text" name="task" placeholder="🐼 Add a new task..." required>
            <input type="submit" value="Add Task">
        </form>

        <!-- Display tasks -->
        <h2>My Tasks 🎋</h2>
        <?php if (empty($_SESSION['tasks'])): ?>
            <p class="empty-message">No tasks yet! Time to add some bamboo... I mean, tasks! 🐼</p>
        <?php else: ?>
            <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
                <div class="task">
                    <span class="task-text"><?php echo htmlspecialchars($task); ?></span>
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="delete" value="<?php echo $index; ?>">
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>