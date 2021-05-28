<?php ob_start(); ?>
<div class="container-fluid">
    <div class="row">

        <?= $conversation_list_partial ?>

        <div class="col-sm-6 col-md-9 mt-2">
            <div class="row">
                <div class="col-md-6">
                    <h2><i class="bi-people-fill mx-2"></i>Friends</h2>
                    <a href="/index.php?action=friend&sub_action=add_friend" class="btn btn-success">Add a Friend</a>
                </div>
                <div class="col-md-6 align-self-center d-flex justify-content-end">
                    <form method="get" action="">
                        <input type="search" id="search" name="username" class="form-control"
                        placeholder="Rechercher">
                        <button id="sendMessage" type="submit" class="btn btn-secondary">Envoyer</button>
                    </form>
                </div>
            </div>
            <ul class="list-group list-group-flush mt-2">
                <?php if(!empty($_GET['username'])):?>
                    <?php foreach ($users as $user): ?>
                            <li class="d-flex justify-content-between list-group-item">
                                <div>
                                    <?php
                                    if ($user['avatar_url']) {
                                        $avatarUrl = $user['avatar_url'];
                                    } else {
                                        $avatarUrl = "/static/lib/bootstrap-icons-1.5.0/person-fill.svg";
                                    }
                                    ?>
                                    <img src="<?= $avatarUrl ?>" class="rounded-circle avatar-small mx-2"/>
                                    <?= $user['username']; ?>
                                </div>

                                <div class="align-self-center">
                                    <a href="/index.php?action=conversation&sub_action=start_with_user&interlocutor_id=<?= $friend['id'] ?>">Message</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach ($friends as $friend): ?>
                            <li class="d-flex justify-content-between list-group-item">
                                <div>
                                    <?php
                                    if ($friend['avatar_url']) {
                                        $avatarUrl = $friend['avatar_url'];
                                    } else {
                                        $avatarUrl = "/static/lib/bootstrap-icons-1.5.0/person-fill.svg";
                                    }
                                    ?>
                                    <img src="<?= $avatarUrl ?>" class="rounded-circle avatar-small mx-2"/>
                                    <?= $friend['username']; ?>
                                </div>

                                <div class="align-self-center">
                                    <a href="/index.php?action=conversation&sub_action=start_with_user&interlocutor_id=<?= $friend['id'] ?>">Message</a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </ul>
        </div>

    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('base.php'); ?>
