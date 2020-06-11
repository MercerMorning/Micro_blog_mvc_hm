<?php
$allMesages = $data;
print_r($allMesages);
?>

<form action="message" method="post">
        <label for="text"><b>Message</b></label>
        <label>
            <input type="text" placeholder="Enter Text" name="text" required>
        </label>
        <input name="userfile" type="file" /><br>
        <button type="submit" class="registerbtn">Send</button>
</form>

<ul>
    <? foreach ($allMesages as $message => $inf):?>
        <li>
            <pre><?= $inf["text"]?></pre>
            <pre><?= $inf["date"]?></pre>
            <pre><?= $inf["user_id"]?></pre>
            <? if (file_exists(__DIR__ . "../../../images/" . $inf["id"] . ".jpg")):?>
<!--                <img src="--><?//=__DIR__?><!--../../../../image.php/?id=--><?//=$inf["id"];?><!--" alt="image">-->
            <img src=<?__DIR__ . "../../../../images/" . $this->getLastInsertID() . ".jpg"?>>
            <? endif; ?>
        </li>
    <? endforeach;?>
</ul>

<style>
    li {
        border: 1px solid black;
        display: flex;
        flex-direction: column;
    }
</style>