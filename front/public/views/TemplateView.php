<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Je développe votre site internet ou votre applications pour attirer plus de clients. Parlez moi de votre projet ...">
    <base href="/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3314838246.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Front/public/css/style.css">
    
    <title><?= $this->getTitle(); ?></title>
</head>
<body>
    <!-- Defined the navbar here -->
    <?= $this->getNavbar(); ?>
    
    <!-- Defined the header here -->
    <?= $this->getHeader(); ?>
    
    <!-- Defined the Body here -->
    <?= $this->getBody(); ?>
    
    <!-- Defined the Footer here -->
    <footer>
        <?= $this->getFooter(); ?>
    </footer>
</body>
</html>