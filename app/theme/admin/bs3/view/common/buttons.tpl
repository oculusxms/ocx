<div class="buttons clearfix">
  <div class="pull-right">
    <?php foreach ($buttons as $button): ?>
      <a href="<?= $button['link']; ?>" class="btn btn-primary"><?= $button['text']; ?></a>
    <?php endforeach; ?>
  </div>
</div>