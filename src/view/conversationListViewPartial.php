<?php ob_start(); ?>

<div class="col-sm-6 col-md-3 friends-list">
    <!-- options menu -->
    <ul class="list-group mt-3 mb-3">
        <li class="list-group-item">
            <a class="bi bi-power mx-2" href="index.php?action=logout"></a>
            <a href="/index.php?action=friend">
                <i class="bi-people-fill mx-2"></i>Friends
            </a>
            <a href="/index.php?action=contact">
                <i class="bi-envelope-fill mx-2"></i> Contact
            </a>
            <a href="/index.php?action=create_server">
                <i class="bi-hdd-fill mx-2"></i>Servers
            </a>
        </li>
    </ul>
    <!-- List of conversations -->
    <ul class="list-group border-0 conversationContent ">
        <?php foreach ($conversations as $conv): ?>
            <li class="list-group-item border-0">

                <a href="/index.php?action=conversation&sub_action=detail&conversation_id=<?= $conv['id']; ?>"
                   class="list-group-item list-group-item-action border-0">
                    <?php
                    if ($conv['interlocutor_avatar_url']) {
                        $avatarUrl = $conv['interlocutor_avatar_url'];
                    } else {
                        $avatarUrl = "/static/lib/bootstrap-icons-1.5.0/person-fill.svg";
                    }
                    ?>
                    <img src="<?= $avatarUrl ?>" class="rounded-circle avatar-small mx-2"/>
                    <?= $conv['interlocutor_username']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <br>
    <!-- list of servers -->
    <ul class="list-group border-0 serverContent">
        <li class="list-group-item border-0">
                    <h5>My Servers</h5>
                    <hr>
        </li>
    <?php foreach ($list as $server): ?>
         
            <li class="list-group-item border-0">
                 <a href="index.php?action=server&server=<?= $server['url'] ?>">
                    <img src="<?= $server['avatar_url'] ?>" class="rounded-circle avatar-small mx-2"/>
                    <?= $server['name']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php $conversation_list_content = ob_get_clean(); ?>


