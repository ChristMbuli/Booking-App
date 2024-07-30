  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Détails Occupation</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, inventore?
                  <small>Nombre des occupants de cette maison est de <strong><?= $personne ?></strong></small>
                  <div class="container d-flex justify-content-center gap-4">
                      <?php
                        // Boucle pour afficher $personne images
                        for ($i = 0; $i < $personne; $i++) {
                            // La lettre de l'alphabet correspondante
                            $letter = chr(65 + $i); // A, B, C, ...
                        ?>
                      <div class="flex-shrink-5">
                          <img class="rounded-circle" src="https://dummyimage.com/100x100/ced4da/63757d.jpg"
                              alt="..." />
                          <p><?= $letter ?></p>
                      </div>
                      <?php } ?>
                  </div>

              </div>
          </div>
      </div>
  </div>
  <style>
/* Ajout de styles pour aligner les lettres au centre */
.flex-shrink-5 {
    text-align: center;
}

.flex-shrink-5 p {
    margin-top: 5px;
    /* Espace entre l'image et la lettre */
    text-align: center;
    /* Centrage horizontal de la lettre */
}
  </style>