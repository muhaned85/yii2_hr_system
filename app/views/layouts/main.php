<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

// Arabic font from Google Fonts
$this->registerLinkTag(['rel' => 'preconnect', 'href' => 'https://fonts.googleapis.com']);
$this->registerLinkTag(['rel' => 'preconnect', 'href' => 'https://fonts.gstatic.com', 'crossorigin' => true]);
$this->registerLinkTag(['rel' => 'stylesheet', 'href' => 'https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap']);

// Add custom styles for Arabic
$this->registerCss('
    body { font-family: "Cairo", sans-serif; }
    .arabic { direction: rtl; }
    .english { direction: ltr; }
');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="rtl" class="h-full">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="h-full bg-gray-100">
<?php $this->beginBody() ?>

<div class="min-h-full">
    <!-- Sidebar -->
    <div class="fixed inset-y-0 right-0 flex w-64 flex-col">
        <div class="flex flex-grow flex-col overflow-y-auto bg-gray-800">
            <div class="flex h-16 flex-shrink-0 items-center bg-gray-900 px-4">
                <h1 class="text-lg font-semibold text-white">نظام الموارد البشرية</h1>
            </div>
            <nav class="flex-1 space-y-1 px-2 py-4">
                <?php if (!Yii::$app->user->isGuest): ?>
                    <!-- Dashboard -->
                    <a href="<?= Url::to(['/site/index']) ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                        </svg>
                        لوحة التحكم
                    </a>
                    
                    <!-- Banks -->
                    <a href="<?= Url::to(['/bank/bank/index']) ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M10.5 3L12 2l1.5 1H21v4H3V3h7.5z" />
                        </svg>
                        البنوك
                    </a>
                    
                    <!-- Partners -->
                    <a href="<?= Url::to(['/partner/partner/index']) ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        الشركاء
                    </a>
                    
                    <!-- Employees -->
                    <a href="<?= Url::to(['/employee/employee/index']) ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        الموظفين
                    </a>
                    
                    <!-- Payroll -->
                    <a href="<?= Url::to(['/payroll/payroll/index']) ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        كشوف الرواتب
                    </a>
                    
                    <!-- Users -->
                    <a href="<?= Url::to(['/user/user/index']) ?>" class="text-gray-300 hover:bg-gray-700 hover:text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
                        <svg class="text-gray-400 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        المستخدمين
                    </a>
                <?php endif; ?>
            </nav>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="mr-64 flex flex-1 flex-col">
        <!-- Top bar -->
        <div class="flex h-16 bg-white shadow">
            <div class="flex flex-1 justify-between px-4">
                <div class="flex flex-1">
                    <!-- Page title will be shown here -->
                </div>
                <div class="mr-4 flex items-center md:mr-6">
                    <?php if (!Yii::$app->user->isGuest): ?>
                        <!-- User menu -->
                        <div class="relative mr-3">
                            <div class="flex max-w-xs items-center rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="hidden md:block text-sm text-gray-700 ml-2">مرحباً، <?= Yii::$app->user->identity->username ?></span>
                                <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'inline']) ?>
                                <?= Html::submitButton('تسجيل خروج', [
                                    'class' => 'bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm mr-2',
                                    'onclick' => 'return confirm("هل أنت متأكد من تسجيل الخروج؟")'
                                ]) ?>
                                <?= Html::endForm() ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?= Url::to(['/site/login']) ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                            تسجيل دخول
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Page content -->
        <main class="flex-1">
            <div class="py-6">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                    <!-- Alerts -->
                    <?= Alert::widget() ?>
                    
                    <!-- Content -->
                    <?= $content ?>
                </div>
            </div>
        </main>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
