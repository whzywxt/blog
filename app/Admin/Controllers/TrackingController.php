<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Tracking\ImportAction;
use App\Admin\Extensions\TrackingExporter;
use App\Admin\Model\Tracking;
use Encore\Admin\Grid;

class TrackingController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '跟踪号';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Tracking());

        // $grid->column('id', __('Id'));
        $grid->column('tracking_number', '跟踪号');
        $grid->column('merchant_order_number', '商户订单号');
        $grid->column('waybill_number', '运单号');
        $grid->column('created_at', __('创建时间'));

        $grid->model()->orderBy('id', 'desc');

        $grid->disableCreateButton();
        $grid->disableActions();
        $grid->disableColumnSelector();
        // $grid->disableRowSelector();

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            // 筛选
            $filter->equal('tracking_number', '跟踪号');
            $filter->equal('merchant_order_number', '商户订单号');
            $filter->equal('waybill_number', '运单号');
        });

        $grid->batchActions(function ($batch) {
            $batch->disableDelete();
        });

        // 添加到列表上
        $grid->tools(function (Grid\Tools $tools) {
            $tools->append(new ImportAction());
        });

        $grid->exporter(new TrackingExporter());
        return $grid;
    }

}
