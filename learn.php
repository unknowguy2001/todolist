<?php include 'connect.php';
if (!empty($_POST['tasks'])) {
  $sql = "INSERT INTO taskdata (tasks) VALUES (:tasks)";
  $conn->prepare($sql)->execute(array("tasks" => $_POST['tasks']));
  header('location: learn.php');
}

if (!empty($_GET['taskid'])) {
  $conn->prepare("DELETE FROM taskdata WHERE taskId=?")->execute([$_GET['taskid']]);
}

try {

  $sql = 'SELECT *
          FROM taskdata
            ORDER BY taskId';

  $data = $conn->query($sql);
  $data->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Could not connect to the database $dbname :" . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LEARNING PHP</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <style>
    form {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    input {
      width: 30rem;
    }

    main {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .content {
      width: 50rem;
      height: 5rem;
      border: 2px solid white;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 2rem;
      margin-top: 3rem;
      padding: 1rem;
    }

    svg {
      cursor: pointer;
    }
  </style>
</head>

<body>
  <main>
    <h1>TO-DO-LIST</h1>
    <form action="learn.php" method="POST">
      <label for="task">TASKS</label>
      <input type="text" id="task" name="tasks">
      <button type="submit">ADD</button>
    </form>

    <?php while ($row = $data->fetch()) : ?>
      <div class="content">
        <p><?php echo htmlspecialchars($row['tasks']) ?></p>
        <div class="btn">
          <a href="learn.php?taskid=<?php echo $row["taskId"]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
            </svg></a>
          <a href="edit.php?taskid=<?php echo $row["taskId"]; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
            </svg></a>
        </div>

      </div>
    <?php endwhile; ?>
  </main>
</body>

</html>