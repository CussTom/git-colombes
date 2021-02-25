<?php
// Imports
include_once('test_session.php');
include_once('pdo_connect.php');
include_once('fpdf/fpdf.php'); // http://www.fpdf.org/

// Classe qui étend FPDF
class MyPDF extends FPDF
{
    // Surcharge la méthode HEADER : personnalise
    public function Header()
    {
        // Logo
        $this->Image('space.png', 10, 5, 50, 20);
        // Typo
        $this->SetTextColor(0, 0, 255);
        $this->SetFont('Arial', 'B', 20);
        // Texte
        $this->Cell(0, 10, 'Les Darons Codeurs', 0, 0, 'C');
        // Saut de ligne
        $this->Ln(20);
    }

    // Surcharge la méthode FOOTER : personnalise
    public function Footer()
    {
        // Positionnement 1.5cm du bas
        $this->SetY(-15);
        // Typo
        $this->SetFont('Times', 'I', 10);
        // Texte
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' sur {nb}', 0, 0, 'C');
    }
}

// Appelle la classe créée ci-dessus : impression en PDF
$pdf = new MyPDF();

// Gestion du nb de pages
$pdf->AliasNbPages();

// Création de la page
$pdf->AddPage('L', 'A4', 0);

// Typo
$pdf->SetFont('Times', '', 10);

// Impression contenu table
try {
    if (isset($_GET['t']) && !empty($_GET['t'])) {
        // Requête
        $t = $_GET['t'];
        $sql = "SELECT * FROM $t";
        $qry = $cnn->query($sql);
        $nb = $qry->columnCount();
        $width = 277 / $nb; // 29.7cm - 2*1cm de marge
        // Lit et écrit le nom des colonnes
        $pdf->SetTextColor(255, 255, 255);
        for ($i = 0; $i < $nb; $i++) {
            $meta = $qry->getColumnMeta($i);
            $pdf->Cell($width, 5, $meta['name'], 1, 0, 'C', true);
        }
        $pdf->Ln(5);
        // Lit et écrit les data
        $pdf->SetTextColor(0, 0, 0);
        while ($row = $qry->fetch(PDO::FETCH_NUM)) {
            for ($i = 0; $i < $nb; $i++) {
                $pdf->Cell($width, 5, utf8_decode($row[$i]), 1, 0);
            }
            $pdf->Ln(5);
        }
    } else {
        $pdf->MultiCell(0, 30, 'Table non trouvée');
    }
} catch (PDOException $err) {
    $pdf->MultiCell(0, 30, $err->getMessage());
}
unset($cnn);

// Renvoi du résultat
$pdf->Output('I', 'export.pdf');