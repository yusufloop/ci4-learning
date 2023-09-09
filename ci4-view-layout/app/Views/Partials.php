<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site HTML</title>
</head>
<body>
    <?= $this->include("partials/header") ?>

    <?= $this->renderSection("content") ?>

    <?= $this->include("partials/footer") ?>
</body>
</html>