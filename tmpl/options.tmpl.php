<div class="wrap">
    <h2>RKT Settings</h2>
    <p>Make Configuration Changes to RKT Admin Here</p>
    <form action="options.php" method="post">
        <?php settings_fields('plugin_options'); ?>
        <?php do_settings_sections('rkt-admin'); ?>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>"></p>
    </form>
</div>