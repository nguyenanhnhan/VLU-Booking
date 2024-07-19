<?php

use PhpOffice\PhpSpreadsheet\IOFactory;


class VluerImportExcel
{
    private $file;
    private $skippedRowNumbers = [];
    private $attributes;

    public function __construct(UploadedFile $file, $attributes)
    {
        $this->file = $file;
        $this->attributes = $attributes;
    }

    public function GetRows()
    {
        $rows = [];
        // Sử dụng IOFactory để tải nội dung tệp Excel từ tên tệp tạm thời
        $spreadsheet = IOFactory::load($this->file->TemporaryName());
        $sheet = $spreadsheet->getActiveSheet(); // Lấy sheet đầu tiên (mặc định)
        $csvRows = $sheet->toArray(); // Chuyển dữ liệu sheet thành mảng

        if (count($csvRows) == 0) {
            Log::Debug('No rows in user import file');
            return $rows;
        }

        Log::Debug('%s rows in user import file', count($csvRows));

        $headers = VluerImportCsvRow::GetHeaders($csvRows[0], $this->attributes);

        if (!$headers) {
            Log::Debug('No headers in user import file');
            return $rows;
        }

        for ($i = 1; $i < count($csvRows); $i++) {
            $values = $csvRows[$i];

            $row = new VluerImportCsvRow($values, $headers, $this->attributes);

            if ($row->IsValid()) {
                $rows[] = $row;
            } else {
                Log::Error('Skipped import of user row %s. Values %s', $i, print_r($values, true));
                $this->skippedRowNumbers[] = $i;
            }
        }

        return $rows;
    }

    public function GetSkippedRowNumbers()
    {
        return $this->skippedRowNumbers;
    }
}

