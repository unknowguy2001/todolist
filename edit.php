<?php
include 'connect.php';
if (!empty($_POST['editbox'])) {
  $data = [
    'editbox' => $_POST['editbox'],
    'taskid' => $_POST['taskid']
  ];
  $sql = "UPDATE taskdata SET tasks =:editbox WHERE taskId =:taskid";
  $conn->prepare($sql)->execute($data);
  header('Location: learn.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css" />
  <style>
    * {
      box-sizing: border-box;
    }

    a {
      text-decoration: none;
      color: blue;
      border: 1px solid;
      padding: 1rem;
      display: inline-block;
    }

    a:hover {
      color: red;
    }

    button {
      padding: 1rem;
      color: black;
      background-color: green;
      display: inline-block;
    }

    form {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    button:hover {
      background-color: green;
    }

    input {
      height: 20rem;
      width: 50rem;
    }
  </style>
</head>

<body>
  <form action="edit.php" method="POST">
    <label for="edit">EDIT</label>
    <!-- fetch data from database -->
    <input type="text" id="edit" name="editbox" value="
    <?php $res = $conn->prepare("SELECT tasks FROM taskdata WHERE taskId=?");
    $res->execute([$_GET['taskid']]);
    $task = $res->fetch();
    echo $task['tasks'];
    ?>" />
    <input type="hidden" name="taskid" value="<?php echo $_GET['taskid']; ?>">
    <div>
      <button type="submit">Save</button>
      <a href="learn.php">Cancle</a>
    </div>
  </form>
</body>

</html>