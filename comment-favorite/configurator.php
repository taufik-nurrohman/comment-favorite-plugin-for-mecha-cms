<form class="form-plugin" action="<?php echo $config->url_current; ?>/update" method="post">
  <?php echo Form::hidden('token', $token); ?>
  <?php $cfv_config = File::open(PLUGIN . DS . basename(__DIR__) . DS . 'states' . DS . 'config.txt')->unserialize(); ?>
  <label class="grid-group">
    <span class="grid span-1 form-label"><?php echo $speak->plugin_comment_favorite_title_marker; ?></span>
    <span class="grid span-5"><?php echo Form::text('marker', $cfv_config['marker'], '&lt;i class=&quot;comment-favorite-marker&quot;&gt;&lt;/i&gt;', array(
        'class' => 'input-block'
    )); ?></span>
  </label>
  <label class="grid-group">
    <span class="grid span-1 form-label"><?php echo $speak->plugin_comment_favorite_title_container; ?></span>
    <span class="grid span-5"><?php echo Form::text('container', $cfv_config['container'], '&lt;div class=&quot;comment-favorite-container&quot;&gt;%s&lt;/div&gt;', array(
        'class' => 'input-block'
    )); ?></span>
  </label>
  <label class="grid-group">
    <span class="grid span-1 form-label"><?php echo $speak->plugin_comment_favorite_title_css; ?></span>
    <span class="grid span-5"><?php echo Form::textarea('css', $cfv_config['css'], null, array(
        'class' => array(
            'textarea-block',
            'textarea-expand',
            'code'
        )
    )); ?></span>
  </label>
  <div class="grid-group">
    <span class="grid span-1"></span>
    <span class="grid span-5"><?php echo Jot::button('action', $speak->update); ?></span>
  </div>
</form>