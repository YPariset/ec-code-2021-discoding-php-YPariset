<?php ob_start(); ?>

<div class="container-fluid">
    <div class="row">

        <?= $conversation_list_partial ?>

        <div class="col-sm-6 col-md-9 mt-2">
            <div class="messageContent">
                <div class="row m-auto">
                    <div class="col-md-6">
                        <h3><?= $interlocutor['username'] ?></h3>
                    </div>
                    <div class="col-md-6 align-self-center d-flex justify-content-end">
                        <form class="col-md-6 align-self-center d-flex justify-content-end" method="GET" action="/index.php?action=conversation&sub_action=detail&conversation_id=<?= $conversation_id ?>">
                            <input type="hidden" name="action" value="conversation" /> 
                            <input type="hidden" name="sub_action" value="detail" /> 
                            <input type="hidden" name="conversation_id" value=<?= $conversation_id ?> /> 
                            <input class="form-control me-2" type="search" id="search" name="content" placeholder="Search" aria-label="Search">
                        <button id="sendMessage" type="submit" class="btn btn-secondary">Send</button>
                        </form>
                    </div>
                    <?php if(!empty($_GET['content'])):?>
                        <?php foreach ($messagesFiltered as $messageFiltered):
                            if ($messageFiltered['user_id'] == $user_id) {
                                $msgUser = $user;
                            } else {
                                $msgUser = $interlocutor;
                            }
                            ?>

                            <div class="card flex-row flex-wrap">
                                <div class="card-header" style="background-color: inherit;">
                                    <?php
                                    if ($msgUser['avatar_url']) {
                                        $avatarUrl = $msgUser['avatar_url'];
                                    } else {
                                        $avatarUrl = "/static/lib/bootstrap-icons-1.5.0/person-fill.svg";
                                    }
                                    ?>
                                    <img src="<?= $avatarUrl ?>" class="rounded-circle avatar mx-2"/>
                                </div>
                            <?php if ($messageFiltered['user_id'] == $user_id) : ?>
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <div class="flex-grow-1 fw-bold">
                                            <?= $msgUser['username'] ?>
                                        </div>
                                        <div class="text-muted fs-6">
                                            <form method="POST" action="/index.php?action=conversation&sub_action=delete_message&conversation_id=<?= $conversation_id ?>">
                                                <?= $messageFiltered['created_at'] ?>
                                                <input type="hidden" value="<?= isset($messageFiltered['id']) ? $messageFiltered['id'] : '' ?>" name="id_message"/>
                                                <button type="submit" name="delete" class="deleteMessage" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <?= $messageFiltered['content'] ?>
                                    </div>
                                </div>
                            <?php else:  ?>
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <div class="flex-grow-1 fw-bold">
                                            <?= $msgUser['username'] ?>
                                        </div>
                                        <div class="text-muted fs-6">
                                            <?= $messageFiltered['created_at'] ?>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <?= $messageFiltered['content'] ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach ($messages as $message):
                            if ($message['user_id'] == $user_id) {
                                $msgUser = $user;
                            } else {
                                $msgUser = $interlocutor;
                            }
                            ?>

                            <div class="card flex-row flex-wrap">
                                <div class="card-header" style="background-color: inherit;">
                                    <?php
                                    if ($msgUser['avatar_url']) {
                                        $avatarUrl = $msgUser['avatar_url'];
                                    } else {
                                        $avatarUrl = "/static/lib/bootstrap-icons-1.5.0/person-fill.svg";
                                    }
                                    ?>
                                    <img src="<?= $avatarUrl ?>" class="rounded-circle avatar mx-2"/>
                                </div>
                            <?php if ($message['user_id'] == $user_id) : ?>
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <div class="flex-grow-1 fw-bold">
                                            <?= $msgUser['username'] ?>
                                        </div>
                                        <div class="text-muted fs-6">
                                            <form method="POST" action="/index.php?action=conversation&sub_action=delete_message&conversation_id=<?= $conversation_id ?>">
                                                <?= $message['created_at'] ?>
                                                <input type="hidden" value="<?= isset($message['id']) ? $message['id'] : '' ?>" name="id_message"/>
                                                <button type="submit" name="delete" class="deleteMessage" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <?= $message['content'] ?>
                                    </div>
                                </div>
                            <?php else:  ?>
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <div class="flex-grow-1 fw-bold">
                                            <?= $msgUser['username'] ?>
                                        </div>
                                        <div class="text-muted fs-6">
                                            <?= $message['created_at'] ?>
                                        </div>
                                    </div>
                                    <div class="card-text">
                                        <?= $message['content'] ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif ?>
                </div>
            </div>
            <form class="d-flex mt-3" action="/index.php?action=conversation&sub_action=add_message&conversation_id=<?= $conversation_id ?>" method="post">
                    <div class="flex-grow-1">
                        <input type="text" placeholder="Envoyer un message" class="form-control" id="content" name="content"/>
                    </div>
                    <div class="mx-2">
                        <button id="sendMessage" type="submit" class="btn btn-secondary">Envoyer</button>
                    </div>
            </form>
        </div>
    </div>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/static/js/page_conversation_detail.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require('base.php'); ?>
