<div class="container px-4 text-center">
    <div class="row gx-5">
        <div class="col mb-3">
            <form method="post">
                <?php if (isset($msgError)) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i>' . $msgError .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                } elseif (isset($msgSuccess)) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>' .  $msgSuccess .
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                } ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Ajouter des Tags</label>
                    <input type="text" name="tag" class="form-control" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <button type="submit" class="btn btn-primary" name="add">Ajouter</button>
            </form>
        </div>
        <div class="row-cols-12">
            <div class="p-3 border bg-light">
                <header class="header">
                    <a class="header-brand">Tags Disponible</a>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Cherche un Tag" aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit">Search</button>
                    </form>
                </header>
                <div class="container text-center mb-5">
                    <div class="row row-cols-auto">
                        <?php while ($all = $show->fetch()) { ?>
                        <div class="col link-opacity-100" style="cursor: pointer;"><ins><?= $all['tag'] ?></ins></div>
                        <?php } ?>
                    </div>
                </div>
                <nav aria-label="Page navigation example mt-5">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </div>
    </div>
</div>