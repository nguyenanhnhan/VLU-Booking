<?php

class LecturerImportCsvRow
{
    public $lecturerid;
    public $fullname;
    public $hiredate;
    public $phonenumber;
    public $departmentid;
    public $emaillecturer;
    public $departmentname;

    private $values = [];
    private $indexes = [];

    /**
     * @param $values array
     * @param $indexes array
     * @param $attributes CustomAttribute[]
     */
    public function __construct($values, $indexes, $attributes)
    {
        $this->values = $values;
        $this->indexes = $indexes;

        $this->lecturerid = $this->valueOrDefault('lecturerid');
        $this->fullname = $this->valueOrDefault('fullname');
        $this->hiredate = $this->formatDate($this->valueOrDefault('hiredate'));
        $this->phonenumber = $this->valueOrDefault('phonenumber');
        $this->departmentid = $this->valueOrDefault('departmentid');
        $this->emaillecturer = $this->valueOrDefault('emaillecturer');
        $this->departmentname = $this->valueOrDefault('departmentname');
       
    }

    public function IsValid()
    {
        $isValid = !empty($this->fullname) && !empty($this->emaillecturer);
        if (!$isValid) {
            Log::Debug('User import row is not valid. Username %s, Email %s', $this->fullname, $this->emaillecturer);
        }
        return $isValid;
    }

    /**
     * @param string[] $values
     * @param CustomAttribute[] $attributes
     * @return bool|string[]
     */
    public static function GetHeaders($values, $attributes)
    {
        $values = array_map('strtolower', $values);

        if (!in_array('email', $values) && !in_array('fullname', $values)) {
            return false;
        }

        $indexes['lecturerid'] = self::indexOrFalse('lecturerid', $values);
        $indexes['fullname'] = self::indexOrFalse('fullname', $values);
        $indexes['hiredate'] = self::indexOrFalse('hiredate', $values);
        $indexes['phonenumber'] = self::indexOrFalse('phonenumber', $values);
        $indexes['departmentid'] = self::indexOrFalse('departmentid', $values);
        $indexes['emaillecturer'] = self::indexOrFalse('email', $values);
        $indexes['departmentname'] = self::indexOrFalse('departmentname', $values);

        return $indexes;
    }

    private static function indexOrFalse($columnName, $values)
    {
        $index = array_search($columnName, $values);
        if ($index === false) {
            return false;
        }

        return intval($index);
    }

    /**
     * @param $column string
     * @return string
     */
    private function valueOrDefault($column)
    {
        return ($this->indexes[$column] === false || !array_key_exists($this->indexes[$column], $this->values)) ? '' : $this->tryToGetEscapedValue($this->values[$this->indexes[$column]]);
    }

    private function tryToGetEscapedValue($v)
    {
        if ($v === null) {
            return '';
        }
        $value = htmlspecialchars(trim($v));
        if (!$value) {
            // htmlspecialchars gặp lỗi và không thể mã hóa
            return trim($v);
        }

        return $value;
    }
    private function formatDate($date)
    {
        if (empty($date)) {
            return '';
        }

        // Handle date as a string in the format 'dd/mm/yyyy'
        $dateTime = DateTime::createFromFormat('d/m/Y', $date);
        if ($dateTime !== false) {
            return $dateTime->format('Y-m-d');
        }

        // Handle Excel date format
        if (is_numeric($date)) {
            try {
                $dateTime = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float)$date);
                return $dateTime->format('Y-m-d');
            } catch (Exception $e) {
                return '';
            }
        }

        return '';
    }
}

class LecturerImportCsv
{
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * @var int[]
     */
    private $skippedRowNumbers = [];

    /**
     * @var CustomAttribute[]
     */
    private $attributes;

    /**
     * @param UploadedFile $file
     * @param CustomAttribute[] $attributes
     */
    public function __construct(UploadedFile $file, $attributes)
    {
        $this->file = $file;
        $this->attributes = $attributes;
    }

    /**
     * @return LecturerImportCsvRow[]
     */
    public function GetRows()
    {
        $rows = [];

        $contents = $this->file->Contents();

        $contents = $this->RemoveUTF8BOM($contents);
        $csvRows = preg_split('/\n|\r\n?/', $contents);

        if (count($csvRows) == 0) {
            Log::Debug('No rows in user import file');
            return $rows;
        }

        Log::Debug('%s rows in user import file', count($csvRows));

        $headers = LecturerImportCsvRow::GetHeaders(str_getcsv($csvRows[0]), $this->attributes);

        if (!$headers) {
            Log::Debug('No headers in user import file');
            return $rows;
        }

        for ($i = 1; $i < count($csvRows); $i++) {
            $values = str_getcsv($csvRows[$i]);

            $row = new LecturerImportCsvRow($values, $headers, $this->attributes);

            if ($row->IsValid()) {
                $rows[] = $row;
            } else {
                Log::Error('Skipped import of user row %s. Values %s', $i, print_r($values, true));
                $this->skippedRowNumbers[] = $i;
            }
        }

        return $rows;
    }

    /**
     * @return int[]
     */
    public function GetSkippedRowNumbers()
    {
        return $this->skippedRowNumbers;
    }

    private function RemoveUTF8BOM($text)
    {
        return str_replace("\xEF\xBB\xBF", '', $text);
    }
}
