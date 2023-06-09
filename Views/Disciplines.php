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
            margin-top: 100px;
            padding: 20px;
            max-width: 2000px;
            margin-left: auto;
            margin-right: auto;

        }
    </style>
</head>

<body>

    <div class="container">
        <a href="/niveau/"><Button  class="text-light bg-success">Retour</Button></a>
        <h1 class="text-center mb-4">Gestion des disciplines</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="#" method="post" class="form-container">

                    <div class="row mb-4 d-flex justify-content-between">
                        <div class="col">
                            <label for="">Niveau:</label>
                            <select class="form-select" id="Disciplineniveau" name="id_niveau">
                                <option value="choisir">Choisir un niveau</option>
                            <?php foreach ($level as $value) : ?>
                                   <option value="<?php echo $value['id_GNiveau'] ?>">
                                     <?php echo $value['libelleGN'] ?>
                                   </option>
                               <?php endforeach ?>

                            </select>
                        </div>
                        <div class="col">
                            <label for="">Classe:</label>
                            <select class="form-select" id="ClasseNew" name="id_classe">

                        
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4 d-flex justify-content-between">
                        <div class="col">
                            <label for="">Groupe de discipline:</label>
                            <select class="form-select" id="GDiscipline" name="id_niveau">
                            <option value=""></option>
                                <option value="nouveau"> Nouveau </option>
                                <?php foreach ($Gdiscilpline as $value) : ?>
                                   <option value="<?php echo $value['id_GroupeDiscipline'] ?>">
                                       <?php echo $value['libelle_GroupeDiscipline'] ?>
                                   </option>
                               <?php endforeach ?>

                                
                            </select>
                        </div>
                        <div class="col ">
                            <label for="">Discipline:</label>
                            <input type="text" id="newdiscipline">
                        </div>
                        <div class="col-md-1 text-center">
                            <button type="button" class="btn btn-primary" id="buttonOk">Ok</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <hr>
        <h6 class="text-danger">Decocher une discipline pour la supprimer de la classe</h6>
        <h5>Les disciplines de la classe de <a href= "/coefficient/coefficient/" class="nomClasse text-success"></a></h5>
        <span class="text-danger position-absolute top-85 start-50 translate-middle" id="messError"></span>
        <div class="col mb-4 d-flex justify-content-around  disciplinecheck flex-wrap" >
            
        </div>
        <div class="row justify-content-end">
            <a class="col-md-6 text-center">
                <button type="submit" class="btn btn-primary" id="inscription">Metrre à jour</button>
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Nouveau groupe de discipline</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="newDisciplineGroup">Nom du groupe de discipline:</label>
                    <input type="text" class="form-control" id="newDisciplineGroup">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary" id="submitNewDisciplineGroupe">Enregistrer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Attendre que le DOM soit entièrement chargé
        document.addEventListener("DOMContentLoaded", function() {
          // Sélectionner le menu déroulant du groupe de discipline
          var groupeDiscipline = document.querySelector("#GDiscipline");

          // Ajouter un écouteur d'événement pour le changement de valeur du menu déroulant
          groupeDiscipline.addEventListener("change", function() {
            // Vérifier si la valeur sélectionnée est "nouveau"
            if (groupeDiscipline.value === "nouveau") {
              // Afficher le modal
              var modal = new bootstrap.Modal(document.getElementById("addModal"));
              modal.show();
            }
          });
        });
    </script>
    <script src="<?= '/app2.js' ?>"></script>
</body>

</html>

