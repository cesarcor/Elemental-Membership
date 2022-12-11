<?php

if (!defined('ABSPATH')) {
    exit;
}

$default_tab = null;
$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;

?>

<div class="wrap">

    <h1><?php echo get_admin_page_title(); ?></h1>

    <nav class="nav-tab-wrapper em-nav-tab">
      <a href="?page=elemental-membership" class="nav-tab <?php if ($tab === null){ ?>nav-tab-active<?php }?>">General</a>
      <a href="?page=elemental-membership&tab=registration" class="nav-tab <?php if ($tab === 'registration'){ ?>nav-tab-active<?php }?>">Registration</a>
      <a href="?page=elemental-membership&tab=login" class="nav-tab <?php if ($tab === 'login'){ ?>nav-tab-active<?php }?>">Login</a>
    </nav>

    <div class="tab-content">

    </div>

</div>