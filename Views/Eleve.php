<?php require "../Views/template.php"; ?>

<!-- Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Ajouter un élève</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="http://localhost:8000/Classe/inscription/" method="post" class="form-container">
                    <div class="row mb-3">
                        <input type="hidden" name="idEleve" class="form-control input-nom" value="idEleve">
                        <div class="col">
                            <label for="">Nom:</label>
                            <input type="text" name="nom" class="form-control input-nom" placeholder="Nom" aria-label="Nom" id="nom" required>
                        </div>
                        <div class="col">
                            <label for="">Prénom:</label>
                            <input type="text" name="prenom" class="form-control input-prenom" placeholder="Prénom" aria-label="Prénom" id="prenom" required>
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
                                <input type="radio" class="form-check-input" name="sexe" id="garcon" value="garcon">
                                <label class="form-check-label" for="garcon">Garçon</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="sexe" id="fille" value="fille" checked>
                                <label class="form-check-label" for="fille">Fille</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="">Niveau:</label>
                            <select class="form-select" id="niveau" name="statut">
                                <option value="Interne">Interne</option>
                                <option value="Externe">Externe </option>

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
</div>
<br><br><br><br>
<main class="main-home d-flex flex-column justify-content-center align-items-center  ">
    <div class="container mt-3  d-flex justify-content-center  mw-100">
        <div class="row justify-content-center mt-4 w-75 d-flex">
            <div class="col-sm-10 mt-3 ">
                <div class="text-center mb-4 mt-4 text-success d-flex justify-content-end">
                    <!-- <i class="bg-primary" ></i> -->
                    <i class="bi bi-file-plus" data-bs-toggle="modal" data-bs-target="#addStudentModal">Ajouter un élève</i>
                </div>
                <div class="w-100 d-flex flex-column align-items-center justify-content-around mt-3 fs-4">
                    <div> <strong> <?php echo $maClasse ?><span>(<?php echo $currentYear[0]["libelle"]; ?>)</span> </strong> </div>
                    <div> <strong>effectif : <?php echo $effectif[0]["total"] ?> </strong> </div>
                    <div> <strong> Moyenne classe: 13 </strong> </div>

                </div>
                <div class=" w-100 d-flex justify-content-between align-items-center  h-1000 p-3">
                    <div class="d-flex">
                        <a href="/niveau/classe/<?= $level ?>" type="button" class="btn btn-success ms-2">Retour</a>
                        <a type="button" class="btn btn-warning ms-2" href="/Coefficient/Coefficient/<?php echo $mar ?>">Coef</a>

                    </div>
                    <div class="d-flex">

                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <label for="">Discipline</label>
                            <select name="" class="form-select" id="discipline">
                                <option value="">Choisir une dicipline</option>
                                <?php foreach ($discipline as  $d) : ?>

                                    <option value="<?php echo $d["id_dis"] ?>"> <?php echo $d["libelle_discipline"]; ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>
                        <div type="" class=" ms-2 d-flex flex-column justify-content-center align-items-center">
                            <label for="">Semestre</label>
                            <input type="button" value="Semestre1" class="btn bg-primary btn-light" disabled>
                        </div>
                        <div type="button" class=" ms-2">
                            <label for="">Note de </label>
                            <select name="" id="noteChoisie" class="form-select">
                                <option value="">choisir</option>
                                <option value="noteressource">Ressource</option>
                                <option value="noteExamen">Examen</option>
                            </select>
                        </div>

                    </div>
                </div>
                <table class="table table-bordered table-hover mt-3">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">--</th>
                            <th scope="col">Prénoms</th>
                            <th scope="col">Nom</th>

                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($student as $value) : ?>
                            <tr>
                                <td scope="row" class="text-center">
                                    <!-- <div class="col-2">
                                        <picture>
                                            <source srcset="<?php $value['image'] ?>" type="image/svg+xml">
                                            <img src="<?php $value['image'] ?>" alt="...">
                                        </picture>
                                    </div> -->
                                </td>

                                <td class="text-center"><?php echo $value["prenom"]; ?></td>
                                <td class="text-uppercase text-center"><?php echo $value["nom"]; ?></td>
                                <td class="text-center"><?php echo $value["statutEleve"]; ?></td>
                                <td class="d-flex noteEleve d-none"> <input type="number" min = "0" class="inputNote" form-data="<?php echo $value["id_inscription"]; ?>">
                                    <span>/</span>
                                    <span class="noteMaximale"></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-success btn-update">Mettre à jour</button>
                </div>
                <button class="btn btn-primary autoloader d-none" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <div>
                    <input type="hidden" name="" class="maximale">
                </div>

            </div>
        </div>
    </div>
</main>


<script src="<?= '/eleve.js' ?>"></script>