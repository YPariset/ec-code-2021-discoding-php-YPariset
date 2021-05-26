<?php ob_start(); ?>

<div class="container-fluid d-flex h-100 characterBackground">
    <div class="row align-self-center w-100">
        <div class="col-4 mx-auto auth-container">
        <div class="auth-container">
          <h2>Inscription <span class="emoji">🕺</span></h2>
          <p class="text-muted">Welcome to Discoding</p>
          

          <form method="post" action="index.php?action=signup" class="custom-form">

            <div class="form-group">
              <label for="email">Adresse email</label>
              <input type="email" name="email" value="" id="email" class="form-control" required />
            </div>

            <div class="form-group">
              <label for="email">Username</label>
              <input type="username" name="username" value="" id="username" class="form-control" required />
            </div>

            <div class="form-group">
              <label for="password">Mot de passe</label>
              <input type="password" name="password" id="password" class="form-control" required />
            </div>

            <div class="form-group">
              <label for="password_confirm">Confirmez votre mot de passe</label>
              <input type="password" name="password_confirm" id="password_confirm" class="form-control" required />
            </div>

            <div class="form-group">
              <div class="row">
                <div class="d-flex justify-content-center ptop">
                  <input type="submit" name="Valider" class="btn btn-block" />
                </div>
              </div>
            </div>
            <span class="error-msg"><?= isset( $error_msg ) ? $error_msg : null; ?></span>
          </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require( __DIR__ . '/base.php'); ?>