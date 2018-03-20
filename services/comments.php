<form action="services/addComment.php" method="post">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8"><h1>Comment</h1></div>
    </div>
    <div class="row">
        <div class="col-2"><input hidden type="text" name="eventID" id="eventID" value="<?php echo $eventID; ?>"></div>
        <div class="col-8">
            <textarea name="comment" id="comment" style="box-sizing:border-box;width:100%;height:150px"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-9"></div>
        <div class="col-1">
            <input class="btn btn-primary" <?php if (!$LOGGEDIN) echo "disabled"; ?> type="submit" name="submit" id="submit" value="submit">
        </div>
    </div>
</form>
<div id="comment-list">

<?php
foreach ($comments as $comment) {
    include 'commentCreator.php';
}
?>
</div>