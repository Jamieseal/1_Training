<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>Halfords</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>

    <body>
    
    <!-- include header -->
    <?php
        include('templates/header.php');
        $today = date("l");
     ?>

    <!-- Main -->
    <div class="date">
        <div>
            <?php echo("Todays date: " . $today); ?>   
        </div>
    </div>
    
    <!-- include footer -->
    <?php include('templates/footer.php'); ?>

    </body>

</html>