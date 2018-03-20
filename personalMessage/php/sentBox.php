<?php
    include("./connectDB.php");
    session_start();
    // $uid = $_SESSION['username'];
    // $uid = "user";
    $displayName = $_SESSION['displayName'];
    // $displayName = "ice2";
    $connection = $conn;

    $thaiMonth = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    // id ของ User ที่ Login
    // $statement = $connection->query('SELECT * FROM personal_message WHERE fromID="1" ORDER BY timestamp DESC');
//     $query = 'SELECT p.*, ut.userID as toUserID, uf.userID as fromUserID
// FROM personal_message as p
// JOIN user as ut
// ON p.toID = ut.id
// JOIN user as uf
// ON p.fromID = uf.id
// WHERE uf.userID="'. $uid .'" 
// ORDER BY timestamp DESC';
        $query = 'SELECT p.*, ut.displayName as toUserID, uf.displayName as fromUserID
FROM personal_message as p
JOIN personal_info as ut
ON p.toID = ut.userID
JOIN personal_info as uf
ON p.fromID = uf.userID
WHERE uf.displayName="'.$displayName.'" ORDER BY timestamp DESC';

    $statement = $connection->query($query);

    while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        // set day, time format

        // Thai format
        // $day = date('j',strtotime($row['timestamp']));
        // $month = $thaiMonth[date('n',strtotime($row['timestamp']))];
        // $year = date('Y',strtotime($row['timestamp'])) + 543;

        // Eng format
        $day = date('d',strtotime($row['timestamp']));
        $month = date('m',strtotime($row['timestamp']));
        $year = date('Y',strtotime($row['timestamp']));


        $hour = date('H',strtotime($row['timestamp']));
        $minute = date('i',strtotime($row['timestamp']));



?>      <div style="padding-bottom: 10px;">
            <div style="width: 99%; height: 50px; background-color: #f39e98; padding: 1em;">
                <span>Receiver: <?php echo $row['toUserID'];?></span>
                <!-- Thai format -->
                <!-- <span style="float: right;"><?php echo $day . ' ' . $month . ' ' . $year .' (' . $hour . ':' . $minute .' น.)';?></span><br> -->

                <!-- Eng format -->
                <span style="float: right;"><?php echo $day . '/' . $month . '/' . $year .' ' . $hour . ':' . $minute;?></span><br>
            </div>
            <div style="width: 99%; background-color: #ebe7da; padding: 1em;">
                <span><?php echo nl2br($row['message']);?></span>
                <?php 
                    // show image if it has image
                    if (! is_null($row['filePath'])){
                        echo '<img src="'. $row['filePath'].'" style="width: 100%;">'; }
                ?>
            </div> 
        </div>
<?php
	}
?>