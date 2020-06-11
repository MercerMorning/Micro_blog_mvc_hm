<?php
$allMesages = $data;
?>

<form action="message" method="post">
        <label for="text"><b>Message</b></label>
        <input type="text" placeholder="Enter Text" name="text" required>
        <button type="submit" class="registerbtn">Send</button>
</form>

<?php print_r($this->user)?>

<?php if ($this->user["is_admin"]):?>
<form action="message" method="POST">
    <?endif;?>
<ul>
    <? foreach ($allMesages as $message => $inf):?>
        <li>
            <?php if ($this->user["is_admin"]):?>
                <input name="<?= $inf["id"]?>" type="submit" value="Удалить">
            <?endif;?>
            <pre><?= $inf["text"]?></pre>
            <pre><?= $inf["date"]?></pre>
            <pre><?= $inf["user_id"]?></pre>
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