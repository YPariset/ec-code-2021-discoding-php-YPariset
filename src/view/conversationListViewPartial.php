<?php ob_start(); ?>

<div class="col-sm-6 col-md-3 friends-list">
    <ul class="list-group mt-3 mb-3">
        <li class="list-group-item">
            <a class="bi bi-power mx-2" href="index.php?action=logout"></a>
            <a href="/index.php?action=friend">
                <i class="bi-people-fill mx-2"></i>Friends
            </a>
            <a href="/index.php?action=contact">
                <i class="bi-envelope-fill mx-2"></i> Contact
            </a>
        </li>
        <li class="list-group-item">
        <input type="search" id="search" name="title" class="form-control"
                       placeholder="Rechercher">
        </li>
    </ul>
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
    <div id="container">
        <aside class="sidebar">
            <div class="sidebar-scroller channelContent">
                <section class="sidebar-group">
                    <p class="sidebar-group-title">Group 1</p>
                    <button class="sidebar-btn active">Button 1</button>
                    <button class="sidebar-btn">Button 2</button>
                </section>
                <section class="sidebar-group">
                    <p class="sidebar-group-title">Group 2</p>
                    <button class="sidebar-btn">Button 3</button>
                    <button class="sidebar-btn">Button 4</button>
                    <button class="sidebar-btn">Button 5</button>
                    <button class="sidebar-btn">Button 6</button>
                </section>
                <section class="sidebar-group">
                    <p class="sidebar-group-title">Group 3</p>
                    <button class="sidebar-btn">Button 7</button>
                    <button class="sidebar-btn">Button 8</button>
                </section>
            </div>
        </aside>
    </div>
</div>

<?php $conversation_list_content = ob_get_clean(); ?>


