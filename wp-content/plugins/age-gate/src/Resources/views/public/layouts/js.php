<?php do_action('age_gate/script_template/before'); ?>
<script type="text/template" id="tmpl-age-gate">
    <?php do_action('age_gate/script_content/before'); ?>
    <?php echo $this->section('content'); ?>
    <?php do_action('age_gate/script_content/after'); ?>
</script>
<?php do_action('age_gate/script_template/after'); ?>
