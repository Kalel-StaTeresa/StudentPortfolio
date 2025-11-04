<?php
include('db.php');
session_start();

// Fetch resume content
$stmt = $pdo->query("SELECT * FROM resume_content LIMIT 1");
$resume = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
  <title>David Kalel Sta. Teresa | Resume</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body { background: #f0f4f8; }
    .resume-container { max-width: 900px; margin: 50px auto; background: white; padding: 40px; border-radius: 15px; box-shadow: 0 0 10px rgba(0,0,0,0.1);}
    .edit-btn { float: right; }
  </style>
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
    <a href="login.php" class="btn btn-primary edit-btn">Edit</a>
  </div>
</body>
</html>
