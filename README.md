# نظام إدارة الموارد البشرية - HR System

نظام إدارة الموارد البشرية مبني بـ Yii2 مع واجهة مستخدم عربية حديثة باستخدام Tailwind CSS.

A modern HR Management System built with Yii2 Framework featuring Arabic-first UI with Tailwind CSS.

## 🚀 روابط سريعة - Quick Links

- 📖 **[دليل التثبيت السريع](#التثبيت---installation)** - ابدأ في 5 دقائق
- 🔧 **[دليل المطورين](DEVELOPER.md)** - للمطورين والمساهمين
- 🌐 **[وثائق API](API.md)** - واجهات البرمجة التطبيقية
- 🐛 **[استكشاف الأخطاء](#دليل-استكشاف-الأخطاء---troubleshooting-guide)** - حلول للمشاكل الشائعة
- 📋 **[سجل التغييرات](CHANGELOG.md)** - آخر التحديثات والإضافات

## 📋 فهرس المحتويات - Table of Contents

- [المميزات](#المميزات---features)
- [الوحدات والميزات](#الوحدات-والميزات---modules--features)
- [متطلبات التشغيل](#متطلبات-التشغيل---requirements)
- [التثبيت](#التثبيت---installation)
- [إعداد الإنتاج](#إعداد-الإنتاج---production-setup)
- [إعداد RBAC](#إعداد-rbac---rbac-setup)
- [الاختبار](#الاختبار---testing)
- [دليل استكشاف الأخطاء](#دليل-استكشاف-الأخطاء---troubleshooting-guide)
- [API Documentation](#api-documentation---دليل-البرمجة-التطبيقية)
- [دليل المطورين](#دليل-المطورين---developer-guide)
- [المساهمة](#المساهمة---contributing)
- [الدعم والوثائق](#-الدعم-والوثائق---documentation--support)

## المميزات - Features

### 🏗️ المعمارية - Architecture
- **Modular Monolith**: بنية معيارية منظمة
- **Yii2 Framework**: إطار عمل PHP حديث ومستقر
- **SQLite/MySQL**: دعم قواعد بيانات متعددة
- **RTL Support**: دعم كامل للغة العربية واتجاه النص

### 🎨 واجهة المستخدم - User Interface
- **Tailwind CSS**: تصميم حديث وسريع الاستجابة
- **Arabic-First**: واجهة عربية أصلية مع دعم الإنجليزية
- **Responsive Design**: متوافق مع جميع الأجهزة
- **Dark Sidebar**: شريط جانبي أنيق للتنقل

### 📦 الوحدات - Modules
- **البنوك (Banks)**: إدارة معلومات البنوك
- **الشركاء (Partners)**: إدارة الشركاء التجاريين
- **المستخدمين (Users)**: إدارة مستخدمي النظام
- **الموظفين (Employees)**: إدارة بيانات الموظفين
- **كشوف الرواتب (Payroll)**: إدارة الرواتب والمستحقات

### 🔐 الأمان - Security
- **RBAC**: التحكم في الوصول حسب الأدوار
- **المستويات**: مدير، موارد بشرية، مالية، موظف
- **Authentication**: نظام مصادقة آمن

## متطلبات التشغيل - Requirements

### الخادم - Server Requirements
- **PHP**: 8.1+ (8.2+ مفضل)
- **Extensions**: mbstring, intl, pdo, pdo_sqlite, pdo_mysql
- **Composer**: Latest version
- **Node.js**: 16+ (18+ مفضل)
- **NPM**: Latest version

### قواعد البيانات - Database Support
- **SQLite**: للتطوير والاختبار
- **MySQL**: 5.7+ للإنتاج
- **MariaDB**: 10.3+ للإنتاج

## التثبيت - Installation

### 1. استنساخ المشروع - Clone Repository
\`\`\`bash
git clone https://github.com/muhaned85/yii2_hr_system.git
cd yii2_hr_system
\`\`\`

### 2. تثبيت التبعيات - Install Dependencies
\`\`\`bash
cd app

# تثبيت تبعيات PHP
composer install

# تثبيت تبعيات Node.js
npm install
\`\`\`

### 3. بناء الأصول - Build Assets
\`\`\`bash
# بناء CSS
npm run build-css

# أو للمراقبة أثناء التطوير
npm run watch-css
\`\`\`

### 4. إعداد قاعدة البيانات - Database Setup
\`\`\`bash
# تشغيل الهجرات
php yii migrate --interactive=0

# سيتم إنشاء قاعدة البيانات SQLite تلقائياً مع البيانات الأولية
\`\`\`

### 5. تشغيل الخادم - Start Server
\`\`\`bash
# خادم التطوير المدمج
php yii serve --port=8080

# أو خادم PHP المدمج
php -S localhost:8080 -t web
\`\`\`

زر الموقع: [http://localhost:8080](http://localhost:8080)

## إعداد الإنتاج - Production Setup

### متغيرات البيئة - Environment Variables
\`\`\`bash
# قاعدة البيانات
export DATABASE_URL="mysql:host=localhost;dbname=hr_system"
export DB_USERNAME="your_username"
export DB_PASSWORD="your_password"

# البيئة
export YII_ENV="prod"
\`\`\`

### إعداد MySQL
\`\`\`sql
CREATE DATABASE hr_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'hr_user'@'localhost' IDENTIFIED BY 'secure_password';
GRANT ALL PRIVILEGES ON hr_system.* TO 'hr_user'@'localhost';
FLUSH PRIVILEGES;
\`\`\`

### تحسين الأداء - Performance Optimization
\`\`\`bash
# تثبيت للإنتاج
composer install --no-dev --optimize-autoloader

# بناء CSS مضغوط
npm run build-css

# تفعيل cache في config/web.php
# enableSchemaCache = true
\`\`\`

## API Documentation - دليل البرمجة التطبيقية

### 🔌 نظرة عامة على API - API Overview
يوفر النظام REST API للوصول لجميع الوحدات برمجياً. جميع الاستجابات بصيغة JSON.

**Base URL**: `http://localhost:8080`  
**Authentication**: يتطلب تسجيل دخول (Session-based)

### 🏦 Banks API - واجهة البنوك

#### الحصول على جميع البنوك - Get All Banks
\`\`\`http
GET /bank/index
Content-Type: application/json

Response:
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "National Bank of Egypt",
      "name_ar": "البنك الأهلي المصري",
      "code": "NBE",
      "swift_code": "NBEGEGCX",
      "status": 1
    }
  ]
}
\`\`\`

#### الحصول على بنك محدد - Get Specific Bank
\`\`\`http
GET /bank/view/{id}

Response:
{
  "status": "success",
  "data": {
    "id": 1,
    "name": "National Bank of Egypt",
    "name_ar": "البنك الأهلي المصري",
    "code": "NBE",
    "swift_code": "NBEGEGCX",
    "address": "Kasr El Nil Branch, Cairo",
    "address_ar": "فرع قصر النيل، القاهرة",
    "phone": "+20227702222",
    "email": "info@nbe.com.eg",
    "status": 1,
    "created_at": 1640995200,
    "updated_at": 1640995200
  }
}
\`\`\`

#### إنشاء بنك جديد - Create New Bank
\`\`\`http
POST /bank/create
Content-Type: application/json

Request:
{
  "name": "New Bank",
  "name_ar": "البنك الجديد",
  "code": "NB",
  "swift_code": "NEWBEGCX",
  "address": "New Address",
  "address_ar": "العنوان الجديد",
  "phone": "+20123456789",
  "email": "info@newbank.com"
}

Response:
{
  "status": "success",
  "message": "Bank created successfully",
  "data": {
    "id": 4,
    "name": "New Bank"
  }
}
\`\`\`

### 🤝 Partners API - واجهة الشركاء

#### الحصول على جميع الشركاء - Get All Partners
\`\`\`http
GET /partner/index

Response:
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "name": "ABC Technology Solutions",
      "name_ar": "ايه بي سي للحلول التقنية",
      "code": "ABC-TECH",
      "type": "Technology Provider",
      "contact_person": "John Smith",
      "phone": "+20101234567",
      "email": "john@abc-tech.com"
    }
  ]
}
\`\`\`

### 👨‍💼 Employees API - واجهة الموظفين

#### الحصول على جميع الموظفين - Get All Employees
\`\`\`http
GET /employee/index

Response:
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "employee_id": "EMP001",
      "first_name": "Mohamed",
      "last_name": "Ali",
      "first_name_ar": "محمد",
      "last_name_ar": "علي",
      "email": "mohamed.ali@company.com",
      "department": "IT",
      "position": "Software Developer",
      "salary": 15000.00,
      "bank": {
        "id": 1,
        "name": "National Bank of Egypt",
        "code": "NBE"
      }
    }
  ]
}
\`\`\`

### 💰 Payroll API - واجهة الرواتب

#### الحصول على كشوف رواتب موظف - Get Employee Payrolls
\`\`\`http
GET /payroll/index?employee_id=1

Response:
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "employee_id": 1,
      "period_year": 2024,
      "period_month": 1,
      "basic_salary": 15000.00,
      "allowances": 2000.00,
      "deductions": 500.00,
      "net_salary": 16500.00,
      "employee": {
        "name": "Mohamed Ali",
        "name_ar": "محمد علي"
      }
    }
  ]
}
\`\`\`

### 🔒 Authentication API - واجهة المصادقة

#### تسجيل الدخول - Login
\`\`\`http
POST /site/login
Content-Type: application/json

Request:
{
  "username": "admin",
  "password": "admin123"
}

Response:
{
  "status": "success",
  "message": "Login successful",
  "user": {
    "id": 1,
    "username": "admin",
    "role": "admin"
  }
}
\`\`\`

#### تسجيل الخروج - Logout
\`\`\`http
POST /site/logout

Response:
{
  "status": "success",
  "message": "Logout successful"
}
\`\`\`

### 📋 أكواد الحالة - Status Codes

| Code | Description |
|------|-------------|
| 200  | نجح الطلب |
| 201  | تم الإنشاء بنجاح |
| 400  | خطأ في الطلب |
| 401  | غير مخول |
| 403  | محظور |
| 404  | غير موجود |
| 422  | خطأ في التحقق |
| 500  | خطأ خادم |

### 🔧 أمثلة استخدام API - API Usage Examples

#### باستخدام cURL
\`\`\`bash
# الحصول على جميع البنوك
curl -X GET "http://localhost:8080/bank/index" \\
  -H "Accept: application/json" \\
  -H "Cookie: PHPSESSID=your_session_id"

# إنشاء بنك جديد
curl -X POST "http://localhost:8080/bank/create" \\
  -H "Content-Type: application/json" \\
  -H "Cookie: PHPSESSID=your_session_id" \\
  -d '{
    "name": "Test Bank",
    "name_ar": "بنك التجربة",
    "code": "TB"
  }'
\`\`\`

#### باستخدام JavaScript/Fetch
\`\`\`javascript
// الحصول على البنوك
fetch('/bank/index', {
  method: 'GET',
  headers: {
    'Accept': 'application/json',
  },
  credentials: 'same-origin'
})
.then(response => response.json())
.then(data => console.log(data));

// إنشاء بنك جديد
fetch('/bank/create', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  },
  credentials: 'same-origin',
  body: JSON.stringify({
    name: 'Test Bank',
    name_ar: 'بنك التجربة',
    code: 'TB'
  })
})
.then(response => response.json())
.then(data => console.log(data));
\`\`\`

#### باستخدام PHP
\`\`\`php
// الحصول على البنوك
$response = file_get_contents('http://localhost:8080/bank/index', false, stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => 'Accept: application/json'
    ]
]));
$data = json_decode($response, true);

// إنشاء بنك جديد باستخدام Guzzle
use GuzzleHttp\\Client;

$client = new Client();
$response = $client->post('http://localhost:8080/bank/create', [
    'json' => [
        'name' => 'Test Bank',
        'name_ar' => 'بنك التجربة',
        'code' => 'TB'
    ],
    'headers' => [
        'Accept' => 'application/json'
    ]
]);
$data = json_decode($response->getBody(), true);
\`\`\`

### ⚠️ ملاحظات مهمة - Important Notes

1. **المصادقة**: جميع API endpoints تتطلب تسجيل دخول صالح
2. **CSRF Protection**: POST requests تتطلب CSRF token
3. **Rate Limiting**: حد أقصى 100 طلب في الدقيقة لكل مستخدم
4. **Pagination**: النتائج محدودة بـ 20 عنصر في الصفحة
5. **Validation**: جميع البيانات تخضع للتحقق قبل الحفظ

### 🏗️ بنية المشروع التفصيلية - Detailed Project Structure
\`\`\`
app/
├── config/              # ملفات الإعداد
│   ├── web.php         # إعداد التطبيق الويب
│   ├── console.php     # إعداد تطبيق وحدة التحكم
│   ├── db.php          # إعداد قاعدة البيانات (SQLite/MySQL)
│   ├── params.php      # المعاملات العامة
│   └── test.php        # إعداد بيئة الاختبار
├── controllers/         # Controllers الأساسية
│   └── SiteController.php
├── models/             # Models الأساسية
│   ├── User.php        # نموذج المستخدم الأساسي
│   ├── LoginForm.php   # نموذج تسجيل الدخول
│   └── ContactForm.php # نموذج الاتصال
├── modules/            # الوحدات المعيارية
│   ├── bank/          # وحدة البنوك
│   │   ├── BankModule.php
│   │   ├── controllers/BankController.php
│   │   ├── models/Bank.php
│   │   └── views/bank/
│   ├── partner/       # وحدة الشركاء
│   ├── user/          # وحدة المستخدمين
│   ├── employee/      # وحدة الموظفين
│   └── payroll/       # وحدة الرواتب
├── views/             # القوالب الأساسية
│   ├── layouts/       # تخطيطات الصفحات
│   └── site/          # صفحات الموقع الأساسية
├── web/               # الملفات العامة
│   ├── css/           # ملفات CSS
│   ├── js/            # ملفات JavaScript
│   └── assets/        # الأصول المولدة
├── migrations/        # ملفات قاعدة البيانات
├── tests/             # ملفات الاختبار
│   ├── unit/          # اختبارات الوحدة
│   ├── functional/    # اختبارات وظيفية
│   └── acceptance/    # اختبارات القبول
└── runtime/           # ملفات التشغيل والـ cache
\`\`\`

### 🔧 إضافة وحدة جديدة - Adding New Module

#### 1. إنشاء الوحدة
\`\`\`bash
# إنشاء مجلد الوحدة
mkdir -p modules/newmodule/{controllers,models,views}

# إنشاء ملف الوحدة
touch modules/newmodule/NewModuleModule.php
\`\`\`

#### 2. تسجيل الوحدة في config/web.php
\`\`\`php
'modules' => [
    // ... الوحدات الموجودة
    'newmodule' => [
        'class' => 'app\\modules\\newmodule\\NewModuleModule',
    ],
],
\`\`\`

#### 3. إنشاء Controller
\`\`\`php
<?php
namespace app\\modules\\newmodule\\controllers;

use yii\\web\\Controller;
use yii\\filters\\AccessControl;

class DefaultController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
\`\`\`

### 🗄️ إضافة Model جديد - Adding New Model

#### 1. استخدام Gii لإنشاء Model
\`\`\`bash
# تصفح Gii في المتصفح
http://localhost:8080/gii/model

# أو استخدم سطر الأوامر
php yii gii/model --tableName=table_name --modelClass=ModelName
\`\`\`

#### 2. إضافة Behaviors والقواعد
\`\`\`php
<?php
namespace app\\modules\\newmodule\\models;

use yii\\db\\ActiveRecord;
use yii\\behaviors\\TimestampBehavior;

class NewModel extends ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    public static function tableName()
    {
        return '{{%table_name}}';
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
            [['status'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'الاسم',
            'status' => 'الحالة',
        ];
    }
}
\`\`\`

### 📊 إضافة Migration جديد - Adding New Migration

#### 1. إنشاء Migration
\`\`\`bash
# إنشاء migration لجدول جديد
php yii migrate/create create_table_name_table

# إنشاء migration لتعديل جدول
php yii migrate/create add_column_to_table_name
\`\`\`

#### 2. مثال Migration
\`\`\`php
<?php
use yii\\db\\Migration;

class m230101_000000_create_example_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%example}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'name_ar' => $this->string()->notNull(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->createIndex('idx-example-status', '{{%example}}', 'status');
    }

    public function safeDown()
    {
        $this->dropTable('{{%example}}');
    }
}
\`\`\`

### 🎨 تخصيص Views والـ CSS

#### 1. إنشاء Layout مخصص
\`\`\`php
// views/layouts/custom.php
<?php
use app\\assets\\AppAsset;
use yii\\helpers\\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" dir="rtl">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bg-gray-100">
<?php $this->beginBody() ?>

<div class="min-h-screen">
    <?= $content ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
\`\`\`

#### 2. تخصيص Tailwind CSS
\`\`\`css
/* web/css/input.css */
@tailwind base;
@tailwind components;
@tailwind utilities;

@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap');

@layer base {
    body {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
    }
}

@layer components {
    .btn-primary {
        @apply bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded;
    }
}
\`\`\`

### 🔐 إعداد الصلاحيات - Setting up Permissions

#### 1. إضافة مكون RBAC
\`\`\`php
// في config/web.php
'components' => [
    'authManager' => [
        'class' => 'yii\\rbac\\DbManager',
    ],
],
\`\`\`

#### 2. إنشاء جداول RBAC
\`\`\`bash
php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0
\`\`\`

#### 3. إضافة قواعد الوصول في Controller
\`\`\`php
public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'allow' => true,
                    'actions' => ['index', 'view'],
                    'roles' => ['hr', 'admin'],
                ],
                [
                    'allow' => true,
                    'actions' => ['create', 'update', 'delete'],
                    'roles' => ['admin'],
                ],
            ],
        ],
    ];
}
\`\`\`

### 🧪 إضافة اختبارات - Adding Tests

#### 1. اختبار Model
\`\`\`php
<?php
namespace tests\\unit\\models;

use app\\modules\\bank\\models\\Bank;
use UnitTester;

class BankTest extends \\Codeception\\Test\\Unit
{
    protected UnitTester $tester;

    public function testValidation()
    {
        $bank = new Bank();
        $bank->name = 'Test Bank';
        $bank->code = 'TB';
        
        $this->assertTrue($bank->validate());
    }

    public function testSave()
    {
        $bank = new Bank();
        $bank->name = 'Test Bank';
        $bank->code = 'TB';
        
        $this->assertTrue($bank->save());
    }
}
\`\`\`

#### 2. اختبار Controller
\`\`\`php
<?php
namespace tests\\functional;

use FunctionalTester;

class BankControllerCest
{
    public function _before(FunctionalTester $I)
    {
        // إعداد المستخدم للاختبار
        $I->amLoggedInAs(1);
    }

    public function testIndex(FunctionalTester $I)
    {
        $I->amOnPage('/bank');
        $I->seeResponseCodeIs(200);
        $I->see('Banks');
    }

    public function testCreate(FunctionalTester $I)
    {
        $I->amOnPage('/bank/create');
        $I->fillField('Bank[name]', 'Test Bank');
        $I->fillField('Bank[code]', 'TB');
        $I->click('Create');
        $I->seeRecord('app\\modules\\bank\\models\\Bank', ['name' => 'Test Bank']);
    }
}
\`\`\`

### 📦 إعداد Asset Bundle مخصص

\`\`\`php
<?php
namespace app\\assets;

use yii\\web\\AssetBundle;

class CustomAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/custom.css',
    ];
    public $js = [
        'js/custom.js',
    ];
    public $depends = [
        'yii\\web\\YiiAsset',
        'yii\\bootstrap5\\BootstrapAsset',
    ];
}
\`\`\`

### 🚀 إعداد بيئة التطوير - Development Environment Setup

#### أدوات مفيدة للتطوير
\`\`\`bash
# تفعيل وضع التطوير
export YII_ENV=dev
export YII_DEBUG=true

# مراقبة تغييرات CSS
npm run watch-css

# تشغيل الخادم مع إعادة التحميل
php yii serve --port=8080

# تشغيل الاختبارات في الخلفية
vendor/bin/codecept run --debug
\`\`\`

#### Debug والـ Profiling
\`\`\`php
// استخدام Yii Debug Toolbar
// متاح تلقائياً في بيئة التطوير على /?debug

// إضافة نقاط Debug مخصصة
Yii::debug('Custom debug message', __METHOD__);
Yii::info('Info message', __METHOD__);
Yii::error('Error message', __METHOD__);
\`\`\`

## الاختبار - Testing

### تشغيل الاختبارات - Running Tests
\`\`\`bash
# بناء الاختبارات
vendor/bin/codecept build

# تشغيل جميع الاختبارات
vendor/bin/codecept run

# تشغيل اختبارات وحدة معينة
vendor/bin/codecept run unit

# تشغيل اختبارات وظيفية
vendor/bin/codecept run functional

# تشغيل الاختبارات مع تقرير التغطية
vendor/bin/codecept run --coverage --coverage-html
\`\`\`

### أنواع الاختبارات - Test Types
- **Unit Tests**: اختبار الـ Models والـ Components المنفردة
- **Functional Tests**: اختبار تفاعل المستخدم مع التطبيق
- **Acceptance Tests**: اختبار كامل للسيناريوهات (تتطلب إعداد إضافي)

### تقارير التغطية - Coverage Reports
\`\`\`bash
# عرض تقرير التغطية بعد تشغيل الاختبارات
open tests/_output/coverage/index.html
\`\`\`

### إضافة اختبارات جديدة - Adding New Tests
\`\`\`bash
# إنشاء اختبار وحدة جديد
vendor/bin/codecept generate:unit models/BankTest

# إنشاء اختبار وظيفي جديد
vendor/bin/codecept generate:functional BankModuleCest
\`\`\`

## دليل استكشاف الأخطاء - Troubleshooting Guide

### 🔧 مشاكل التثبيت - Installation Issues

#### خطأ: "Failed to open stream" عند تشغيل composer
**الحل**:
\`\`\`bash
# تأكد من أن PHP 8.1+ مثبت
php --version

# امح مجلد vendor وأعد التثبيت
rm -rf vendor/
composer install
\`\`\`

#### خطأ: "No such file or directory" عند إعداد قاعدة البيانات
**الحل**:
\`\`\`bash
# تأكد من أن مجلد runtime موجود ومفتوح للكتابة
mkdir -p runtime
chmod 777 runtime

# تأكد من إعداد قاعدة البيانات
php yii migrate --interactive=0
\`\`\`

#### خطأ: "bower-asset/bootstrap/dist" مفقود في الاختبارات
**الحل**:
\`\`\`bash
# إعادة تثبيت أصول Bootstrap
composer install --no-dev --optimize-autoloader
\`\`\`

### 🎨 مشاكل CSS و Frontend

#### Tailwind CSS لا يعمل
**الحل**:
\`\`\`bash
# تأكد من تثبيت Node.js dependencies
npm install

# بناء CSS
npm run build-css

# للتطوير مع المراقبة
npm run watch-css
\`\`\`

#### الخطوط العربية لا تظهر بشكل صحيح
**الحل**:
\`\`\`bash
# تأكد من وجود ملف input.css مع خطوط Cairo
# وأن الـ direction مضبوط على RTL للعربية
\`\`\`

### 🗄️ مشاكل قاعدة البيانات - Database Issues

#### خطأ: "no such table: banks"
**الحل**:
\`\`\`bash
# احذف قاعدة البيانات وأعد إنشاءها
rm runtime/hr_system.db
php yii migrate --interactive=0
\`\`\`

#### خطأ في ترتيب المايجريشنز
**الحل**:
\`\`\`bash
# تأكد من ترقيم الـ migrations بالترتيب الصحيح
# البنوك يجب أن تأتي قبل البيانات الأولية
\`\`\`

#### فقدان البيانات الأولية
**الحل**:
\`\`\`bash
# إعادة تشغيل البيانات الأولية فقط
php yii migrate/down 1 --interactive=0
php yii migrate --interactive=0
\`\`\`

### 🔐 مشاكل الصلاحيات - Permission Issues

#### خطأ: "Access Denied" للمجلدات
**الحل**:
\`\`\`bash
# إعطاء صلاحيات للمجلدات المطلوبة
chmod 777 runtime/
chmod 777 web/assets/
chmod 755 yii
\`\`\`

#### المستخدم لا يستطيع الوصول لوحدة معينة
**الحل**:
- تأكد من أن المستخدم لديه الـ role المناسب
- تحقق من إعداد AccessControl في Controller
- تأكد من تسجيل الدخول بنجاح

### 🚀 مشاكل الإنتاج - Production Issues

#### الموقع بطيء جداً
**الحل**:
\`\`\`bash
# تفعيل schema cache
# في config/web.php ضبط enableSchemaCache = true

# تحسين autoloader
composer install --no-dev --optimize-autoloader

# ضغط CSS
npm run build-css
\`\`\`

#### خطأ 500 في الإنتاج
**الحل**:
\`\`\`bash
# تحقق من log files
cat runtime/logs/app.log

# تأكد من ضبط متغيرات البيئة
export YII_ENV="prod"
export YII_DEBUG=false
\`\`\`

### 🧪 مشاكل الاختبارات - Testing Issues

#### الاختبارات تفشل بسبب أصول Bootstrap
**الحل**:
\`\`\`bash
# إعادة إعداد البيئة للاختبار
export YII_ENV=test
vendor/bin/codecept build
\`\`\`

#### اختبارات قاعدة البيانات تفشل
**الحل**:
\`\`\`bash
# استخدم قاعدة بيانات منفصلة للاختبار
# في config/test_db.php
\`\`\`

### 📞 الحصول على المساعدة - Getting Help

#### الموارد المفيدة
- [Yii2 Guide](https://www.yiiframework.com/doc/guide/2.0/en) - الدليل الرسمي
- [Codeception Docs](https://codeception.com/docs) - دليل الاختبارات
- [GitHub Issues](https://github.com/muhaned85/yii2_hr_system/issues) - تقرير مشاكل

#### أوامر التشخيص المفيدة
\`\`\`bash
# فحص متطلبات النظام
php requirements.php

# معلومات PHP
php --version && php -m

# حالة Composer
composer --version && composer diagnose

# حالة npm والـ packages
npm --version && npm list --depth=0
\`\`\`

### CI/CD
يتم تشغيل الاختبارات تلقائياً عبر GitHub Actions عند:
- Push إلى branches رئيسية
- إنشاء Pull Request
- دعم PHP 8.1, 8.2, 8.3
- اختبار SQLite و MySQL

## الوحدات والميزات - Modules & Features

### 🏦 وحدة البنوك - Banks Module
**المسار**: `/bank`
- **الوظائف**: إدارة بيانات البنوك وأكوادها
- **العمليات**: إضافة، تعديل، حذف، عرض البنوك
- **الحقول**: الاسم، الاسم العربي، الكود، كود SWIFT، العنوان، الهاتف، الإيميل
- **API Endpoints**:
  - `GET /bank/index` - عرض جميع البنوك
  - `GET /bank/view/{id}` - عرض بنك محدد
  - `POST /bank/create` - إنشاء بنك جديد
  - `PUT /bank/update/{id}` - تحديث بنك
  - `DELETE /bank/delete/{id}` - حذف بنك

### 🤝 وحدة الشركاء - Partners Module
**المسار**: `/partner`
- **الوظائف**: إدارة الشركاء التجاريين والموردين
- **العمليات**: إدارة كاملة لبيانات الشركاء
- **الحقول**: الاسم، النوع، الشخص المسؤول، معلومات الاتصال
- **الأنواع**: Technology Provider, Training Provider, Office Supplier

### 👥 وحدة المستخدمين - Users Module
**المسار**: `/user`
- **الوظائف**: إدارة مستخدمي النظام والأدوار
- **الأدوار**: admin, hr, finance, employee
- **العمليات**: إدارة الحسابات والصلاحيات

### 👨‍💼 وحدة الموظفين - Employees Module
**المسار**: `/employee`
- **الوظائف**: إدارة بيانات الموظفين الشاملة
- **الحقول**: البيانات الشخصية، الراتب، البنك، القسم، المنصب
- **الربط**: مرتبطة بوحدة البنوك لحسابات الرواتب

### 💰 وحدة كشوف الرواتب - Payroll Module
**المسار**: `/payroll`
- **الوظائف**: إدارة الرواتب والمستحقات الشهرية
- **العمليات**: حساب وطباعة كشوف الرواتب
- **الحقول**: الراتب الأساسي، البدلات، الخصومات، الصافي

## إعداد RBAC - RBAC Setup

### الأدوار المتاحة - Available Roles
- **admin**: مدير النظام - وصول كامل لجميع الوحدات
- **hr**: موارد بشرية - إدارة الموظفين والمستخدمين
- **finance**: مالية - إدارة الرواتب والبنوك
- **employee**: موظف - عرض البيانات الشخصية فقط

### إعداد RBAC يدوياً - Manual RBAC Setup
\`\`\`bash
# إضافة مكون RBAC إلى config/web.php
'authManager' => [
    'class' => 'yii\\rbac\\DbManager',
],
\`\`\`

### أوامر إعداد الأدوار - Role Setup Commands
\`\`\`bash
# إنشاء جداول RBAC
php yii migrate --migrationPath=@yii/rbac/migrations --interactive=0

# يمكن إضافة الأدوار يدوياً عبر وحدة الإدارة
\`\`\`

## البيانات الأولية - Initial Data

### حسابات المستخدمين - User Accounts
| اسم المستخدم | كلمة المرور | الصلاحية |
|-------------|-----------|---------|
| admin | admin123 | مدير النظام |
| hr_manager | hr123 | موارد بشرية |
| finance_manager | finance123 | مالية |

### البيانات النموذجية - Sample Data
- **3 بنوك مصرية**: البنك الأهلي، بنك مصر، البنك التجاري الدولي
- **3 شركاء تجاريين**: مقدم تقني، مركز تدريب، مورد مكتبي
- **4 موظفين نموذجيين**: مطور، أخصائي HR، محاسب، أخصائي تسويق
- **ربط البيانات**: الموظفين مربوطين بالبنوك لحسابات الرواتب

## المساهمة - Contributing

### خطوات المساهمة - Contribution Steps
1. Fork المشروع
2. إنشاء branch جديد (\`git checkout -b feature/amazing-feature\`)
3. Commit التغييرات (\`git commit -m 'Add amazing feature'\`)
4. Push إلى Branch (\`git push origin feature/amazing-feature\`)
5. إنشاء Pull Request

### معايير الكود - Code Standards
- PSR-12 Coding Standard
- Yii2 Best Practices
- Arabic comments for Arabic features
- English comments for technical features

## الترخيص - License

هذا المشروع مرخص تحت MIT License - راجع ملف [LICENSE](LICENSE) للتفاصيل.

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📚 الدعم والوثائق - Documentation & Support

### دلائل شاملة - Comprehensive Guides
- **[دليل المطورين التفصيلي](DEVELOPER.md)** - إرشادات تفصيلية للتطوير والإسهام
- **[دليل واجهة البرمجة التطبيقية](API.md)** - وثائق شاملة لـ REST API
- **[دليل Yii2 الرسمي](https://www.yiiframework.com/doc/guide/2.0/en)** - الوثائق الرسمية لإطار العمل

### المساعدة والدعم - Help & Support
- **Issues**: [GitHub Issues](https://github.com/muhaned85/yii2_hr_system/issues) - للإبلاغ عن المشاكل
- **Discussions**: [GitHub Discussions](https://github.com/muhaned85/yii2_hr_system/discussions) - للنقاش والأسئلة
- **Wiki**: [Project Wiki](https://github.com/muhaned85/yii2_hr_system/wiki) - معلومات إضافية

### أدوات مفيدة - Useful Tools
- **[Postman Collection](API.md#postman-collection)** - مجموعة طلبات API جاهزة
- **[OpenAPI Specification](API.md#openapi-specification)** - مواصفات API معيارية

## شكر وتقدير - Acknowledgments

- [Yii Framework](https://www.yiiframework.com/) - إطار العمل الأساسي
- [Tailwind CSS](https://tailwindcss.com/) - إطار عمل CSS
- [Cairo Font](https://fonts.google.com/specimen/Cairo) - خط عربي جميل

---

**تم بناؤه بـ ❤️ للمجتمع العربي المطور**  
**Built with ❤️ for the Arabic Developer Community**