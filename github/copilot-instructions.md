# مشروع HR System (Yii2) — تعليمات للوكيل

## الهدف
بناء Modular Monolith بـ Yii2 (PHP 8.2+) مع Tailwind CSS وواجهة عربية حديثة.

## البنية
- تطبيق Yii2 أساسي داخل `app/` (يمكن للوكيل إنشاءه عبر composer).
- موديولات داخل `app/modules/{bank,partner,user,employee,payroll}` كل موديول:
  - Models, Controllers, Views, Migrations, Services.
  - Routes عبر module/controller/action.
- RBAC بسيط (roles: admin, hr, finance, employee).
- استخدام SQLite للتجارب والاختبارات داخل CI، وMySQL للإنتاج (ملفات تهيئة منفصلة).

## الواجهة
- Tailwind CSS مدموج عبر npm + asset bundle في Yii2.
- قوالب أساسية في `app/views/layouts` مع Navbar جانبي ولوحة تحكم.

## الأوامر القياسية (للـ CI والوكيل)
- تثبيت: `composer install` (في `app/`)
- إعداد مفاتيح Yii2 (إن لزم): `php init --env=Development --overwrite=All`
- إعداد Tailwind: `npm ci && npx tailwindcss -i @webroot/css/input.css -o @webroot/css/tailwind.css --minify`
- ترحيلات DB (SQLite افتراضيًا CI): `php yii migrate --interactive=0`
- اختبارات: `vendor/bin/codecept run` (اختياري: PHPUnit)

## معايير الكود
- PHP 8.2, Yii2 آخر إصدار مستقر.
- طبقة Service لكل منطق معقّد.
- اختبارات مبدئية للـ Models وControllers الأساسية.

## المهام الأولى التي يجب على الوكيل تنفيذها
1. إنشاء سكافولد Yii2 في `app/` (basic أو advanced) وتوصيله بـ Tailwind.
2. إنشاء الموديولات الخمسة مع موديليّ الهجرة والجداول الأساسية.
3. إعداد RBAC بسيط وأدوار افتراضية وبذور بيانات (seeds).
4. إنشاء صفحات CRUD لكل موديول + Dashboard أولي.
5. تهيئة CI عبر GitHub Actions (PHP + Node) وتشغيل الاختبارات.
