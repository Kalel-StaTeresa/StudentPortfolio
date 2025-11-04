<?php
// database connection
$host = "localhost";
$port = "5432";
$dbname = "portfolio";
$db_user = "Sol";
$db_pass = "dkstbsu";

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE resume_db WITH ENCODING='UTF8' TEMPLATE=template0;");
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'already exists') === false) {
        die("Database creation error: " . $e->getMessage());
    }
}

//Connect to main database
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to resume_db: " . $e->getMessage());
}

//Create resume_content table if it doesn't exist
$pdo->exec("
CREATE TABLE IF NOT EXISTS resume_content (
    id SERIAL PRIMARY KEY,
    contacts TEXT,
    personal_info TEXT,
    introduction TEXT,
    education TEXT,
    skills TEXT,
    projects TEXT
);
");

//initial data
$stmt = $pdo->query("SELECT COUNT(*) FROM resume_content");
if ($stmt->fetchColumn() == 0) {
    $pdo->exec("
        INSERT INTO resume_content (contacts, personal_info, introduction, education, skills, projects)
        VALUES (
            'Address: F.Alix St. Brgy. 6 Nasugbu, Batangas | Email: davidkalelstateresa@gmail.com | Contact: 09954953990',
            'Date of Birth: January 8 2005 | Place of Birth: Mandaluyong City, Manila | Civil Status: Single | Field of Specialization: BS Computer Science',
            'A passionate Computer Science student interested in AI, Robotics, and Game Development.',
            'Elementary: Nasugbu West Central School (2017) | Secondary: Batangas State University - ARASOF (2023)',
            'Programming, Game Development, Robotics, Artificial Intelligence',
            'Project A: Game Prototype | Project B: AI Research'
        );
    ");
}

//Create users table if not exists
$pdo->exec("
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);
");

//default admin
$stmt = $pdo->query("SELECT COUNT(*) FROM users");
if ($stmt->fetchColumn() == 0) {
    $hashedPassword = password_hash('admin123', PASSWORD_BCRYPT);
    $pdo->prepare("INSERT INTO users (username, password) VALUES ('admin', :pass)")
        ->execute(['pass' => $hashedPassword]);
}

?>
