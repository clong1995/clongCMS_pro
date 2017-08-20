<!-- 展示 -->
<div class="center show">
    <ul>
        <li>
            <?php
            $show_image_list = $F->get_show_image();
            echo '<img src="/' . $show_image_list[0]['src'] . '" alt=""/>';
            ?>
        </li>
    </ul>
</div>