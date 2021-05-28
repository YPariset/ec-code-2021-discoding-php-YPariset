<?php ob_start(); ?>


<div class="container-fluid d-flex h-100 characterBackground">
    <div class="row align-self-center w-100">
        <div class="col-md-4 mx-auto auth-container">
            <h3>Add new Server!</h3>

            <form action="" method="post">
                <div class="mb-3">
                    <label for="text" class="form-label text-muted small text-uppercase">Server name</label>
                    <input type="text" class="form-control" id="server_name" name="server_name"/>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-muted small text-uppercase">Choose a number of rooms</label>
                    <select class="custom-select form-control" id="inputGroupSelect01" name="number_rooms">
                        <option selected>Choose...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary btn-lg btn-block w-100">Add</button>
                    <a href="index.php?action=friend" class="btn btn-danger btn-lg btn-block w-100 mt-3">Back</a>
                </div>
                <span class="error-msg"><?= isset( $msg ) ? $msg : null; ?></span>
            </form>
        </div>
    </div>
</div>




<?php $content = ob_get_clean(); ?>
<?php require( __DIR__ . '/base.php'); ?>




