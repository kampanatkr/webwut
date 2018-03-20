<?php
require '../../../assets/lib/tfpdf/tfpdf.php';


class exportPDFAttendant extends tFPDF{

    private $eventID;

    function header(){
        $this->Image('../../../assets/image/logo.png',105,10,20,20);
        $this->SetFont('Arial','B',20);
        $this->Cell(290,20,'WEBWUT Event',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Times','B',16);
        $this->Cell(280,20,'Attendant Report',0,0,'C');
        $this->Ln();
    }

    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(10,10,'ID',1,0,'C');
        $this->Cell(30,10,'Name',1,0,'C');
        $this->Cell(40,10,'E-mail',1,0,'C');
        $this->Cell(10,10,'Status',1,0,'C');
        $this->Cell(40,10,'Registered',1,0,'C');
        $this->Cell(40,10,'Evidence',1,0,'C');
        $this->Ln();
    }

    function bodyTable(){
        $this->SetFont('Times','',12);

        include('../../../services/connectDB.php');
        $query = "SELECT `event_attendant`.`aID`, `event_attendant`.`flag`, `event_attendant`.`registerStamp`, `personal_info`.`displayName`, `personal_info`.`email`, `payment`.`evidence` FROM `event`
              INNER JOIN `event_attendant` ON `event`.`eventID` = `event_attendant`.`eventID`
              INNER JOIN `payment` ON `event_attendant`.`paymentID` = `payment`.`paymentID`
              INNER JOIN `personal_info` ON `event_attendant`.`aID` = `personal_info`.`userID`
              WHERE `event`.`eventID` = $this->eventID
              ORDER BY `event`.`eventID`";
        $statement = $conn->query($query);
        $statement->execute();

        while ($nested_row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $attendeeID = intval($nested_row["aID"]);
            $attendeeName = $nested_row["displayName"];
            $flag = intval($nested_row["flag"]);
            $registerStamp = $nested_row["registerStamp"];
            $email = $nested_row["email"];
            $evidence = $nested_row["evidence"];
            $this->Cell(10,10,$attendeeID,1,0,'C');
            $this->Cell(30,10,$attendeeName,1,0,'C');
            $this->Cell(40,10,$email,1,0,'C');
            $this->Cell(10,10,$flag,1,0,'C');
            $this->Cell(40,10,$registerStamp,1,0,'C');
            $this->Cell(40,10,$evidence,1,0,'C');
            $this->Ln();
        }
    }

    public function setEventID($eventID){
        $this->eventID = $eventID;
    }
}
session_start();

$pdf = new exportPDFAttendant();
$pdf->setEventID($_SESSION['eventID']);
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->bodyTable();
$pdf->Output();

session_write_close();
?>