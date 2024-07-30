<div class="row row-cols-1 row-cols-md-3 g-4">

    <?php while ($houses = $ReqAllHouseAdmin->fetch()) { ?>
    <div class="col">
        <div class="card">
            <a href="#">
                <img src="<?= $houses['images'] ?>" class="card-img-top" alt="...">
            </a>

            <div class="card-body">
                <h5 class="card-title"><?= $houses['city'] ?>, <?= $houses['district'] ?></h5>
            </div>
        </div>
    </div>

    <?php } ?>

    <!-- PAgination -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="?page=1" aria-label="Première page">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                </a>
            </li>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?= ($page == $i) ? 'active' : ''; ?>">
                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
            </li>
            <?php endfor; ?>

            <li class="page-item">
                <a class="page-link" href="?page=<?= $totalPages; ?>" aria-label="Dernière page">
                    <span aria-hidden="true">&raquo;&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>