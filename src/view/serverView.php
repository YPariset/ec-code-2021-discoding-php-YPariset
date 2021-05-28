<?php ob_start(); ?>

<h1>Bienvenue sur le server <?= $_GET['server'] ?>!</h1>



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

<?php $content = ob_get_clean(); ?>
<?php require( __DIR__ . '/base.php'); ?>