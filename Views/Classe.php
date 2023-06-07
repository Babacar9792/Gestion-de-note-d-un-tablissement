<?php require "../Views/template.php"; ?>

<main class="main-home">
    <div class="container">
        <div class="row">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </div>
        <div class="row justify-content-center">
            <div class="fs-1 ps-1 mw-100" id="addButton" data-bs-toggle="modal" data-bs-target="#addModal">+</div> 
            <div class="col-xxl-10 col-md-8">
                <h2 class="text-primary text-uppercase text-center fw-bold">Ajouter une nouvelle classe</h2>
                <form action="http://localhost:8000/Classe/Ajouter" method="post" class="d-flex justify-content-between">
                    <input type="text" name="newClasse" class="form-control" placeholder="Entrez la nouvelle classe" required>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                <h1 class="text-primary text-uppercase text-center fw-bold">Liste des Classes</h1>
                <ul class="list-group pd-2">
                    <?php foreach($classes as $value):?>
                    <li class="list-group-item fs-4 d-flex justify-content-between">
                        <a href="/classe/Liste/<?php echo $value['id_classe']; ?>" class="text-decoration-none text-dark mw-100 d-flex justify-content-between w-80">
                            <span class="fs-1"><?php echo $value["libelle_classe"] ?></span>
                            <button type="btn" class="btn btn-primary">View</button>
                        </a>
                        <a href="/classe/archiver/<?php echo $value['id_classe']; ?>" class="text-decoration-none text-dark mw-100 d-flex justify-content-between w-20">
                            <button type="btn" class="btn btn-danger">Archiver</button>
                        </a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Modal d'ajout -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Ajouter un nouvel élément</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire d'ajout -->
                    <form action="http://localhost:8000/classe/addNewRoom/" method="post">
                        <div class="mb-3">
                            <label for="inputNom" class="form-label">Niveau</label>
                            <input type="text" class="form-control" id="inputNom" name="NewClasse" placeholder="Entrez le nom du niveau à ajouter">
                            <!-- <input type="hidden" name="idLevel" value = > -->
                        </div>
                        <!-- Ajoutez d'autres champs de formulaire ici -->
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
