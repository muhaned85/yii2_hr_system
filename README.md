# نظام إدارة الموارد البشرية - HR System

نظام إدارة الموارد البشرية مبني بـ Yii2 مع واجهة مستخدم عربية حديثة باستخدام Tailwind CSS.

A modern HR Management System built with Yii2 Framework featuring Arabic-first UI with Tailwind CSS.

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

## التطوير - Development

### أوامر مفيدة - Useful Commands
\`\`\`bash
# إنشاء migration جديد
php yii migrate/create migration_name

# إنشاء model جديد
php yii gii/model --tableName=table_name

# تشغيل الاختبارات
vendor/bin/codecept run

# تنظيف cache
php yii cache/flush-all
\`\`\`

### بنية المشروع - Project Structure
\`\`\`
app/
├── config/          # ملفات الإعداد
├── controllers/     # Controllers الأساسية
├── models/          # Models الأساسية
├── modules/         # الوحدات المعيارية
│   ├── bank/       # وحدة البنوك
│   ├── partner/    # وحدة الشركاء
│   ├── user/       # وحدة المستخدمين
│   ├── employee/   # وحدة الموظفين
│   └── payroll/    # وحدة الرواتب
├── views/          # القوالب الأساسية
├── web/            # الملفات العامة
│   ├── css/        # ملفات CSS
│   └── assets/     # الأصول المولدة
├── migrations/     # ملفات قاعدة البيانات
└── runtime/        # ملفات التشغيل
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
\`\`\`

### CI/CD
يتم تشغيل الاختبارات تلقائياً عبر GitHub Actions عند:
- Push إلى branches رئيسية
- إنشاء Pull Request
- دعم PHP 8.1, 8.2, 8.3
- اختبار SQLite و MySQL

## البيانات الأولية - Initial Data

### حسابات المستخدمين - User Accounts
| اسم المستخدم | كلمة المرور | الصلاحية |
|-------------|-----------|---------|
| admin | admin123 | مدير النظام |
| hr_manager | hr123 | موارد بشرية |
| finance_manager | finance123 | مالية |

### البيانات النموذجية - Sample Data
- 3 بنوك مصرية رئيسية
- 3 شركاء تجاريين
- 4 موظفين نموذجيين
- ربط الموظفين بالبنوك

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

## الدعم - Support

- **Issues**: [GitHub Issues](https://github.com/muhaned85/yii2_hr_system/issues)
- **Discussions**: [GitHub Discussions](https://github.com/muhaned85/yii2_hr_system/discussions)
- **Documentation**: [Yii2 Framework Guide](https://www.yiiframework.com/doc/guide/2.0/en)

## شكر وتقدير - Acknowledgments

- [Yii Framework](https://www.yiiframework.com/) - إطار العمل الأساسي
- [Tailwind CSS](https://tailwindcss.com/) - إطار عمل CSS
- [Cairo Font](https://fonts.google.com/specimen/Cairo) - خط عربي جميل

---

**تم بناؤه بـ ❤️ للمجتمع العربي المطور**  
**Built with ❤️ for the Arabic Developer Community**