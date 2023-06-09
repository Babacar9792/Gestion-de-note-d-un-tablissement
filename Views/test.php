<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un élève</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            margin-top: 50px;
            padding: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <a href="/niveau/">
            <button class= "rounded-2 bg-success text-light" >Retour</button>
        </a>
        <h1 class="text-center mb-4">Ajouter un élève</h1>
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80" alt="Image" class="img-fluid rounded-circle">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="http://localhost:8000/Inscription/register/" method="post" class="form-container">
                    <div class="row mb-3">
                        <input type="hidden" name="idEleve" class="form-control input-nom" value="idEleve">
                        <div class="col">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" class="form-control input-nom" placeholder="Nom" aria-label="Nom" id="nom">
                        </div>
                        <div class="col">
                            <label for="">Prénom:</label>
                            <input type="text" name="prenom" class="form-control input-prenom" placeholder="Prénom" aria-label="Prénom" id="prenom">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Date de Naissance:</label>
                            <input type="text" name="dateNais" class="form-control input-dateNais" placeholder="jour-mois-annee" aria-label="Date de Naissance" id="dateNaissance">
                            <span id="messError1"></span>
                        </div>
                        <div class="col">
                            <label for="">Lieu de Naissance:</label>
                            <input type="text" name="naissance" class="form-control input-naissance" placeholder="Lieu de Naissance" aria-label="Lieu de Naissance" id="lieuNaissance">

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Numéro:</label>
                            <input type="text" name="numero" class="form-control input-numero" placeholder="Numéro" aria-label="Numéro" id="numero">
                        </div>
                        <div class="col">
                            <label>Sexe:</label>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="sexe" id="garcon" value="garcon" class="radio">
                                <label class="form-check-label" for="garcon">Garçon</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="sexe" id="fille" value="fille" class="radio" checked>
                                <label class="form-check-label" for="fille">Fille</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Niveau:</label>
                            <select class="form-select" id="niveau" name="id_niveau">
                                <?php foreach ($niveau as $value) : ?>
                                    <a href="Inscription/niveau/<?php echo $value['id_GNiveau'] ?>/">
                                        <option value="<?php echo $value['libelleGN'] ?>"><?php echo $value['libelleGN'] ?></option>

                                    </a>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="">Classe:</label>
                            <select class="form-select" id="ClasseNew" name="id_classe">

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Type:</label>
                            <select class="form-select" id="typeEleve" name="typeEleve">
                                <option value="Interne">Interne</option>
                                <option value="Externe">Externe</option>
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <button type="submit" class="btn btn-primary" id="inscription">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <script src="<?= '/app.js' ?>"></script> -->
    <script src="/app.js"></script>
</body>

</html>