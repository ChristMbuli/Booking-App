<?php


require("../../backend/admin/home/newAction.php");
require("../../backend/admin/actions/tagAction.php");

?>
<form action="" method="post" enctype="multipart/form-data">
    <?php
    if (isset($msgError)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>' . $msgError .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif (isset($msgSuccess)) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>' .  $msgSuccess .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
    } elseif (isset($error)) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i>' . $error .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    ?>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Ville</span>
        <input type="text" class="form-control" name="city" placeholder="Choisir une ville" aria-label="Username"
            aria-describedby="basic-addon1">
        <span class="input-group-text" id="basic-addon2">Quartier</span>
        <input type="text" class="form-control" name="district" placeholder="Chisir un quartier"
            aria-label="Recipient's username" aria-describedby="basic-addon2">
        <span class="input-group-text" id="basic-addon2">@dresse</span>
        <input type="text" class="form-control" name="adress" placeholder="Entrez une adresse précise"
            aria-label="Recipient's username" aria-describedby="basic-addon2">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon2">Surface</span>
        <input type="text" class="form-control" name="surface" placeholder="Surface " aria-label="Recipient's username"
            aria-describedby="basic-addon2">
        <span class="input-group-text" id="basic-addon2">Nombre Chambre</span>
        <input type="text" class="form-control" name="bedroom" placeholder="Chambre" aria-label="Recipient's username"
            aria-describedby="basic-addon2">
        <span class="input-group-text" id="basic-addon2">Nombre personnes</span>
        <input type="number" class="form-control" name="personne" placeholder="personnes"
            aria-label="Recipient's username" aria-describedby="basic-addon2">
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon3">Frais ménage</span>
        <input type="text" class="form-control" placeholder="ménage" name="menage" id="basic-url"
            aria-describedby="basic-addon3">
        <span class="input-group-text" id="basic-addon2">Etage</span>
        <input type="number" class="form-control" name="etage" placeholder="Niveau Etage"
            aria-label="Recipient's username" aria-describedby="basic-addon2">
    </div>
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Loyer" name="rent">
        <span class="input-group-text">&</span>
        <input type="text" class="form-control" placeholder="Caution" name="guaranted">
    </div>
    <div class="input-group mb-4">
        <span class="input-group-text">&</span>
        <select id="select-state" name="tags[]" multiple placeholder="Ajouter les tags" autocomplete="off">
            <option value="">Select a state...</option>
            <?php while ($all = $show->fetch()) { ?>
            <option value="<?= $all['tag'] ?>"><?= $all['tag'] ?></option>
            <?php } ?>
        </select>
    </div>
    <div id="preview" class="mb-3">
        <!-- Afficher les images sélectionnées ici -->
    </div>
    <div class="input-group">
        <input type="file" name="images[]" class="form-control" multiple="multiple" id="images">
    </div>
    <div class="d-grid gap-2 col-6 mx-auto mt-3 mb-5">
        <button class="btn btn-primary" name="ajouter" type="submit">Ajouter</button>
    </div>
</form>


<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

<script>
new TomSelect('select[multiple]', {
    plugins: {
        remove_button: {
            title: 'Supprimer'
        }
    }
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#images').change(function() {
        var files = $(this).prop('files');
        var container = $('#preview');
        container.empty();
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.width = '100px';
            img.style.height = '100px';
            container.append(img);
            container.append('<button type="button" onclick="removeImage(this)">Retirer</button>');
        }
    });
});

function removeImage(button) {
    $(button).prev().remove();
    $(button).remove();
}

const alertList = document.querySelectorAll('.alert')
const alerts = [...alertList].map(element => new coreui.Alert(element))
</script>