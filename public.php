<?php
require 'db.php';

// Get ID from URL
$id = $_GET['id'] ?? 1;

// Fetch resume content
$stmt = $pdo->prepare("SELECT * FROM resume_content WHERE id = ?");
$stmt->execute([$id]);
$resume = $stmt->fetch(PDO::FETCH_ASSOC);

// If not found
if (!$resume) {
  echo "<h2>Resume not found.</h2>";
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Public View</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="resume-container">
    <h2 class="text-primary">David Kalel Sta. Teresa</h2>
    <p><?= nl2br($resume['contacts']) ?></p>
    <hr>
    <h5>Personal Information</h5>
    <p><?= nl2br($resume['personal_info']) ?></p>
    <h5>Introduction</h5>
    <p><?= nl2br($resume['introduction']) ?></p>
    <h5>Education</h5>
    <p><?= nl2br($resume['education']) ?></p>
    <h5>Skills</h5>
    <p><?= nl2br($resume['skills']) ?></p>
    <h5>Projects</h5>
    <p><?= nl2br($resume['projects']) ?></p>
</body>
</html>
