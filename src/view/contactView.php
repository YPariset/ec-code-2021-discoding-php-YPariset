<?php ob_start(); 

?>

<div class="container-fluid d-flex h-100 characterBackground">
    <div class="row align-self-center w-100">
        <div class="col-4 mx-auto auth-container">
            <h3>Contact us</h3>
            <p class="text-muted">Drop us a message and we'll be glad to answer.</p>
            <form method="post" action="index.php?action=contact" class="custom-form">

                <div class="form-group">
                    <label for="name">Your name</label>
                    <input type="text" name="name" value="" id="name" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="email">Your email</label>
                    <input type="email" name="email" id="email" class="form-control" />
                </div>

                <div class="form-group">
                    <label for="comment">Message</label>
                    <textarea class="form-control" name="content" rows="5" id="content"></textarea>
                </div>

                <div class="form-group">
                    <div class="row d-flex justify-content-center ptop">               
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>

                <div class="d-flex justify-content-center ptop pbot">
                    <a class="btn btn-secondary" href='index.php'>Revenir à la page précédente</a>
                </div>  
                
                <span class="error-msg alert-danger d-flex justify-content-center">
                    <?= isset( $error_msg ) ? $error_msg : null; ?>
                </span>
                <span class="success-msg alert-success d-flex justify-content-center">
                    <?= isset($success_msg) ? $success_msg : null; ?>
                </span>
            
            </form>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require( 'view/base.php' ); ?> 