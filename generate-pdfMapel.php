<?php
require_once('tcpdf/tcpdf.php');
include 'db.php'; // Include the database connection file

// Extend TCPDF with custom functions
class MYPDF extends TCPDF {

    // Colored table
    public function ColoredTable($header, $data) {
        // Colors, line width, and bold font
        $this->SetFillColor(216, 191, 216); // Light purple color
        $this->SetTextColor(0);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');

        // Header
        $w = array(10, 60, 40, 40, 40, 60, 40); // Updated column widths
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();

        // Color and font restoration
        $this->SetFillColor(242, 230, 242); // Light purple color for data cells
        $this->SetTextColor(0);
        $this->SetFont('');

        // Data
        $fill = 0;
        $no = 1; // Initialize the counter
        foreach ($data as $row) {
            // Calculate the height required for 'Nama Materi' cell based on text length
            $namaMateriHeight = $this->getStringHeight($w[2], $row['mapel_nama']);
            $cellHeight = max(6, $namaMateriHeight);
        
            $this->Cell($w[0], $cellHeight, $no, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], $cellHeight, $row['selflearning_mapel'], 'LR', 0, 'L', $fill);
            
            // Store current XY position
            $x = $this->GetX();
            $y = $this->GetY();
            
            // Adjusted width and height for 'Nama Materi' column
            $this->MultiCell($w[2], $cellHeight, $row['mapel_nama'], 'LR', 'L', $fill);
            
            // Restore XY position and move to the next cell
            $this->SetXY($x + $w[2], $y);
        
            $this->Cell($w[3], $cellHeight, 'Rp '.number_format($row['mapel_harga']), 'LR', 0, 'C', $fill);
            $this->Cell($w[4], $cellHeight, $row['mapel_desk'], 'LR', 0, 'L', $fill);
            
            // Set XY position for the 'Gambar' column
            $this->SetXY($x + $w[2] + $w[3] + $w[4], $y);
        
            // Display the image
            $imagePath = 'mapel/' . $row['mapel_gambar']; // Replace with the actual image path
            $this->Image($imagePath, $this->GetX(), $this->GetY(), $w[5], $cellHeight);
            
            // Set XY position for the 'Status' column
            $this->SetXY($x + $w[2] + $w[3] + $w[4] + $w[5], $y);
        
            $this->Cell($w[6], $cellHeight, ($row['mapel_status'] == 0) ? 'Tidak Aktif' : 'Aktif', 'LR', 1, 'C', $fill);
            $no++; // Increment the counter
            $fill = !$fill;
        }
        

        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Header
    public function Header() {
        $this->SetFont('dejavusans', 'B', 12);
        $this->Cell(0, 10, 'Data Mata Pelajaran octop.U', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Create new PDF document
$pdf = new MYPDF('L', 'mm', 'F4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('Kelompok 7');
$pdf->SetAuthor('Kelompok 7');
$pdf->SetTitle('Mata Pelajaran');
$pdf->SetSubject('Mata Pelajaran');
$pdf->SetKeywords('Mata Pelajaran');

// Set default header data
$pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
$pdf->setHeaderFont(array('dejavusans', '', 10));

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Add a page
$pdf->AddPage();

// Execute the query
$mapel = mysqli_query($conn, "SELECT * FROM tb_mapel LEFT JOIN tb_selflearning USING(selflearning_id) ORDER BY mapel_id DESC");

// Check if there are records
if (mysqli_num_rows($mapel) > 0) {
    // Column titles
    $header = array('No', 'Mata Pelajaran', 'Nama Materi', 'Harga', 'Deskripsi', 'Gambar', 'Status');

    // Fetch the data
    $data = array();
    while ($row = mysqli_fetch_assoc($mapel)) {
        $data[] = $row;
    }

    // Print colored table
    $pdf->ColoredTable($header, $data);
} else {
    // No records found
    $pdf->Cell(0, 10, 'No records found.', 0, 1);
}

// Output the PDF as a file (force download)
$pdf->Output('data_mata_pelajaran.pdf', 'D');


?>
