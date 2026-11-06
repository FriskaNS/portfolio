
<?php
require_once 'koneksi.php';

$projectsResult = supabaseGet('tbl_portofolio');

if (!$projectsResult['success']) {
    die('Gagal mengambil data project dari database.');
}

$projects = $projectsResult['data'];

include 'includes/header.php';
?>

<section class="py-5">
    <div class="container py-lg-4">

        <div class="text-center mb-5">
            <p class="text-secondary fw-semibold mb-1">MY WORK</p>
            <h1 class="display-5 fw-bold">My Projects</h1>
        </div>

        <div class="row g-4">

            <?php foreach ($projects as $project): ?>

                <div class="col-12 col-md-6 col-lg-4">

                    <article class="card project-card border-0 shadow-sm h-100 overflow-hidden">

                        <img
                            src="<?php echo htmlspecialchars($project['gambar'] ?? ''); ?>"
                            class="card-img-top project-image"
                            alt="<?php echo htmlspecialchars($project['nama_proyek']); ?>"
                        >

                        <div class="card-body p-4 d-flex flex-column">

                            <h2 class="h5 fw-bold" style="color: #4F5D4E;">
                                <?php echo htmlspecialchars($project['nama_proyek']); ?>
                            </h2>

                            <p class="text-muted">
                                <?php echo htmlspecialchars($project['deskripsi'] ?? ''); ?>
                            </p>

                            <div class="mb-3">
                                <?php
                                $teknologi = explode(',', $project['teknologi'] ?? '');

                                foreach ($teknologi as $tech):
                                    $tech = trim($tech);

                                    if ($tech === '') continue;
                                ?>

                                    <span class="badge"
                                        style="background-color: #C9D4C6; color: #4F5D4E;">
                                        <?php echo htmlspecialchars($tech); ?>
                                    </span>

                                <?php endforeach; ?>
                            </div>

                            <?php if (!empty($project['link_proyek'])): ?>

                                <a
                                    href="<?php echo htmlspecialchars($project['link_proyek']); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn mt-auto"
                                    style="background-color: #4F5D4E; color: #F5F2EB;"
                                >
                                    View Project
                                </a>

                            <?php endif; ?>

                        </div>
                    </article>

                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>