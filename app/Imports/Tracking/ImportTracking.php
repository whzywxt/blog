<?php

namespace App\Imports\Tracking;

use App\Admin\Model\Tracking;
use Encore\Admin\Facades\Admin;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportTracking implements ToModel, WithStartRow
{

    use Importable, SkipsFailures;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // 0代表的是第一列 以此类推
        // $row 是每一行的数据
        if (!isset($row[0]) || !isset($row[1]) || !isset($row[2])) {
            return null;
        }
        if (!$user = Admin::user()) {
            return null;
        }
        return new Tracking([
            'tracking_number' => $row[0],
            'merchant_order_number' => $row[1],
            'waybill_number' => $row[2],
            'operator_id' => $user->getAuthIdentifier(),
        ]);
    }

    /**
     * 从第几行开始处理数据 就是不处理标题
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    // 验证
    // public function rules(): array
    // {
    //     return [
    //         '0' => 'required',
    //         // '0' => 'required_without:1',
    //         // '1' => 'required_without:0',
    //     ];
    // }

    // 自定义验证信息
    // public function customValidationMessages()
    // {
    //     return [
    //         '0.required' => '跟踪号未填',
    //     ];
    // }

}
