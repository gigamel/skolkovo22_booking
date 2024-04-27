<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title>Booking main!</title>
    <style>
    <?php require_once __DIR__ . '/style.css'?>
    </style>
  </head>
  <body>
    <div class="app">
      <h1>Estates</h1>
      <div class="content">
        <div class="estates-list">
          <?php foreach ($estates as $estate): ?>
          <div class="estate">
            <div class="title"><?= $estate->title; ?></div>
            <div class="summary"><?= $estate->summary; ?></div>
            <hr/>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </body>
</html>
