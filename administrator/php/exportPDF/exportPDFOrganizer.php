<?php 
	require '../../../assets/lib/tfpdf/tfpdf.php';


	class exportPDFOrganizer extends tFPDF{

		function header(){
			$this->Image('../../../assets/image/logo.png',105,10,20,20);
			$this->SetFont('Arial','B',20);
			$this->Cell(290,20,'WEBWUT Event',0,0,'C');
			$this->Ln(20);
			$this->SetFont('Times','B',16);
			$this->Cell(280,20,'Organizer Report',0,0,'C');
			$this->Ln();
		}

		function headerTable(){
			$this->SetFont('Times','B',16);
			$this->Cell(20,10,'ID',1,0,'C');
			$this->Cell(50,10,'User Name',1,0,'C');
			$this->Cell(100,10,'Organizer Name',1,0,'C');
			$this->Cell(60,10,'E-mail',1,0,'C');
			$this->Cell(40,10,'Phone',1,0,'C');
			$this->Ln();
		}

		function bodyTable(){

			include('../connectDB.php');
			$query = "SELECT * FROM `organizer_info` LEFT JOIN `user` ON organizer_info.userID=user.id ORDER BY `id` ASC";
			$statement = $conn->query($query);

			// $this->AddFont('DejaVu','','THSarabun.ttf',true);
            $this->SetFont('Times','',16);

			while($row = $statement->fetch(PDO::FETCH_OBJ)){
				$this->Cell(20,10,$row->id,1,0,'C');
				$this->Cell(50,10,$row->userID,1,0,'L');
				$this->Cell(100,10,$row->orgName,1,0,'L');
				$this->Cell(60,10,$row->email,1,0,'L');
				$this->Cell(40,10,$row->phoneNo,1,0,'L');
				$this->Ln();
			}

		}
	}

	$pdf = new exportPDFOrganizer();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->bodyTable();
	$pdf->Output();
 ?>