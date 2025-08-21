<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'الموظفين';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="min-w-0 flex-1">
            <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                <?= Html::encode($this->title) ?>
            </h1>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <?= Html::a('إضافة موظف جديد', ['create'], [
                'class' => 'btn-primary'
            ]) ?>
        </div>
    </div>

    <div class="card">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'min-w-full divide-y divide-gray-300'],
            'summary' => '<div class="px-6 py-3 text-sm text-gray-500">عرض {begin} - {end} من {totalCount} نتيجة</div>',
            'columns' => [
                [
                    'attribute' => 'employee_id',
                    'label' => 'رقم الموظف',
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900'],
                ],
                [
                    'label' => 'الاسم',
                    'value' => function ($model) {
                        return $model->getFullNameAr() ?: $model->getFullName();
                    },
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900'],
                ],
                [
                    'attribute' => 'department',
                    'label' => 'القسم',
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900'],
                ],
                [
                    'attribute' => 'position',
                    'label' => 'المنصب',
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900'],
                ],
                [
                    'attribute' => 'hire_date',
                    'label' => 'تاريخ التوظيف',
                    'format' => 'date',
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900'],
                ],
                [
                    'attribute' => 'salary',
                    'label' => 'الراتب',
                    'format' => ['currency', 'EGP'],
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900'],
                ],
                [
                    'attribute' => 'status',
                    'label' => 'الحالة',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->status == 1 
                            ? '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">نشط</span>'
                            : '<span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">غير نشط</span>';
                    },
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900'],
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'العمليات',
                    'headerOptions' => ['class' => 'px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider'],
                    'contentOptions' => ['class' => 'px-6 py-4 whitespace-nowrap text-sm font-medium'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('عرض', $url, [
                                'class' => 'text-blue-600 hover:text-blue-900 ml-2',
                                'title' => 'عرض'
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('تعديل', $url, [
                                'class' => 'text-indigo-600 hover:text-indigo-900 ml-2',
                                'title' => 'تعديل'
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('حذف', $url, [
                                'class' => 'text-red-600 hover:text-red-900',
                                'title' => 'حذف',
                                'data' => [
                                    'confirm' => 'هل أنت متأكد من حذف هذا الموظف؟',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>