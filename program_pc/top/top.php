<!-- 头部 -->
<div class="center top">
    <div class="logo">
        <img class="logo-img" src="/<?= $logo_src ?>" alt="<?= $web_title ?>"/>
        <h1 class="logo-title"><?= $web_title ?></h1>
        <a class="logo-link" href="http://<?= $web_link ?>"><?= $web_link ?></a>
    </div>
    <div class="top-nav">
        <?php
        $nav_list = $F->get_nav_list();
        foreach ($nav_list as $value) {
            $link = '';
            if ($value['type'] == 'category') {
                $link = 'list-' . $value['target_id'] . '-1.html';
            } else if ($value['type'] == 'article') {
                $link = 'item-' . $value['target_id'] . '.html';
            } else {
                $link = $value['target_id'];
            }
            echo '<a class="top-nav-item" href="' . $link . '" target="_blank">' . $value['name'] . '</a>';
        }
        ?>
    </div>
</div>