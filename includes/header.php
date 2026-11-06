<?php
$base = '';
$page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portfolio Fransiska Nada S. (125103074)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="w-100">
        <nav class="navbar navbar-expand-lg shadow-sm sticky-top" style="background-color: #C9D4C6;">
            <div class="container-fluid px-4 px-lg-5">
                <a class="navbar-brand fw-bold" href="index.php#about" style="color: #4F5D4E;">
                        Fransiska Nada S<span style="color: #4F5D4E;">.</span>
                </a>

                <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarMenu"
                    aria-controls="navbarMenu"
                    aria-expanded="false"
                    aria-label="Buka navigasi">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav ms-auto gap-lg-3">
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page == 'index.php') ? 'active' : ''; ?>" href="index.php#about" style="color: #4F5D4E;">About Me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#skills" style="color: #4F5D4E;">Skills</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#projects" style="color: #4F5D4E;">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#education" style="color: #4F5D4E;">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#contact" style="color: #4F5D4E;">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($page == 'projects.php') ? 'active' : ''; ?>" href="projects.php" style="color: #4F5D4E;">All Projects</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
