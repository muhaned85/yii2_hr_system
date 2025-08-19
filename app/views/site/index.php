<?php

/** @var yii\web\View $this */

use yii\helpers\Url;
use app\modules\bank\models\Bank;
use app\modules\partner\models\Partner;
use app\modules\employee\models\Employee;
use app\modules\payroll\models\Payroll;

$this->title = 'لوحة التحكم - نظام الموارد البشرية';

// Get statistics
$bankCount = Bank::find()->where(['status' => 1])->count();
$partnerCount = Partner::find()->where(['status' => 1])->count();
$employeeCount = Employee::find()->where(['status' => 1])->count();
$payrollCount = Payroll::find()->count();
?>
<div class="dashboard">
    <!-- Page header -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                لوحة التحكم
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                نظام إدارة الموارد البشرية - مرحباً بك
            </p>
        </div>
    </div>

    <!-- Statistics cards -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
        <!-- Banks -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">البنوك</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"><?= $bankCount ?></dd>
            <div class="mt-2">
                <a href="<?= Url::to(['/bank/bank/index']) ?>" class="text-sm text-blue-600 hover:text-blue-500">
                    عرض جميع البنوك →
                </a>
            </div>
        </div>

        <!-- Partners -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">الشركاء</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"><?= $partnerCount ?></dd>
            <div class="mt-2">
                <a href="<?= Url::to(['/partner/partner/index']) ?>" class="text-sm text-blue-600 hover:text-blue-500">
                    عرض جميع الشركاء →
                </a>
            </div>
        </div>

        <!-- Employees -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">الموظفين</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"><?= $employeeCount ?></dd>
            <div class="mt-2">
                <a href="<?= Url::to(['/employee/employee/index']) ?>" class="text-sm text-blue-600 hover:text-blue-500">
                    عرض جميع الموظفين →
                </a>
            </div>
        </div>

        <!-- Payroll -->
        <div class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
            <dt class="truncate text-sm font-medium text-gray-500">كشوف الرواتب</dt>
            <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900"><?= $payrollCount ?></dd>
            <div class="mt-2">
                <a href="<?= Url::to(['/payroll/payroll/index']) ?>" class="text-sm text-blue-600 hover:text-blue-500">
                    عرض جميع الكشوف →
                </a>
            </div>
        </div>
    </div>

    <!-- Quick actions -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Recent actions -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">إجراءات سريعة</h3>
                <div class="space-y-3">
                    <a href="<?= Url::to(['/employee/employee/create']) ?>" class="block w-full text-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        إضافة موظف جديد
                    </a>
                    <a href="<?= Url::to(['/bank/bank/create']) ?>" class="block w-full text-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        إضافة بنك جديد
                    </a>
                    <a href="<?= Url::to(['/partner/partner/create']) ?>" class="block w-full text-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        إضافة شريك جديد
                    </a>
                </div>
            </div>
        </div>

        <!-- System info -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">معلومات النظام</h3>
                <dl class="space-y-2">
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">إصدار النظام:</dt>
                        <dd class="text-sm text-gray-900">1.0.0</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">قاعدة البيانات:</dt>
                        <dd class="text-sm text-gray-900">SQLite</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">آخر تحديث:</dt>
                        <dd class="text-sm text-gray-900"><?= date('Y-m-d H:i') ?></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-sm text-gray-500">المستخدم الحالي:</dt>
                        <dd class="text-sm text-gray-900"><?= Yii::$app->user->isGuest ? 'ضيف' : Yii::$app->user->identity->username ?></dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
