<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title>Booking main!</title>
  </head>
  <body>
    <h1>Estates</h1>
    <div class="content">
      <?php foreach ($estates as $estate): ?>
        <div class="estate">
          <div class="title"><?= $estate->title; ?></div>
          <div class="summary"><?= $estate->summary; ?></div>
          <hr/>
        </div>
      <?php endforeach; ?>
    </div>
  </body>
</html>
