<?php
require_once 'koneksi.php';

// Ambil data dari Supabase
$profileResult = supabaseGet('tbl_data_pribadi');
$skillsResult = supabaseGet('tbl_skill');
$projectsResult = supabaseGet('tbl_portofolio');
$educationResult = supabaseGet('tbl_pendidikan');
$contactResult = supabaseGet('tbl_kontak');

$profile = $profileResult['data'][0] ?? null;
$skills = $skillsResult['data'] ?? [];
$projects = $projectsResult['data'] ?? [];
$education = $educationResult['data'] ?? [];
$contacts = $contactResult['data'] ?? [];

// Periksa jika terjadi error
if (
    !$profileResult['success'] ||
    !$skillsResult['success'] ||
    !$projectsResult['success'] ||
    !$educationResult['success'] ||
    !$contactResult['success']
) {
    die('Gagal mengambil data portfolio dari database.');
}

include 'includes/header.php';
?>

<?php

// Proses hanya ketika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['Nama'] ?? '');
    $email = trim($_POST['Email'] ?? '');
    $message = trim($_POST['Pesan'] ?? '');

    // Validasi input
    if (
        $name === '' ||
        $email === '' ||
        $message === '' ||
        !filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {
        $status = 'danger';

    } else {

        // Simpan pesan ke Supabase
        $result = supabaseInsert('tbl_pesan', [
            'nama_pengirim' => $name,
            'email' => $email,
            'pesan' => $message
        ]);

        if ($result['success']) {
            $status = 'success';
        } else {
            $status = 'danger';

            // Catat error di log PHP
            error_log('Supabase insert error: ' . $result['error']);
        }
    }
}
?>

        <section id="about" class="py-5">
            <div class="container">
    <?php if (isset($status)): ?>
        <div class="alert alert-<?php echo htmlspecialchars($status); ?> mb-3">
            <?php if ($status === 'success'): ?>
                <strong>Pesan berhasil dikirim!</strong>
            <?php elseif ($status === 'danger'): ?>
                <strong>Pesan gagal dikirim. Periksa kembali data kamu.</strong>
            <?php endif; ?>
        </div>
    <?php endif; ?>
                <div class="row align-items-center justify-content-center g-5">

                    <div class="col-10 col-sm-7 col-md-5 text-center">
                        <img
                            src="assets/photo_profile.jpeg"
                            alt="Foto profil "
                            class="img-fluid rounded-circle shadow"
                            width="320"
                            height="320"
                        >
                    </div>

                    <div class="col-12 col-md-7">
                        <p class="text-secondary fw-semibold mb-2">
                            HELLO, I'M
                        </p>

                        <h1 class="display-4 fw-bold">Friska !!</h1>

                        <h2 class="h4 text-secondary mb-3">
                            Informatics Student
                        </h2>

                        <p class="text-muted mb-4">
                            Saya adalah mahasiswa Teknik Informatika yang tertarik dengan AI (Artificial Intelligence).
                            Saya suka mempelajari hal baru dan mendengarkan musik serta minum kopi yang menjadi kebiasaan saya sehari-hari.
                        </p>

                        <a href="#contact" class="btn btn-contact px-4 py-2" style="background-color: #4F5D4E; color: #F5F2EB; border-color: #4F5D4E;">
                            Contact Me
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <section id="skills" class="py-5">
            <div class="container">
                <div class="text-center mb-5">
                    <p class="text-secondary fw-semibold mb-1">What I Know</p>
                    <h2 class="fw-bold">My Skills</h2>
                </div>

                <div class="row g-4 justify-content-center">
                    <?php foreach ($skills as $skill): ?>

                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-4">

                                    <h3 class="card-title h5 fw-bold"
                                        style="color: #4F5D4E;">
                                        <?php echo htmlspecialchars($skill['nama_skill']); ?>
                                    </h3>

                                    <p class="card-text text-muted">
                                        <?php echo htmlspecialchars($skill['deskripsi'] ?? ''); ?>
                                    </p>

                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
        </section>


        <section id="projects" class="py-5 bg-#F5F2EB">
        <div class="container text-center">
            <p class="text-secondary fw-semibold mb-1">MY WORK</p>
            <h2 class="fw-bold mb-3">Featured Projects</h2>

            <div class="row justify-content-center g-4 mb-4">

                <?php foreach (array_slice($projects, 0, 2) as $project): ?>

                    <div class="col-10 col-sm-6 col-lg-4">
                        <div class="card border-0 shadow-sm h-100 overflow-hidden">

                            <img
                                src="<?php echo htmlspecialchars($project['gambar'] ?? ''); ?>"
                                class="project-image"
                                alt="<?php echo htmlspecialchars($project['nama_proyek']); ?>"
                            >

                            <div class="card-body">
                                <h3 class="h5 fw-bold" style="color: #4F5D4E;">
                                    <?php echo htmlspecialchars($project['nama_proyek']); ?>
                                </h3>

                                <p class="text-muted mb-0">
                                    <?php echo htmlspecialchars($project['deskripsi'] ?? ''); ?>
                                </p>
                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

            <a href="projects.php" class="btn btn-dark px-4 py-2" style="background-color: #4F5D4E; color: #F5F2EB; border-color: #4F5D4E;">
            View All Projects
            </a>
        </div>
        </section>

        <section id="education" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
            <p class="text-secondary fw-semibold mb-1">My Background</p>
            <h2 class="fw-bold">Education</h2>
            </div>

            <div class="row justify-content-center g-4">

                <?php foreach ($education as $edu): ?>

                    <div class="col-12 col-md-6">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4">

                                <h3 class="h5 fw-bold" style="color: #4F5D4E;">
                                    <?php echo htmlspecialchars($edu['institusi']); ?>
                                </h3>

                                <p class="mb-2">
                                    <?php echo htmlspecialchars($edu['program_studi'] ?? ''); ?>
                                </p>

                                <p class="text-muted mb-0">
                                    <?php
                                    echo htmlspecialchars($edu['tahun_mulai'] ?? '');
                                    ?>
                                    -
                                    <?php
                                    echo htmlspecialchars($edu['tahun_selesai'] ?? '');
                                    ?>
                                </p>

                                <?php if (!empty($edu['deskripsi'])): ?>
                                    <p class="text-muted mt-3 mb-0">
                                        <?php echo htmlspecialchars($edu['deskripsi']); ?>
                                    </p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

            </div>

        </section>

        <section id="contact" class="py-5 bg-#F5F2EB">
        <div class="container">
            <div class="text-center mb-5">
            <p class="text-secondary fw-semibold mb-1">Let's Connect</p>
            <h2 class="fw-bold">Contact Me</h2>
            </div>

            <div class="row justify-content-center g-4">

                <?php foreach ($contacts as $contact): ?>

                    <div class="col-12 col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body p-4 text-center">

                                <h3 class="h5 fw-bold" style="color: #4F5D4E;">
                                    <?php echo htmlspecialchars($contact['jenis_kontak']); ?>
                                </h3>

                                <p class="text-muted mb-0">
                                    <?php echo htmlspecialchars($contact['nilai_kontak']); ?>
                                </p>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>

                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-12 col-md-6">
                <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form action="index.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name"
                            name="Nama" placeholder="Masukkan nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email"
                            name="Email" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Pesan</label>
                        <textarea class="form-control" id="message"
                                name="Pesan" rows="4"
                                placeholder="Tulis pesan..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark px-4" style="background-color: #4F5D4E; color: #F5F2EB; border-color: #4F5D4E;">
                        Kirim Pesan
                    </button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>

<?php include 'includes/footer.php'; ?>
