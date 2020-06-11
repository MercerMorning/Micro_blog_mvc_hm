<?php
$allMesages = $data;
?>

<form action="message" method="post">
        <label for="text"><b>Message</b></label>
        <input type="text" placeholder="Enter Text" name="text" required>
        <button type="submit" class="registerbtn">Send</button>
</form>

<ul>
    <? foreach ($allMesages as $message => $inf):?>
        <li>
            <pre><?= $inf["text"]?></pre>
            <pre><?= $inf["date"]?></pre>
            <pre><?= $inf["user_id"]?></pre>
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