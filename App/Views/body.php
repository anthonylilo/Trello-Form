<!DOCTYPE html>
<html lang="es">

<head>
  <title><?php echo $title ?? 'Shiro Company'; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Assets/Styles/style.css">
</head>

<body class="<?php echo $pageType === 'success' ? 'success-page' : ''; ?>">

  <?php include __DIR__ . "/../Views/$pageType.php"; ?>

  <?php include __DIR__ . '/../Views/footer.php'; ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</html>