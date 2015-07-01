<!DOCTYPE>
<html>
  <head>
    <title>Error: <?php echo $error->errorId(); ?></title>
  </head>
  <body>
    <div class="error">
      <h3><?php echo $error->errorTitle(); ?></h3>
     <?php echo $error->errorMessage(); ?></p>
    </div>
  </body>
</html>
