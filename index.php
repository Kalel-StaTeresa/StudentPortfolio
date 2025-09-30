<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$student_name = "David Kalel D. Sta. Teresa";
$course = "Bachelor of Science in Computer Science";
$school = "Batangas State University";
$email = "davidkalelstateresa@gmail.com";
$about = "I am passionate about technology and programming. This portfolio highlights my academic background, skills, and projects.";
$skills = ["C++", "Java", "PHP", "HTML/CSS", "Database Management"];
$projects = [
    ["title" => "Student Portfolio Website", "desc" => "Developed a PHP-based portfolio site."]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $student_name; ?> - Portfolio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f4f4; color: #333; }
        header { background: #2c3e50; color: white; padding: 20px; text-align: center; }
        section { padding: 20px; max-width: 900px; margin: auto; background: white; margin-top: 20px; border-radius: 10px; }
        h2 { color: #2c3e50; }
        ul { list-style: none; padding: 0; }
        ul li { padding: 5px 0; }
        .project { margin-bottom: 15px; }
        footer { text-align: center; padding: 15px; margin-top: 20px; background: #2c3e50; color: white; }
    </style>
</head>
<body>
    <header>
        <h1><?php echo $student_name; ?></h1>
        <p><?php echo $course; ?> | <?php echo $school; ?></p>
        <p>Email: <?php echo $email; ?></p>
    </header>

    <section>
        <h2>About Me</h2>
        <p><?php echo $about; ?></p>
    </section>

    <section>
        <h2>Skills</h2>
        <ul>
            <?php foreach($skills as $skill) { echo "<li>$skill</li>"; } ?>
        </ul>
    </section>

    <section>
        <h2>Projects</h2>
        <?php foreach($projects as $project) { ?>
            <div class="project">
                <h3><?php echo $project["title"]; ?></h3>
                <p><?php echo $project["desc"]; ?></p>
            </div>
        <?php } ?>
    </section>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> <?php echo $student_name; ?> | Student Portfolio</p>
    </footer>
</body>
</html>
