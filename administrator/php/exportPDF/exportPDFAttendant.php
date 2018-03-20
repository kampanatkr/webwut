<?php 
	require '../../../assets/lib/tfpdf/tfpdf.php';


	class exportPDFAttendant extends tFPDF{

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
			$this->Cell(40,10,'User Name',1,0,'C');
			$this->Cell(40,10,'Display Name',1,0,'C');
			$this->Cell(40,10,'First Name',1,0,'C');
			$this->Cell(40,10,'Last Name',1,0,'C');
			$this->Cell(40,10,'E-mail',1,0,'C');
			$this->Cell(10,10,'age',1,0,'C');
			$this->Cell(40,10,'Phone',1,0,'C');
			$this->Cell(20,10,'Gender',1,0,'C');
			$this->Ln();
		}

		function bodyTable(){
			$this->SetFont('Times','',12);
			
			include('../connectDB.php');
			$query = "SELECT * FROM `personal_info` LEFT JOIN `user` ON personal_info.userID=user.id ORDER BY `id` ASC";
			$statement = $conn->query($query);
			while($row = $statement->fetch(PDO::FETCH_OBJ)){
				$this->Cell(10,10,$row->id,1,0,'C');
				$this->Cell(40,10,$row->userID,1,0,'L');
				$this->Cell(40,10,$row->displayName,1,0,'L');
				$this->Cell(40,10,$row->firstName,1,0,'L');
				$this->Cell(40,10,$row->lastName,1,0,'L');
				$this->Cell(40,10,$row->email,1,0,'L');
				$this->Cell(10,10,$row->age,1,0,'C');
				$this->Cell(40,10,$row->phoneNo,1,0,'L');
				$this->Cell(20,10,$row->gender,1,0,'L');
				$this->Ln();
			}

		}
	}

	$pdf = new exportPDFAttendant();
	$pdf->AliasNbPages();
	$pdf->AddPage('L','A4',0);
	$pdf->headerTable();
	$pdf->bodyTable();
	$pdf->Output();
 ?>