<div class="wrap">
    <form method="POST" action="options.php">
    <?php
        settings_fields( 'test-page' );
        do_settings_sections( 'test-page' );
        submit_button();
    ?>
</form>
</div>
