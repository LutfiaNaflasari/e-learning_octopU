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
            $w = array(10, 40, 40, 40, 40, 40);
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
                $this->Cell($w[0], 6, $no, 'LR', 0, 'C', $fill);
                $this->Cell($w[1], 6, $row['kons_nama'], 'LR', 0, 'C', $fill);
                $this->Cell($w[2], 6, $row['kons_username'], 'LR', 0, 'C', $fill);
                $this->Cell($w[3], 6, $row['kons_mail'], 'LR', 0, 'C', $fill);
                $this->Cell($w[4], 6, $row['kons_telp'], 'LR', 0, 'C', $fill);
                $this->Cell($w[5], 6, $row['kons_password'], 'LR', 1, 'C', $fill);
                $no++; // Increment the counter
                $fill = !$fill;
            }

            $this->Cell(array_sum($w), 0, '', 'T');

        }

        // Header
        public function Header() {
            $this->SetFont('dejavusans', 'B', 12);
            $this->Cell(0, 10, 'Data Konsumen octop.U', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }
    }

    // Create new PDF document
    $pdf = new MYPDF('L', 'mm', 'F4', true, 'UTF-8', false);

    // Set document information
    $pdf->SetCreator('Kelompok 7');
    $pdf->SetAuthor('Kelompok 7');
    $pdf->SetTitle('Data Konsumen');
    $pdf->SetSubject('Data Konsumen');
    $pdf->SetKeywords('Data, Konsumen');

    // Set default header data
    $pdf->SetHeaderData('', 0, '', '', array(0, 0, 0), array(255, 255, 255));
    $pdf->setHeaderFont(array('dejavusans', '', 10));

    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // Add a page
    $pdf->AddPage();

    // Execute the query
    $kons = mysqli_query($conn, "SELECT * FROM tb_konsumen ORDER BY kons_id DESC");

    // Check if there are records
    if (mysqli_num_rows($kons) > 0) {
        // Column titles
        $header = array('No', 'Nama', 'Username', 'Email', 'Telepon', 'Password');

        // Fetch the data
        $data = array();
        while ($row = mysqli_fetch_assoc($kons)) {
            $data[] = $row;
        }

        // Print colored table
        $pdf->ColoredTable($header, $data);
    } else {
        // No records found
        $pdf->Cell(0, 10, 'No records found.', 0, 1);
    }

    // Output the PDF as a file (force download)
    $pdf->Output('data_konsumen.pdf', 'D');
?>
