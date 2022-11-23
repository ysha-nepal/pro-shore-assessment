<?php

namespace Event\Exports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;

/**
 * Class EventExport
 * @package Event\Exports
 */
class EventExport implements FromQuery, WithMapping, WithHeadingRow
{
    /**
     * @var
     */
    private $query;

    /**
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\Relation|\Illuminate\Database\Query\Builder
     */
    public function query()
    {
        return $this->query->model;
    }

    /**
     * @return string[]
     */
    public function headings(): array
    {
        return [
            'Title',
            'Description',
            'Start Date',
            'End Date',
            'Created By'
        ];
    }

    /**
     * @param $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->title,
            $row->description,
            $row->start_date . "/" . $row->start_date_ad,
            $row->end_date . "/" . $row->end_date_ad,
            $row->creator->name
        ];
    }
}
