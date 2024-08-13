<?php
    if(isset($_SESSION['messageWarning'])) :
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="uil uil-times-circle"></i>
    <?= $_SESSION['messageWarning']; ?>
</div>
<?php
    unset($_SESSION['messageWarning']);
    endif;
?>
