<!doctype html>
<html>
<head>
    <title>Equipe</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/cover/">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex h-100  text-white bg-dark">


<div class="cover-container d-flex w-100 h-100 mx-auto flex-column">
    <header>
        <?php include("header.php"); ?>
    </header>

    <main>

        <div class="container px-4 py-5" id="featured-3">
            <h2 class="pb-2 border-bottom">Présentation de l'équipe de développeurs</h2>
            <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                <div class="feature col">
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"></svg>
                    </div>
                    <h2>Mathis BUET-ELFASSY</h2>
                </div>
                <div class="feature col">
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"></svg>
                    </div>
                    <h2>Emilian MITU</h2>
                </div>
                <div class="feature col">
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"></svg>
                    </div>
                    <h2>Mathis</h2>
                </div>
                <div class="feature col">
                    <div class="feature-icon bg-primary bg-gradient">
                        <svg class="bi" width="1em" height="1em"></svg>
                    </div>
                    <h2>Vincent</h2>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</div>



</body>
</html>
