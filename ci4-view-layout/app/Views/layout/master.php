<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>master site</title>
</head>
<body>
    <!-- Area for dynamic content -->
    <?= $this->renderSection("content") ?>

    <?= $this->renderSection("scripts") ?>
</body>
</html>