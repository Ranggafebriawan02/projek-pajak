<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biro Jasa Pajak</title>

    <!-- CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            padding-bottom: 70px; /* Ruang untuk footer agar tidak menutupi konten */
        }
        footer.fixed-bottom {
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1030;
        }
    </style>
</head>
<body>

  

    <footer class="bg-light text-center text-muted py-3 fixed-bottom">
        <div>&copy; <?= date('Y') ?> Biro Jasa Pajak. All rights reserved.</div>
    </footer>

    <!-- JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
