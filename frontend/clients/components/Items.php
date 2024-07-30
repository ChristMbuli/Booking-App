<div class="container">
    <main>
        <div class="py-5">
            <h2> <a href="single.php?id=<?= $Id ?>"><i class="fa-solid fa-angle-left"></i></a> Demande de réservation
            </h2>
        </div>

        <?php if ($showForm) { ?>
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Récapulatif </span>
                </h4>
                <div class=" mb-3">
                    <div class="row ">
                        <div class=" p-3">
                            <img src="<?= $imagePath ?>" class="img-thumbnail" alt="...">
                        </div>
                    </div>
                </div>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Loyer</h6>
                        </div>
                        <span class="text-body-secondary"><?= number_format($rent, 0, '', ' '); ?> DH</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Caution</h6>
                        </div>
                        <span class="text-body-secondary"><?= number_format($guaranteed, 0, '', ' '); ?> DH</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Frais ménage</h6>
                        </div>
                        <span class="text-body-secondary"><?= number_format($menage, 0, '', ' '); ?> DH</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                        <div class="text-success">
                            <h6 class="my-0">Frais service etando</h6>
                        </div>
                        <span class="text-success">130 DH</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (Dirham)</span>
                        <strong><?= number_format($rent + $guaranteed + $menage + 130, 0, '', ' ') ?> DH</strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-7 col-lg-8 ">
                <form class="needs-validation mb-5" method="post">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="firstName" value="<?= $_SESSION['firstname'] ?>"
                                required readonly>
                            <!-- Datas -->
                            <input type="text" class="form-control" name="houseid" value="<?= $Id ?>" required hidden>
                            <input type="text" class="form-control" name="iduser" value="<?= $_SESSION['id'] ?>"
                                required hidden>
                            <input type="text" class="form-control" name="ownerid" value="<?= $idUser ?>" required
                                hidden>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastName" value="<?= $_SESSION['lastname'] ?>"
                                required readonly>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="<?= $_SESSION['contact'] ?>">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country">
                                <option value="">Choose...</option>
                                <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state">
                                <option value="">Choose...</option>
                                <option>California</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3"> Moyen de payement</h4>

                    <div class="my-4">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
                                checked>
                            <label class="form-check-label" for="flexRadioDefault1">
                                Western union
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Paypal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Stripe
                            </label>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Date d'expiration</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="">
                            <small class="text-body-secondary">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Numéro de la Carte</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="">
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <button class="w-100 btn btn-lg badge p-3 fs-5" type="submit" name="checkout">Réserver</button>
                </form>
            </div>
        </div>
        <?php } else { ?>
        <?php if (isset($SuccessMsg)) { ?>
        <div><?= $SuccessMsg ?></div>
        <?php } elseif (isset($ErrorMsg)) { ?>
        <div><?= $ErrorMsg ?></div>
        <?php } ?>
        <?php } ?>
    </main>
</div>