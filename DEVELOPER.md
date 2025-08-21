# دليل المطورين التفصيلي - Detailed Developer Guide

## 📋 فهرس المحتويات - Table of Contents
- [إعداد بيئة التطوير](#development-environment-setup)
- [معمارية النظام](#system-architecture)
- [إرشادات الترميز](#coding-guidelines)
- [إدارة قاعدة البيانات](#database-management)
- [إدارة الأصول](#asset-management)
- [اختبار التطبيق](#application-testing)
- [نشر التطبيق](#deployment)
- [الأمان](#security)
- [الأداء](#performance)
- [مساهمة المطورين](#contributing)

## 🛠️ إعداد بيئة التطوير - Development Environment Setup

### المتطلبات الأساسية - Prerequisites
```bash
# التحقق من إصدارات البرامج المطلوبة
php --version        # PHP 8.1+
composer --version   # Composer latest
node --version       # Node.js 16+
npm --version        # npm latest
git --version        # Git latest
```

### إعداد IDE - IDE Setup

#### VS Code Extensions المفيدة
```json
{
  "recommendations": [
    "bmewburn.vscode-intelephense-client",
    "ms-vscode.vscode-json",
    "bradlc.vscode-tailwindcss",
    "xdebug.php-debug",
    "rifi2k.format-html-in-php"
  ]
}
```

#### PHPStorm Configuration
```php
// .phpstorm.meta.php
<?php
namespace PHPSTORM_META {
    override(\Yii::createObject(0), map([
        'yii\web\Application' => \yii\web\Application::class,
    ]));
}
```

### متغيرات البيئة - Environment Variables
```bash
# ملف .env (إنشاء في مجلد app/)
YII_ENV=dev
YII_DEBUG=true
DATABASE_URL=sqlite:../runtime/hr_system.db
MAILER_DSN=smtp://localhost:1025
```

## 🏗️ معمارية النظام - System Architecture

### نمط MVC - MVC Pattern
```
Controller → Model → Database
    ↓        ↓
   View ← Widget
```

### تدفق البيانات - Data Flow
```
Request → Router → Controller → Model → Database
                     ↓           ↓
Response ← View ← Controller ← Model
```

### طبقات التطبيق - Application Layers
1. **Presentation Layer**: Views, Widgets, Assets
2. **Business Layer**: Controllers, Services
3. **Data Layer**: Models, ActiveRecord
4. **Infrastructure Layer**: Components, Behaviors

## 📝 إرشادات الترميز - Coding Guidelines

### معايير PHP - PHP Standards
```php
<?php
// اتبع PSR-12 Coding Standard
namespace app\modules\example;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Example Model
 * 
 * @property int $id
 * @property string $name
 */
class Example extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    
    public static function tableName()
    {
        return '{{%examples}}';
    }
    
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
    
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }
}
```

### تسمية الملفات والمجلدات - File Naming
```
controllers/        # PascalCase + Controller suffix
models/            # PascalCase
views/             # lowercase with hyphens
  module-name/
    action-name.php
migrations/        # timestamp_description.php
tests/            # match source structure
```

### التعليقات - Comments
```php
/**
 * وصف باللغة العربية للميزات العربية
 * English description for technical features
 * 
 * @param int $id معرف السجل
 * @return Model|null
 * @throws NotFoundHttpException
 */
public function findModel($id)
{
    // تعليق سطر واحد بالعربية
    // Single line English comment
    return static::findOne($id);
}
```

## 🗄️ إدارة قاعدة البيانات - Database Management

### أفضل الممارسات للـ Migrations
```php
<?php
use yii\db\Migration;

class m230101_000000_create_example_table extends Migration
{
    public function safeUp()
    {
        // إنشاء الجدول
        $this->createTable('{{%examples}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'name_ar' => $this->string()->notNull()->comment('Arabic name'),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        // إنشاء الفهارس
        $this->createIndex('idx-examples-status', '{{%examples}}', 'status');
        $this->createIndex('idx-examples-name', '{{%examples}}', 'name');

        // إضافة المفاتيح الخارجية
        $this->addForeignKey(
            'fk-examples-user_id',
            '{{%examples}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-examples-user_id', '{{%examples}}');
        $this->dropTable('{{%examples}}');
    }
}
```

### استعلامات محسنة - Optimized Queries
```php
// استخدم with() لتجنب N+1 problem
$employees = Employee::find()
    ->with(['bank', 'payrolls'])
    ->where(['status' => Employee::STATUS_ACTIVE])
    ->orderBy(['name' => SORT_ASC])
    ->all();

// استخدم select() لتحديد الحقول المطلوبة فقط
$banks = Bank::find()
    ->select(['id', 'name', 'code'])
    ->asArray()
    ->all();

// استخدم exists() للتحقق من وجود السجلات
$hasEmployees = Employee::find()
    ->where(['bank_id' => $bankId])
    ->exists();
```

## 🎨 إدارة الأصول - Asset Management

### إنشاء Asset Bundle مخصص
```php
<?php
namespace app\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/module.css',
    ];
    
    public $js = [
        'js/module.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
        'app\assets\AppAsset',
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_END,
    ];
}
```

### تطوير CSS مع Tailwind
```css
/* web/css/input.css */
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
    html {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
    }
    
    .en {
        direction: ltr;
    }
}

@layer components {
    .btn {
        @apply px-4 py-2 rounded font-medium transition-colors;
    }
    
    .btn-primary {
        @apply bg-blue-600 text-white hover:bg-blue-700;
    }
    
    .form-input {
        @apply border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500;
    }
    
    .card {
        @apply bg-white rounded-lg shadow-md p-6;
    }
}

@layer utilities {
    .text-gradient {
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
}
```

## 🧪 اختبار التطبيق - Application Testing

### استراتيجية الاختبار - Testing Strategy
```
Unit Tests (60%)     → Models, Components, Helpers
Functional Tests (30%) → Controllers, Forms
Acceptance Tests (10%) → User scenarios, E2E
```

### إعداد بيانات الاختبار - Test Data Setup
```php
<?php
namespace tests\fixtures;

use yii\test\ActiveFixture;

class BankFixture extends ActiveFixture
{
    public $modelClass = 'app\modules\bank\models\Bank';
    
    public $dataFile = '@tests/_data/banks.php';
    
    public $depends = [
        'tests\fixtures\UserFixture',
    ];
}
```

### اختبار API - API Testing
```php
<?php
namespace tests\api;

use ApiTester;

class BankApiCest
{
    public function _before(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->amLoggedInAs(1);
    }
    
    public function testGetBanks(ApiTester $I)
    {
        $I->sendGET('/bank/index');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'status' => 'success'
        ]);
    }
    
    public function testCreateBank(ApiTester $I)
    {
        $I->sendPOST('/bank/create', [
            'name' => 'Test Bank',
            'code' => 'TB'
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeInDatabase('banks', ['name' => 'Test Bank']);
    }
}
```

## 🚀 نشر التطبيق - Deployment

### إعداد الإنتاج - Production Setup
```bash
#!/bin/bash
# deploy.sh

# 1. تحديث الكود
git pull origin main

# 2. تثبيت التبعيات
composer install --no-dev --optimize-autoloader

# 3. تشغيل الـ migrations
php yii migrate --interactive=0

# 4. بناء الأصول
npm ci
npm run build-css

# 5. تنظيف الـ cache
php yii cache/flush-all

# 6. إعادة تشغيل الخدمات
sudo systemctl reload nginx
sudo systemctl restart php8.2-fpm
```

### متغيرات الإنتاج - Production Variables
```bash
# /etc/environment
YII_ENV=prod
YII_DEBUG=false
DATABASE_URL=mysql:host=localhost;dbname=hr_system
DB_USERNAME=hr_user
DB_PASSWORD=secure_password
MAILER_DSN=smtp://smtp.example.com:587
```

### إعداد Nginx
```nginx
server {
    listen 80;
    server_name hr-system.example.com;
    root /var/www/hr-system/app/web;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }

    location ~ /\. {
        deny all;
    }
}
```

## 🔒 الأمان - Security

### إعدادات الأمان - Security Settings
```php
// config/web.php
'request' => [
    'cookieValidationKey' => 'your-secret-key',
    'enableCsrfValidation' => true,
    'enableCookieValidation' => true,
],

'session' => [
    'cookieParams' => [
        'httpOnly' => true,
        'secure' => true, // HTTPS only
        'sameSite' => 'Strict',
    ],
],
```

### تشفير كلمات المرور - Password Hashing
```php
use yii\helpers\Security;

// تشفير كلمة المرور
$hash = Yii::$app->security->generatePasswordHash($password);

// التحقق من كلمة المرور
$isValid = Yii::$app->security->validatePassword($password, $hash);

// إنشاء مفتاح عشوائي
$authKey = Yii::$app->security->generateRandomString();
```

### حماية من SQL Injection
```php
// صحيح - استخدم parameters
$users = User::find()
    ->where(['status' => $status])
    ->andWhere(['>=', 'created_at', $date])
    ->all();

// خطأ - لا تستخدم string concatenation
$sql = "SELECT * FROM users WHERE status = " . $status; // خطر!
```

## ⚡ الأداء - Performance

### تحسين قاعدة البيانات - Database Optimization
```php
// تفعيل Schema Cache
'db' => [
    'class' => 'yii\db\Connection',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache',
],

// تحسين الاستعلامات
'db' => [
    'enableQueryCache' => true,
    'queryCacheDuration' => 300,
],
```

### تحسين Assets
```php
// ضغط الـ Assets في الإنتاج
'assetManager' => [
    'bundles' => [
        'yii\web\JqueryAsset' => [
            'sourcePath' => null,
            'js' => [
                YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
            ]
        ],
    ],
],
```

### Cache Strategies
```php
// استخدام Fragment Cache
<?php if ($this->beginCache('user-stats', ['duration' => 3600])) : ?>
    <!-- محتوى مكلف الحساب -->
<?php $this->endCache(); endif; ?>

// Data Cache
$key = 'bank-list-' . date('Y-m-d');
$banks = Yii::$app->cache->get($key);
if ($banks === false) {
    $banks = Bank::find()->all();
    Yii::$app->cache->set($key, $banks, 3600);
}
```

## 🤝 مساهمة المطورين - Contributing

### Git Workflow
```bash
# 1. إنشاء branch جديد
git checkout -b feature/new-feature

# 2. إجراء التغييرات
git add .
git commit -m "Add new feature"

# 3. تشغيل الاختبارات
vendor/bin/codecept run

# 4. Push والطلب للمراجعة
git push origin feature/new-feature
# إنشاء Pull Request
```

### معايير Pull Request
- [ ] الكود يتبع معايير PSR-12
- [ ] جميع الاختبارات تنجح
- [ ] الوثائق محدثة
- [ ] لا توجد أخطاء في التحليل الثابت
- [ ] التغييرات مراجعة ومعتمدة

### إرشادات Commit Messages
```
نوع: وصف مختصر

وصف تفصيلي إضافي عند الحاجة

- إضافة ميزة جديدة
- إصلاح خطأ
- تحسين الأداء

Closes #123
```

### أنواع Commits
- `feat:` ميزة جديدة
- `fix:` إصلاح خطأ  
- `docs:` تحديث الوثائق
- `style:` تنسيق الكود
- `refactor:` إعادة هيكلة
- `test:` إضافة اختبارات
- `chore:` مهام الصيانة

---

## 📚 موارد إضافية - Additional Resources

- [Yii2 Guide](https://www.yiiframework.com/doc/guide/2.0/en)
- [Codeception Docs](https://codeception.com/docs)
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [PSR-12 Standard](https://www.php-fig.org/psr/psr-12/)