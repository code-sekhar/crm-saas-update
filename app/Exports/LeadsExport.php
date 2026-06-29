<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $filters;

    public function __construct(array $filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $tenantId = auth()->user()->tenant_id;

        $query = Lead::where('tenant_id', $tenantId);

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['source'])) {
            $query->where('source', $this->filters['source']);
        }

        if (!empty($this->filters['user'])) {
            $query->where('user_id', $this->filters['user']);
        }

        if (!empty($this->filters['from'])) {
            $query->whereDate('created_at', '>=', $this->filters['from']);
        }

        if (!empty($this->filters['to'])) {
            $query->whereDate('created_at', '<=', $this->filters['to']);
        }

        return $query->select(
            'name',
            'email',
            'phone',
            'status',
            'source',
            'value',
            'created_at'
        )->get();
    }

    public function headings(): array
    {
        return [

            'Customer',

            'Email',

            'Phone',

            'Status',

            'Source',

            'Value',

            'Created'

        ];
    }
}
