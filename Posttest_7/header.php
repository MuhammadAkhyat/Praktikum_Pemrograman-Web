<?php
function isActive($page) {
    $currentPage = basename($_SERVER['PHP_SELF']);
    return $currentPage === $page ? 'active' : '';
}

function getNavigation() {
    ob_start();
    ?>
    <header>
        <nav>
            <a href="index.php" class="<?php echo isActive('index.php'); ?>">Home</a>
            <a href="me.php" class="<?php echo isActive('me.php'); ?>">About Me</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="timeline.php" class="<?php echo isActive('timeline.php'); ?>">Timeline</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php" class="<?php echo isActive('login.php'); ?>">Login</a>
            <?php endif; ?>
        </nav>
        <div class="user-actions">
            <button id="darkModeToggle">🌙</button>
        </div>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>
    <?php
    return ob_get_clean();
}
?>