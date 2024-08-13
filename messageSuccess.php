<?php
    if(isset($_SESSION['messageSuccess'])) :
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="uil uil-check-circle"></i>
    <?= $_SESSION['messageSuccess']; ?>
</div>
<?php
    unset($_SESSION['messageSuccess']);
    endif;
?>

