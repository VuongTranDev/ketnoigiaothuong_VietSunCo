<?php

namespace App\Services;

class DataTableAdapterService {
    /**
     * Converting the Data API to requires DataTable format.
     *
     * @param array $apiResponse
     * @param int $draw
     * @return array
     */
    public function adaptForDataTable(array $apiResponse) {
        return [
            'recordsTotal' => $apiResponse['paginate']['total_items'],
            'recordsFiltered' => $apiResponse['paginate']['total_items'],
            'data' => $apiResponse['data'],
        ];
    }
}
