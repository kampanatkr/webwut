<?php
echo "
<br>
<div class='comment-box'>
    <div class='row'>
        <div class='col-3'>
            <a href='profile.php?user=".$comment->name."'>
            <img id=imgUser width='50' height='50' src='assets/users/".($comment->image? $comment->image:'nopic.png')."'><br>".$comment->name."</a>
        </div>
        <div class='col-9 ' id='comment'>
            <div class='table-row'>   
                <div class='col-12 noPadding' id='comment-detail'>
                    <p id='commentText'>".$comment->comment."</p>
                </div>
            </div>
            <div class='table-row'>   
                <div class='col-12 noPadding' id='comment-date'>
                    <p id='commentDate'>Date: ".$comment->date."</p>
                </div>
            </div>

        </div>    
    </div>
 
</div>";
?>