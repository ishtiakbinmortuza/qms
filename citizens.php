<?php
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit();
}
include 'db.php'; // database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Citizen Management | Qamarshan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <!-- Navbar -->
  <header>
    <nav>
      <div class="logo">Qamarshan</div>
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <h1>Citizen Management (Admin Panel)</h1>

    <!-- Add Citizen Form -->
    <section class="form-section">
      <h2>Add New Citizen</h2>
      <form action="add_citizen.php" method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="national_id" placeholder="National ID" required>
        <button type="submit">Add Citizen</button>
      </form>
    </section>

    <!-- Citizens Table -->
    <section class="table-section">
      <h2>All Citizens</h2>
      <table border="1">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>National ID</th>
          <th>Actions</th>
        </tr>

        <?php
        $result = mysqli_query($conn, "SELECT * FROM citizens");
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['email']}</td>
              <td>{$row['national_id']}</td>
              <td>
                <a href='edit_citizen.php?id={$row['id']}'>Edit</a> |
                <a href='delete_citizen.php?id={$row['id']}' onclick=\"return confirm('Are you sure?');\">Delete</a>
              </td>
            </tr>";
        }
        ?>
      </table>
    </section>
  </main>
</body>
</html>
