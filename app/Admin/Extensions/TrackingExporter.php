<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid;
use Encore\Admin\Grid\Exporters\ExcelExporter;

class TrackingExporter extends ExcelExporter
{

    protected $columns = [
        'tracking_number' => '跟踪号',
        'merchant_order_number' => '商户订单号',
        'waybill_number' => '运单号',
    ];

    public function __construct(Grid $grid = null)
    {
        parent::__construct($grid);
        $this->fileName = sprintf('跟踪号列表_%s.xlsx', date('Ymd') . mt_rand(100, 999));
    }
}