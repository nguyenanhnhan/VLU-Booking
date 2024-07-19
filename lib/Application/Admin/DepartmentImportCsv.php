<?php

class DepartmentImportCsvRow
{
    public $departmentid;
    public $departmentcode;
    public $departmentname;
    public $groupid;


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

        $this->departmentid = $this->valueOrDefault('departmentid');
        $this->departmentcode = $this->valueOrDefault('departmentcode');
        $this->departmentname = $this->valueOrDefault('departmentname');
        $this->groupid = $this->valueOrDefault('groupid');
       
    }

    public function IsValid()
    {
        $isValid = !empty($this->departmentid);
        if (!$isValid) {
            Log::Debug('Department ID import row is not valid. Department ID %s, Email %s', $this->departmentid);
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

        if (!in_array('departmentid', $values)) {
            return false;
        }

        $indexes['departmentid'] = self::indexOrFalse('departmentid', $values);
        $indexes['departmentcode'] = self::indexOrFalse('departmentcode', $values);
        $indexes['departmentname'] = self::indexOrFalse('departmentname', $values);
        $indexes['groupid'] = self::indexOrFalse('groupid', $values);
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
    
}

class DepartmentImportCsv
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
     * @return DepartmentImportCsvRow[]
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

        $headers = DepartmentImportCsvRow::GetHeaders(str_getcsv($csvRows[0]), $this->attributes);

        if (!$headers) {
            Log::Debug('No headers in user import file');
            return $rows;
        }

        for ($i = 1; $i < count($csvRows); $i++) {
            $values = str_getcsv($csvRows[$i]);

            $row = new DepartmentImportCsvRow($values, $headers, $this->attributes);

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
