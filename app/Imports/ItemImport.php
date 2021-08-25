<?php

namespace App\Imports;

use App\Models\ItemModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ItemModel([
            'item_code'     => $row[0],
            'item_name'    => $row[1],
            'item_numbers' => $row[2],
            'item_make' => $row[3],
            'item_model' => $row[4],
            'item_year' => $row[5],
            'item_note' => $row[6],
            'item_image' => $row[7],
            'platinum_percentage' => $row[8],
            'pladium_percentage' => $row[9],
            'rhodium_percentage' => $row[10],
            'price' => $row[11]
            // 'created_by' => $row[11],
            // 'created_at' => $row[12],
            // 'modified_at' => $row[13],
            // 'modified_by' => $row[14],
            // 'is_deleted' => $row[15],
        ]);
    }
}
