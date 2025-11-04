<?php
session_start();
require 'db.php';

// Check login
if (!isset($_SESSION['user'])) {
  header("Location: login.php");
  exit();
}

// Fetch existing data
$stmt = $pdo->query("SELECT * FROM resume_content LIMIT 1");
$resume = $stmt->fetch(PDO::FETCH_ASSOC);

// Update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $contacts = $_POST['contacts'];
  $personal_info = $_POST['personal_info'];
  $introduction = $_POST['introduction'];
  $education = $_POST['education'];
  $skills = $_POST['skills'];
  $projects = $_POST['projects'];

  // If record exists → update; if not → insert
  if ($resume) {
    $stmt = $pdo->prepare("UPDATE resume_content 
      SET contacts=?, personal_info=?, introduction=?, education=?, skills=?, projects=?");
    $stmt->execute([$contacts, $personal_info, $introduction, $education, $skills, $projects]);
  } else {
    $stmt = $pdo->prepare("INSERT INTO resume_content 
      (contacts, personal_info, introduction, education, skills, projects)
      VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$contacts, $personal_info, $introduction, $education, $skills, $projects]);
  }

  $success = "Resume updated successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Resume</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="edit-container">
    <h2>Edit Resume Content</h2>
    <?php if (isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

    <form method="POST">
      <label>Contacts</label>
      <textarea name="contacts"><?= htmlspecialchars($resume['contacts'] ?? '') ?></textarea>

      <label>Personal Information</label>
      <textarea name="personal_info"><?= htmlspecialchars($resume['personal_info'] ?? '') ?></textarea>

      <label>Introduction</label>
      <textarea name="introduction"><?= htmlspecialchars($resume['introduction'] ?? '') ?></textarea>

      <label>Education</label>
      <textarea name="education"><?= htmlspecialchars($resume['education'] ?? '') ?></textarea>

      <label>Skills</label>
      <textarea name="skills"><?= htmlspecialchars($resume['skills'] ?? '') ?></textarea>

      <label>Projects</label>
      <textarea name="projects"><?= htmlspecialchars($resume['projects'] ?? '') ?></textarea>

      <button type="submit">Save Changes</button>
      <a href="index.php" class="btn">Back to Resume</a>
    </form>
  </div>
</body>
</html>
