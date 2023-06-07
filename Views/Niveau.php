<?php require "../Views/template.php"; ?>

<br>
<br>
<br>
<br>
<br>
<br>
<main class="main-home">
    <div class="container">
        <div class="fs-1 ps-1 mw-100" id="addButton" data-bs-toggle="modal" data-bs-target="#addModal">+</div> 
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-md-8">
                <h2 class="text-primary text-uppercase text-center fw-bold pt-3">Ajouter une nouvelle année scolaire</h2>
                <form action="http://localhost:8000/Niveau/addnewLevel/" method="post" class="d-flex justify-content-between">
                    <input type="text" name="NewLevel" class="form-control" placeholder="Entrez la nouvelle année scolaire" required>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
                
                <hr>
                <h1 class="text-primary text-uppercase text-center fw-bold pt-3">Liste des Niveaux</h1>
                <ul class="list-group pd-2">
                    <?php foreach ($level as $key => $value) : ?>
                        <li class="list-group-item fs-4 d-flex justify-content-between">
                            <a href="/Niveau/classe/<?php echo $value['id_GNiveau']; ?>" class="text-decoration-none text-dark mw-100 d-flex justify-content-between w-100" >
                                <span class="fs-1"><?php echo $value["libelleGN"] ?></span>
                                <button type="btn" class="btn btn-success" >View</button>
                            </a>
                            <a href="/Annee/classe/<?php echo $value['id_GNiveau']; ?>" class="text-decoration-none text-dark mw-100 d-flex justify-content-between w-20 ps-2" data-bs-toggle="modal" data-bs-target="#addModal">
                                <button type="btn" class="btn btn-danger">Archiver</button>
                            </a>
                            <a href="/Annee/classe/<?php echo $value['id_GNiveau']; ?>" class="text-decoration-none text-dark mw-100 d-flex justify-content-between w-20 ps-2" data-bs-toggle="modal" data-bs-target="#addModal">
                                <button type="btn" class="btn btn-danger">Modifier</button>
                            </a>

                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
    </div>
</main>

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
                <form action="http://localhost:8000/niveau/updateYear/" method="post">
                    <div class="mb-3">
                        <label for="inputNom" class="form-label">Niveau</label>
                        <input type="text" class="form-control" id="inputNom" name="yearUpdate" placeholder="Entrez le nom du niveau à ajouter">
                        <button type="submit" class="btn btn-primary">Ajouter   </button>
                    </div>
                    <!-- Ajoutez d'autres champs de formulaire ici -->
                </form>
            </div>


</body>

</html> 
