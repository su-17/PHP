<?php
session_start();
$Marka = $_POST['marka'];
require_once 'database.php';
$query = $db->prepare('SELECT Marka FROM Marka WHERE Marka = :id');
$query->bindValue(':id',$Marka, PDO::PARAM_INT);
$query->execute();
$dat = $query->fetch();

if(empty($Marka)){
    $_SESSION['blad_pdf']=$Marka;
    header('Location: model.php?pokaz=6');
    exit();
}elseif($Marka != $dat['Marka']){
    $_SESSION['blad_pdf']=$Marka;
    header('Location: model.php?pokaz=6');
    exit();
}

require "fpdf.php";

class myPDF extends FPDF{
    function header(){
        $Markaa=$_POST['schronisko'];
        $this->SetFont('Arial','B',14);
        $this->Cell(200,5,'Raport modeli i marek: '.$Markaa,0,0,'C');
        $this->Ln(20);
    }
    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    }
    function headerTable(){
        $this->Cell(25,10,'ID_modelu','1',0,'C');
        $this->Cell(30,10,'Model','1',0,'C');
        $this->Cell(20,10,'Segment','1',0,'C');
        $this->Ln();
    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        require_once 'database.php';
        $query = $db->prepare('SELECT ID_marki FROM Marka WHERE Marka = :id');
        $query->bindValue(':id',$_POST['Marka'], PDO::PARAM_INT);
        $query->execute();
        $dat = $query->fetch();

        $stmt = $db->prepare('SELECT Model.ID_modelu, Model.Model, Model.Segment FROM Model, Marka WHERE Marka.ID_marki= :id AND Model.Marka=Marka.Marka');
        $stmt->bindValue(':id',$dat['ID_marki'], PDO::PARAM_INT);
        $stmt->execute();
        $liczba=0;
        while($data= $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(25,10,$data->KotyID,'1',0,'C');
            $this->Cell(30,10,$data->Nazwa_kota,'1',0,'C');
            $this->Cell(20,10,$data->Wiek,'1',0,'C');
            $this->Cell(30,10,$data->Rasa,'1',0,'C');
            $this->Cell(20,10,$data->Plec,'1',0,'C');
            $this->Ln();
            $liczba++;
        }
        $this->SetFont('Arial','B',14);
        $this->Ln();
        $this->Cell(25,10, 'RAZEM:','0',0,'C');
        $this->SetFont('Arial','',14);
        $this->Cell(25,10,$liczba.'Model','0',0,'C');
    }
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output('raportPDF.pdf','D');
