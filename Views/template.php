<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
        .image
        {
            width: 10em;
            height: 8em;
            
        }
    </style>
<body>
    <header class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <div class="container">
            <img src="<?= '/img.png' ?>" alt="" class="img-fluid image">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a href="/niveau/" class="nav-link active" title="Afficher la page d'accueil">
                            <i class="bi-house-fill"></i>
                            BREUKH SCHOOL
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost:8000/Inscription/" class="nav-link active" title="Cliquer pour ajouter un éléve">
                        <i class="bi bi-person-add"></i>
                           Ajouter un éléve
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost:8000/Discipline/gestion/" class="nav-link active" title="Afficher l'interface des disciplines">
                        <i class="bi bi-book"></i>
                           Discipline
                        </a>
                    </li>
                <li class="nav-item">
                        <a href="http://localhost:8000/Annee/allYear/" class="nav-link active" title="Afficher l'interface des années scolaires">
                        <i class="bi bi-calendar-check"></i>
                            Annee scolaire
                        </a>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="dropdownYear" role="button" data-bs-toggle="dropdown" aria-expanded="false" title = "Année actuelle">
                            <?php echo $currentYear[0]["libelle"]; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownYear">
                              <?php foreach ($years as $value): ?>
                                <li>
                                    <form action="http://localhost:8000/Niveau/updateYear/" method="post">
                                        <input type="hidden" value="<?php echo $value['id_annee']; ?>" name="yearchoose">
                                        <button type="submit" class="dropdown-item"><?php echo $value['libelle']; ?></button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="http://localhost:8000/" class="nav-link" title="Se déconnecter">
                            <i class="bi-power"></i>
                            Se déconnecter
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
</body>

</html>
