<?php
require '../../../assets/lib/tfpdf/tfpdf.php';


session_start();

$orgID = $_SESSION["ID"];


class exportPDFEvent extends tFPDF{

    private $orgID;

    function header(){
        $this->Image('../../../assets/image/logo.png',105,10,20,20);
        $this->SetFont('Arial','B',20);
        $this->Cell(290,20,'WEBWUT Event',0,0,'C');
        $this->Ln(20);
        $this->SetFont('Times','B',16);
        $this->Cell(280,20,'Event Report',0,0,'C');
        $this->Ln();
    }

    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(10,10,'ID',1,0,'C');
        $this->Cell(30,10,'Event Name',1,0,'C');
        $this->Cell(10,10,'Type',1,0,'C');
        $this->Cell(30,10,'Event Detail',1,0,'C');
        $this->Cell(30,10,'Indoor Name',1,0,'C');
        $this->Cell(30,10,'Location Name',1,0,'C');
        $this->Cell(30,10,'Create Date',1,0,'C');
        $this->Cell(30,10,'Registrable Date',1,0,'C');
        $this->Cell(30,10,'Event Start',1,0,'C');
        $this->Cell(30,10,'Event End',1,0,'C');
        $this->Cell(10,10,'Age',1,0,'C');
        $this->Cell(10,10,'Gender',1,0,'C');
        $this->Cell(20,10,'AttendingCost',1,0,'C');
        $this->Cell(20,10,'Survey Form',1,0,'C');
        $this->Cell(10,10,'Total Entries',1,0,'C');
        $this->Ln();
    }

    function bodyTable(){
        // $this->SetFont('Times','',10);
        $this->AddFont('DejaVu','','THSarabun.ttf',true);
        $this->SetFont('DejaVu','',14);

        include('../../../services/connectDB.php');
        $query = "SELECT `event`.*, `event_image`.`image`, `event_survey_link`.`surveyLink` FROM `event` 
          LEFT JOIN `event_image` ON `event`.`eventID` = `event_image`
          .`eventID` 
          LEFT JOIN `event_survey_link` ON `event`.`eventID` = 
          `event_survey_link`.`eventID` 
          WHERE `event`.`orgID` = $this->orgID
          ORDER BY `event`.`eventID`";
        $statement = $conn->prepare($query);
        $statement->execute();


        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $eventID = intval($row["eventID"]);
            $detail = $row["eventDetail"];
            $type = $row["type"];
            $eventName = $row["eventName"];
            $createDate = date('d-m-y H:i:s',strtotime($row["eventCreate"]));
            $registrableDate = date('d-m-y H:i',strtotime($row["registrableDate"]));
            $startDate = date('d-m-y H:i',strtotime($row["eventStart"]));
            $endDate = date('d-m-y H:i',strtotime($row["eventEnd"]));
            $age = intval($row["age"]);
            $gender = $row["gender"];
            $attendingCost = intval($row["price"]);
            $maxEntries = intval($row["capacity"]);
            $indoorName = $row["indoorName"];
            $location = $row["location"];

            $surveyLink = $row["surveyLink"];

            $this->Cell(10,10,$eventID,1,0,'C');
            $this->Cell(30,10,$eventName,1,0,'C');
            $this->Cell(10,10,$type,1,0,'C');
            $this->Cell(30,10,$detail,1,0,'C');
            $this->Cell(30,10,$indoorName,1,0,'C');
            $this->Cell(30,10,$location,1,0,'C');
            $this->Cell(30,10,$createDate,1,0,'C');
            $this->Cell(30,10,$registrableDate,1,0,'C');
            $this->Cell(30,10,$startDate,1,0,'C');
            $this->Cell(30,10,$endDate,1,0,'C');
            $this->Cell(10,10,$age,1,0,'C');
            $this->Cell(10,10,$gender,1,0,'C');
            $this->Cell(20,10,$attendingCost,1,0,'C');
            $this->Cell(20,10,$surveyLink,1,0,'C');
            $this->Cell(10,10,$maxEntries,1,0,'C');
            $this->Ln();
        }
    }

    public function setOrgID($orgID){
        $this->orgID = $orgID;
    }
}

$pdf = new exportPDFEvent();
$pdf->setOrgID($orgID);
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->bodyTable();
$pdf->Output();

// close session
session_write_close();
?>