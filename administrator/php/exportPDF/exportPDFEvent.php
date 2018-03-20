<?php 
	require '../../../assets/lib/tfpdf/tfpdf.php';


	class exportPDFEvent extends tFPDF{

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
			$this->Cell(30,10,'Start Date',1,0,'C');
			$this->Cell(30,10,'End Date',1,0,'C');
			$this->Cell(40,10,'Event Name',1,0,'C');
			$this->Cell(50,10,'Location',1,0,'C');
			$this->Cell(20,10,'Capacity',1,0,'C');
			$this->Cell(20,10,'Price',1,0,'C');
			$this->Cell(30,10,'Type',1,0,'C');
			$this->Cell(40,10,'Organizer Name',1,0,'C');
			$this->Ln();
		}

		function bodyTable(){
			// $this->SetFont('Times','',10);
			$this->AddFont('DejaVu','','THSarabun.ttf',true);
            $this->SetFont('DejaVu','',14);

			include('../connectDB.php');
			$query = "SELECT * FROM `event` LEFT JOIN `organizer_info` ON event.orgID=organizer_info.userID ORDER BY `eventID` ASC";
			$statement = $conn->query($query);


			while($row = $statement->fetch(PDO::FETCH_OBJ)){
				// start date
				$startDay = date('d',strtotime($row->eventStart));
		        $startMonth = date('m',strtotime($row->eventStart));
		        $startYear = date('Y',strtotime($row->eventStart));
		        $startHour = date('H',strtotime($row->eventStart));
		        $startMinute = date('i',strtotime($row->eventStart));
		        $startDate = $startDay."/".$startMonth."/".$startYear." ".$startHour.":".$startMinute;
		        $endDay = date('d',strtotime($row->eventEnd));
		        $endMonth = date('m',strtotime($row->eventEnd));
		        $endYear = date('Y',strtotime($row->eventEnd));
		        $endHour = date('H',strtotime($row->eventEnd));
		        $endMinute = date('i',strtotime($row->eventEnd));
		        $endDate = $endDay."/".$endMonth."/".$endYear." ".$endHour.":".$endMinute;

				$this->Cell(10,10,$row->eventID,1,0,'C');
				$this->Cell(30,10,$startDate,1,0,'C');
				$this->Cell(30,10,$endDate,1,0,'C');
				$this->Cell(40,10,$row->eventName,1,0,'L');
				$this->Cell(50,10,$row->location,1,0,'L');
				$this->Cell(20,10,$row->capacity,1,0,'R');
				$this->Cell(20,10,$row->price,1,0,'R');
				$this->Cell(30,10,$row->type,1,0,'L');
				$this->Cell(40,10,$row->orgName,1,0,'L');
				$this->Ln();
			}

		}
	}

	$pdf = new exportPDFEvent();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->bodyTable();
	$pdf->Output();
 ?>