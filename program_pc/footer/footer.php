<!-- 底部 -->
<div class="footer">
    <div class="footer-nav">
        <?php
        foreach ($nav_list as $value) {
            $link = '';
            if($value['type'] == 'category'){
                $link = 'list-'.$value['target_id'].'.xhtml';
            }else if($value['type'] == 'article'){
                $link = 'item-'.$value['target_id'].'.xhtml';
            }else{
                $link = $value['target_id'];
            }
            echo '<a class="footer-nav-item" href="' . $link . '" target="_blank">' . $value['name'] . '</a>';
        }
        ?>
    </div>
    <div class="copyright">
        ©2016 <a href="http://<?= $web_link ?>" target="_blank"><?= $web_title ?></a> 版权所有<br/>
        本站由xxx建站搭建
    </div>
</div>
</body>