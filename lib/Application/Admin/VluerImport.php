<?php

use OpenSpout\Reader\CSV\Reader as CSVReader;
use OpenSpout\Reader\XLSX\Reader as XLSXReader;
use OpenSpout\Reader\ODS\Reader as ODSReader;
use OpenSpout\Common\Exception\UnsupportedTypeException;

class VluerImportRow
{
    public $studentid;
    public $fullname;
    public $email;
    public $majorname;
    public $studentclass;
    public $studenttype;
    public $studentstatus;
    public $enrollmentdate;
    public $trainingprogram;
    public $departmentid;
    public $departmentname;

    private $values = [];
    private $indexes = [];

    public function __construct($values, $indexes, $attributes)
    {
        $this->values = $values;
        $this->indexes = $indexes;

        $this->studentid = $this->valueOrDefault('studentid');
        $this->fullname = $this->valueOrDefault('fullname');
        $this->email = $this->valueOrDefault('email');
        $this->majorname = $this->valueOrDefault('majorname');
        $this->studentclass = $this->valueOrDefault('studentclass');
        $this->studenttype = $this->valueOrDefault('studenttype');
        $this->studentstatus = $this->valueOrDefault('studentstatus');
        $this->enrollmentdate = $this->formatDate($this->valueOrDefault('enrollmentdate'));
        $this->trainingprogram = $this->valueOrDefault('trainingprogram');
        $this->departmentid = $this->valueOrDefault('departmentid');
        $this->departmentname = $this->valueOrDefault('departmentname');
    }

    public function IsValid()
    {
        // Tối ưu hóa kiểm tra hợp lệ
        return !empty($this->fullname) && !empty($this->email);
    }

    public static function GetHeaders($values, $attributes)
    {
        $values = array_map('strtolower', $values);

        if (!in_array('email', $values) && !in_array('fullname', $values)) {
            return false;
        }

        $indexes['studentid'] = self::indexOrFalse('studentid', $values);
        $indexes['fullname'] = self::indexOrFalse('fullname', $values);
        $indexes['email'] = self::indexOrFalse('email', $values);
        $indexes['majorname'] = self::indexOrFalse('majorname', $values);
        $indexes['studentclass'] = self::indexOrFalse('studentclass', $values);
        $indexes['studenttype'] = self::indexOrFalse('studenttype', $values);
        $indexes['studentstatus'] = self::indexOrFalse('studentstatus', $values);
        $indexes['enrollmentdate'] = self::indexOrFalse('enrollmentdate', $values);
        $indexes['trainingprogram'] = self::indexOrFalse('trainingprogram', $values);
        $indexes['departmentid'] = self::indexOrFalse('departmentid', $values);
        $indexes['departmentname'] = self::indexOrFalse('departmentname', $values);

        return $indexes;
    }

    private static function indexOrFalse($columnName, $values)
    {
        $index = array_search($columnName, $values);
        return $index !== false ? $index : null;
    }

    private function valueOrDefault($column)
    {
        $index = $this->indexes[$column];
        if ($index === null || !isset($this->values[$index])) {
            return null;
        }

        return $this->values[$index];
    }

    private function formatDate($dateString)
    {
        if ($dateString instanceof DateTimeImmutable) {
            return $dateString->format('Y-m-d');
        }
        $formats = ['d/m/Y', 'm/d/Y', 'Y-m-d'];
        foreach ($formats as $format) {
            $date = DateTime::createFromFormat($format, $dateString);
            if ($date !== false) {
                return $date->format('Y-m-d');
            }
        }
        return null;
    }
}

class VluerImport
{
    private $rows = [];
    private $headers = [];
    private $attributes;
    private $skippedRowNumbers = [];

    public function __construct($fileStorage, $attributes)
    {
        $this->attributes = $attributes;
        $filePath = $fileStorage->TemporaryName();
        $fileExtension = strtolower($fileStorage->Extension());

        try {
            switch ($fileExtension) {
                case 'csv':
                    $reader = new CSVReader();
                    break;
                case 'xlsx':
                    $reader = new XLSXReader();
                    break;
                case 'ods':
                    $reader = new ODSReader();
                    break;
                default:
                    throw new UnsupportedTypeException("Unsupported file type: $fileExtension");
            }

            $reader->open($filePath);

            // Bắt đầu đọc dữ liệu
            $startTimeRead = microtime(true);

            $rowNumber = 0;
            $indexes = [];

            foreach ($reader->getSheetIterator() as $sheet) {
                if ($sheet->getIndex() > 0) break; // Chỉ đọc sheet đầu tiên

                foreach ($sheet->getRowIterator() as $row) {
                    $rowNumber++;
                    $cells = $row->toArray();

                    if ($rowNumber == 1) {
                        $this->headers = $cells;
                        $indexes = VluerImportRow::GetHeaders($this->headers, $this->attributes);
                        if ($indexes === false) {
                            throw new Exception('Invalid file format');
                        }
                        continue;
                    }

                    $vluerRow = new VluerImportRow($cells, $indexes, $this->attributes);
                    if ($vluerRow->IsValid()) {
                        $this->rows[] = $vluerRow; // Thêm hàng hợp lệ vào mảng
                    } else {
                        $this->skippedRowNumbers[] = $rowNumber;
                    }
                }
            }

            // Tính toán và ghi nhật ký thời gian đọc dữ liệu
            $executionTimeRead = microtime(true) - $startTimeRead;
            Log::Debug("Thời gian đọc dữ liệu: " . $executionTimeRead . " giây");

            $reader->close();

        } catch (UnsupportedTypeException $e) {
            throw new Exception("Unsupported file type: $fileExtension");
        }
    }

    public function GetRows()
    {
        return $this->rows;
    }

    public function GetSkippedRowNumbers()
    {
        return $this->skippedRowNumbers;
    }
}
