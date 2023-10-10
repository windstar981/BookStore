<?php

session_start();


include("../config/db_connect.php");
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
//Khởi tạo đối tượng
if (!isset($_SESSION['u_id'])) {
    header("Location: ../404.php");
    exit;
}
$numRow = 1;
$excel = new Spreadsheet();
$Excel_writer = new Xlsx($excel);
$query = "SELECT * from products, category where products.pr_category = category.c_id";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('Tất cả sách');

//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(30);

//Xét in đậm cho khoảng cột
$excel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
//Tạo tiêu đề cho từng cột
//Vị trí có dạng như sau:
/**
 * |A1|B1|C1|..|n1|
 * |A2|B2|C2|..|n1|
 * |..|..|..|..|..|
 * |An|Bn|Cn|..|nn|
 */
$excel->getActiveSheet()->setCellValue('A1', 'STT');
$excel->getActiveSheet()->setCellValue('B1', 'Mã sách');
$excel->getActiveSheet()->setCellValue('C1', 'Tên sách');
$excel->getActiveSheet()->setCellValue('D1', 'Thể loại');
$excel->getActiveSheet()->setCellValue('E1', 'Tác giả');
$excel->getActiveSheet()->setCellValue('F1', 'NXB');
$excel->getActiveSheet()->setCellValue('G1', 'Mô tả');
$excel->getActiveSheet()->setCellValue('H1', 'Tồn kho');
$excel->getActiveSheet()->setCellValue('I1', 'Ngày đăng');
$excel->getActiveSheet()->setCellValue('J1', 'Trạng thái');
$excel->getActiveSheet()->setCellValue('K1', 'Giá');

$excel->getActiveSheet()->setCellValue('L1', 'Giảm giá');

// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
// dòng bắt đầu = 2

$numRow = 2;
foreach ($products as $i => $product) {
    $status =  $product['pr_status'] == 1 ? "Private" : "Public";
    $excel->getActiveSheet()->setCellValue('A' . $numRow, $i + 1);
    $excel->getActiveSheet()->setCellValue('B' . $numRow, $product['pr_code']);
    $excel->getActiveSheet()->setCellValue('C' . $numRow, $product['pr_name']);
    $excel->getActiveSheet()->setCellValue('D' . $numRow, $product['c_name']);
    $excel->getActiveSheet()->setCellValue('E' . $numRow, $product['pr_author']);
    $excel->getActiveSheet()->setCellValue('F' . $numRow, $product['pr_pub']);
    $excel->getActiveSheet()->setCellValue('G' . $numRow, $product['pr_desc']);
    $excel->getActiveSheet()->setCellValue('H' . $numRow, $product['pr_number']);
    $excel->getActiveSheet()->setCellValue('I' . $numRow, $product['pr_date']);
    $excel->getActiveSheet()->setCellValue('J' . $numRow, $status);

    $excel->getActiveSheet()->setCellValue('K' . $numRow, $product['pr_price']);
    $excel->getActiveSheet()->setCellValue('L' . $numRow, $product['pr_discount']);
    $excel->getActiveSheet()
        ->getCell('B' . $numRow)
        ->setValueExplicit(
            $product['pr_code'],
            \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING2
        );
    $numRow++;
}
// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
// ở đây mình lưu file dưới dạng excel2007
$filename = 'products.xlsx';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename=' . $filename);
header('Cache-Control: max-age=0');
$Excel_writer->save('php://output');
