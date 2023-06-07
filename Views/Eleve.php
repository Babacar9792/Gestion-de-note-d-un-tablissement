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
            <form action="http://localhost:8000/Classe/inscription/" method="post" class="form-container" >
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
                            <span   id="messError1"></span>
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
                                <option value="Interne" >Interne</option>
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
<main class="main-home">
    <div class="container mt-3">
        <div class="row justify-content mt-4">
            <div class="col-sm-10 mt-3 ">
                <div class="text-center mb-4 mt-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStudentModal">Ajouter un élève</button>
                </div>
                <table class="table table-bordered table-hover mt-3">
                    <caption class="text-primary text-uppercase text-center fs-1 fw-bold caption-top">
                        <strong>Liste des élèves</strong>
                    </caption>
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">Numero</th>
                            <th scope="col">Prénoms</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Date de naissance</th>
                            <th scope="col">Lieu de naissance</th>
                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($student as $value) : ?>
                            <tr>
                                <td scope="row" class="text-center"><?php echo $value["numero"]; ?></td>
                                <td class="text-center"><?php echo $value["prenom"]; ?></td>
                                <td class="text-uppercase text-center"><?php echo $value["nom"]; ?></td>
                                <td class="text-center"><?php echo $value["dateNaissance"]; ?></td>
                                <td class="text-center"><?php echo $value["lieuNaissance"]; ?></td>
                                <td class="text-center"><?php echo $value["statutEleve"]; ?></td>
                                <td><!-- Ajoutez la colonne manquante ici --></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
