<?php
$allMesages = $data;
//var_dump($_FILES);
?>

<form enctype="multipart/form-data" action="message" method="post">
        <label for="text"><b>Message</b></label>
        <input type="text" placeholder="Enter Text" name="text" required>
        <input name="userfile" type="file" /><br>
        <button type="submit" class="registerbtn">Send</button>
</form>

<?php print_r($this->user)?>


<form action="message" method="GET">

<ul>
    <? foreach ($allMesages as $message => $inf):?>
        <li>
            <input name="<?=$inf["id"]?>" type="submit" value="Удалить">
            <pre><?= $inf["text"]?></pre>
            <pre><?= $inf["date"]?></pre>
            <pre><?= $inf["name"]?></pre>
            <? if (file_exists(PROJECT_PATH . "/images/" . $inf["id"] . ".jpg")):?>
                <?echo 'hi';?>
<!--                <img src="--><?//=PROJECT_PATH?><!--/image.php/?id=--><?//=$inf["id"];?><!--">-->
            <img src="<?=PROJECT_PATH . "/images/" . $inf["id"] . ".jpg"?>">
            <? endif; ?>
        </li>
    <? endforeach;?>
</ul>
    <?php if ($this->user["is_admin"]):?>
</form>
        <?endif;?>
<style>
    li {
        border: 1px solid black;
        display: flex;
        flex-direction: column;
    }
</style>