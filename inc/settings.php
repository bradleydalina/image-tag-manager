<header id="t-header" class="t-section">
    <div class="t-container">
        <h1><span><a rel="referrer" target="_blank" href="<?php echo ITM_URI;?>"><?php print_r(ITM_PLUGNAME);?></a> </span><small>Version ( <?php print_r(ITM_VERSION);?> ) </small></h1>
        <p><?php print_r(ITM_DESCRIPTION);?></p>
    </div>
</header>
<nav id="t-nav" class="t-section">
    <div class="t-container">
        <ul>
            <li><a href="#tag-settings" class="t-tab t-active-tab">Plugin Settings</a></li>
            <li><a href="#how-it-works" class="t-tab">How it works?</a></li>
            <li><a href="#support" class="t-tab">Help & Support!</a></li>
        </ul>
    </div>
</nav>
<main id="t-main" class="t-section">
    <div class="t-container">
        <?php require_once ITM_RELPATH . 'inc/tabs/tag-settings.php'; ?>
        <?php require_once ITM_RELPATH . 'inc/tabs/how-it-works.php'; ?>
        <?php require_once ITM_RELPATH . 'inc/tabs/support.php'; ?>
    </div>
</main>
