<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings , ShouldAutoSize , WithTitle , WithMapping
{
    use Exportable;

    public function __construct(array $id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $data = User::whereIn('id', $this->id)->with('roles:name')->select('id','name','email')->get();
        return $data;
    }

    public function map($data): array
    {
        return [
            $data->id,
            $data->name,
            $data->email,
            $data->roles[0]->name
        ];
    }
    

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Email',
            'Roles'
        ];
    }

    public function title(): string
    {
        return 'Users';
    }

}
