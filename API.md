# API Documentation - دليل واجهة البرمجة التطبيقية

## 📋 فهرس المحتويات - Table of Contents
- [مقدمة](#introduction)
- [المصادقة](#authentication)
- [هيكل الاستجابة](#response-structure)
- [معالجة الأخطاء](#error-handling)
- [واجهات الوحدات](#module-apis)
  - [Banks API](#banks-api)
  - [Partners API](#partners-api)
  - [Users API](#users-api)
  - [Employees API](#employees-api)
  - [Payroll API](#payroll-api)
- [أمثلة الاستخدام](#usage-examples)
- [SDK وأدوات التطوير](#sdk-tools)

## 🚀 مقدمة - Introduction

واجهة البرمجة التطبيقية لنظام إدارة الموارد البشرية توفر وصولاً برمجياً لجميع وظائف النظام عبر REST API.

### المواصفات الأساسية - Base Specifications
- **Protocol**: HTTP/HTTPS
- **Format**: JSON
- **Base URL**: `http://localhost:8080` (development)
- **API Version**: v1 (included in URL path)
- **Character Encoding**: UTF-8
- **Date Format**: ISO 8601 (YYYY-MM-DD)
- **Timezone**: UTC

### محتوى العينة - Content Types
```http
Content-Type: application/json
Accept: application/json
Accept-Language: ar,en
```

## 🔐 المصادقة - Authentication

### تسجيل الدخول - Login
```http
POST /site/login
Content-Type: application/json

{
  "username": "admin",
  "password": "admin123"
}

Response:
{
  "status": "success",
  "message": "تم تسجيل الدخول بنجاح",
  "data": {
    "user": {
      "id": 1,
      "username": "admin",
      "role": "admin",
      "permissions": ["banks.view", "banks.create", "users.manage"]
    },
    "session": {
      "expires_at": "2024-01-01T12:00:00Z"
    }
  }
}
```

### استخدام Session
```http
GET /bank/index
Cookie: PHPSESSID=abc123def456
```

### تسجيل الخروج - Logout
```http
POST /site/logout

Response:
{
  "status": "success",
  "message": "تم تسجيل الخروج بنجاح"
}
```

## 📊 هيكل الاستجابة - Response Structure

### استجابة ناجحة - Success Response
```json
{
  "status": "success",
  "message": "تم تنفيذ العملية بنجاح",
  "data": {
    // البيانات المطلوبة
  },
  "meta": {
    "timestamp": "2024-01-01T12:00:00Z",
    "execution_time": 0.123,
    "pagination": {
      "current_page": 1,
      "per_page": 20,
      "total": 100,
      "total_pages": 5
    }
  }
}
```

### استجابة فاشلة - Error Response
```json
{
  "status": "error",
  "message": "فشل في تنفيذ العملية",
  "error": {
    "code": "VALIDATION_ERROR",
    "details": {
      "name": ["حقل الاسم مطلوب"],
      "email": ["البريد الإلكتروني غير صحيح"]
    }
  },
  "meta": {
    "timestamp": "2024-01-01T12:00:00Z"
  }
}
```

## ❌ معالجة الأخطاء - Error Handling

### أكواد حالة HTTP - HTTP Status Codes
| Code | Status | Description |
|------|--------|-------------|
| 200  | OK     | نجح الطلب |
| 201  | Created | تم الإنشاء بنجاح |
| 204  | No Content | نجح بدون محتوى |
| 400  | Bad Request | طلب خاطئ |
| 401  | Unauthorized | غير مخول |
| 403  | Forbidden | محظور |
| 404  | Not Found | غير موجود |
| 422  | Unprocessable Entity | خطأ في التحقق |
| 429  | Too Many Requests | طلبات كثيرة |
| 500  | Internal Server Error | خطأ خادم |

### أكواد الأخطاء المخصصة - Custom Error Codes
```json
{
  "error": {
    "code": "BANK_NOT_FOUND",
    "message": "البنك المطلوب غير موجود",
    "details": {
      "bank_id": 999
    }
  }
}
```

| Error Code | Description |
|------------|-------------|
| `VALIDATION_ERROR` | خطأ في التحقق من البيانات |
| `BANK_NOT_FOUND` | البنك غير موجود |
| `EMPLOYEE_NOT_FOUND` | الموظف غير موجود |
| `PARTNER_NOT_FOUND` | الشريك غير موجود |
| `INSUFFICIENT_PERMISSIONS` | صلاحيات غير كافية |
| `DUPLICATE_ENTRY` | بيانات مكررة |

## 🏦 Banks API - واجهة البنوك

### الحصول على جميع البنوك - Get All Banks
```http
GET /bank/index?page=1&per_page=20&status=1

Query Parameters:
- page: رقم الصفحة (افتراضي: 1)
- per_page: عدد العناصر في الصفحة (افتراضي: 20، أقصى: 100)
- status: حالة البنك (1=نشط، 0=غير نشط)
- search: البحث في الاسم أو الكود

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
      "address": "Kasr El Nil Branch, Cairo",
      "address_ar": "فرع قصر النيل، القاهرة",
      "phone": "+20227702222",
      "email": "info@nbe.com.eg",
      "status": 1,
      "created_at": "2024-01-01T10:00:00Z",
      "updated_at": "2024-01-01T10:00:00Z",
      "employees_count": 15
    }
  ],
  "meta": {
    "pagination": {
      "current_page": 1,
      "per_page": 20,
      "total": 3,
      "total_pages": 1
    }
  }
}
```

### الحصول على بنك محدد - Get Specific Bank
```http
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
    "created_at": "2024-01-01T10:00:00Z",
    "updated_at": "2024-01-01T10:00:00Z",
    "employees": [
      {
        "id": 1,
        "employee_id": "EMP001",
        "name": "Mohamed Ali",
        "name_ar": "محمد علي",
        "department": "IT"
      }
    ]
  }
}
```

### إنشاء بنك جديد - Create New Bank
```http
POST /bank/create
Content-Type: application/json

{
  "name": "New Bank",
  "name_ar": "البنك الجديد",
  "code": "NB",
  "swift_code": "NEWBEGCX",
  "address": "New Address",
  "address_ar": "العنوان الجديد",
  "phone": "+20123456789",
  "email": "info@newbank.com",
  "status": 1
}

Response (201):
{
  "status": "success",
  "message": "تم إنشاء البنك بنجاح",
  "data": {
    "id": 4,
    "name": "New Bank",
    "code": "NB"
  }
}
```

### تحديث بنك - Update Bank
```http
PUT /bank/update/{id}
Content-Type: application/json

{
  "name": "Updated Bank Name",
  "phone": "+20123456789",
  "status": 0
}

Response:
{
  "status": "success",
  "message": "تم تحديث البنك بنجاح",
  "data": {
    "id": 4,
    "name": "Updated Bank Name"
  }
}
```

### حذف بنك - Delete Bank
```http
DELETE /bank/delete/{id}

Response:
{
  "status": "success",
  "message": "تم حذف البنك بنجاح"
}
```

## 🤝 Partners API - واجهة الشركاء

### الحصول على جميع الشركاء - Get All Partners
```http
GET /partner/index?type=Technology Provider

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
      "email": "john@abc-tech.com",
      "address": "123 Tech Street, New Cairo",
      "address_ar": "123 شارع التكنولوجيا، القاهرة الجديدة",
      "status": 1
    }
  ]
}
```

### إنشاء شريك جديد - Create New Partner
```http
POST /partner/create

{
  "name": "New Partner",
  "name_ar": "شريك جديد",
  "code": "NP",
  "type": "Service Provider",
  "contact_person": "Ahmed Ali",
  "phone": "+20101234567",
  "email": "ahmed@newpartner.com",
  "address": "New Address",
  "address_ar": "عنوان جديد"
}
```

## 👥 Users API - واجهة المستخدمين

### الحصول على جميع المستخدمين - Get All Users
```http
GET /user/index?role=hr

Response:
{
  "status": "success",
  "data": [
    {
      "id": 2,
      "username": "hr_manager",
      "email": "hr@company.com",
      "first_name": "HR",
      "last_name": "Manager",
      "first_name_ar": "مدير",
      "last_name_ar": "الموارد البشرية",
      "phone": "+20101111112",
      "role": "hr",
      "status": 1,
      "last_login": "2024-01-01T09:00:00Z"
    }
  ]
}
```

### إنشاء مستخدم جديد - Create New User
```http
POST /user/create

{
  "username": "new_user",
  "email": "newuser@company.com",
  "password": "SecurePass123",
  "first_name": "New",
  "last_name": "User",
  "first_name_ar": "مستخدم",
  "last_name_ar": "جديد",
  "phone": "+20101234567",
  "role": "employee"
}
```

### تحديث صلاحيات المستخدم - Update User Permissions
```http
PUT /user/update-permissions/{id}

{
  "role": "hr",
  "permissions": [
    "employees.view",
    "employees.create",
    "employees.update"
  ]
}
```

## 👨‍💼 Employees API - واجهة الموظفين

### الحصول على جميع الموظفين - Get All Employees
```http
GET /employee/index?department=IT&status=1

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
      "full_name": "Mohamed Ali",
      "full_name_ar": "محمد علي",
      "email": "mohamed.ali@company.com",
      "phone": "+20101234560",
      "national_id": "12345678901234",
      "department": "IT",
      "position": "Software Developer",
      "hire_date": "2024-01-15",
      "salary": 15000.00,
      "bank": {
        "id": 1,
        "name": "National Bank of Egypt",
        "code": "NBE"
      },
      "bank_account": "1234567890123456",
      "status": 1
    }
  ]
}
```

### إنشاء موظف جديد - Create New Employee
```http
POST /employee/create

{
  "employee_id": "EMP005",
  "first_name": "Ahmed",
  "last_name": "Hassan",
  "first_name_ar": "أحمد",
  "last_name_ar": "حسن",
  "email": "ahmed.hassan@company.com",
  "phone": "+20101234565",
  "national_id": "12345678901238",
  "department": "Finance",
  "position": "Financial Analyst",
  "hire_date": "2024-02-01",
  "salary": 14000.00,
  "bank_id": 2,
  "bank_account": "9876543210987654"
}
```

### تحديث راتب موظف - Update Employee Salary
```http
PUT /employee/update-salary/{id}

{
  "salary": 16000.00,
  "effective_date": "2024-02-01",
  "reason": "Annual increment"
}
```

### الحصول على تاريخ الرواتب - Get Salary History
```http
GET /employee/{id}/salary-history

Response:
{
  "status": "success",
  "data": [
    {
      "salary": 15000.00,
      "effective_date": "2024-01-15",
      "reason": "Initial salary"
    },
    {
      "salary": 16000.00,
      "effective_date": "2024-02-01",
      "reason": "Annual increment"
    }
  ]
}
```

## 💰 Payroll API - واجهة الرواتب

### الحصول على كشوف الرواتب - Get Payrolls
```http
GET /payroll/index?year=2024&month=1&employee_id=1

Response:
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "employee": {
        "id": 1,
        "employee_id": "EMP001",
        "name": "Mohamed Ali",
        "name_ar": "محمد علي",
        "department": "IT"
      },
      "period": {
        "year": 2024,
        "month": 1,
        "month_name": "يناير",
        "days_worked": 22,
        "total_days": 31
      },
      "salary": {
        "basic": 15000.00,
        "allowances": {
          "transportation": 500.00,
          "housing": 1000.00,
          "total": 1500.00
        },
        "deductions": {
          "insurance": 300.00,
          "tax": 200.00,
          "total": 500.00
        },
        "gross": 16500.00,
        "net": 16000.00
      },
      "bank_transfer": {
        "bank_name": "National Bank of Egypt",
        "account_number": "1234567890123456",
        "transfer_date": "2024-01-30"
      },
      "status": "paid",
      "generated_at": "2024-01-25T10:00:00Z",
      "paid_at": "2024-01-30T14:00:00Z"
    }
  ]
}
```

### إنشاء كشف راتب - Generate Payroll
```http
POST /payroll/generate

{
  "employee_id": 1,
  "year": 2024,
  "month": 2,
  "basic_salary": 15000.00,
  "allowances": {
    "transportation": 500.00,
    "housing": 1000.00
  },
  "deductions": {
    "insurance": 300.00,
    "tax": 200.00
  },
  "days_worked": 20
}

Response:
{
  "status": "success",
  "message": "تم إنشاء كشف الراتب بنجاح",
  "data": {
    "id": 25,
    "net_salary": 16000.00,
    "payroll_pdf": "/downloads/payroll_EMP001_2024_02.pdf"
  }
}
```

### تصدير كشوف الرواتب - Export Payrolls
```http
GET /payroll/export?year=2024&month=1&format=excel

Response:
{
  "status": "success",
  "data": {
    "download_url": "/downloads/payrolls_2024_01.xlsx",
    "expires_at": "2024-01-01T18:00:00Z"
  }
}
```

### إحصائيات الرواتب - Payroll Statistics
```http
GET /payroll/statistics?year=2024

Response:
{
  "status": "success",
  "data": {
    "total_employees": 45,
    "total_payroll": 675000.00,
    "average_salary": 15000.00,
    "by_department": [
      {
        "department": "IT",
        "employees": 15,
        "total": 225000.00,
        "average": 15000.00
      },
      {
        "department": "HR",
        "employees": 10,
        "total": 120000.00,
        "average": 12000.00
      }
    ],
    "monthly_trend": [
      {
        "month": 1,
        "total": 675000.00,
        "employees": 45
      }
    ]
  }
}
```

## 🛠️ أمثلة الاستخدام - Usage Examples

### JavaScript/Fetch API
```javascript
// مساعد للطلبات
class HRSystemAPI {
  constructor(baseUrl = 'http://localhost:8080') {
    this.baseUrl = baseUrl;
  }

  async request(endpoint, options = {}) {
    const url = `${this.baseUrl}${endpoint}`;
    const config = {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
      credentials: 'same-origin',
      ...options
    };

    if (options.data) {
      config.body = JSON.stringify(options.data);
    }

    const response = await fetch(url, config);
    const data = await response.json();
    
    if (!response.ok) {
      throw new Error(data.message || 'API Error');
    }
    
    return data;
  }

  // Banks
  async getBanks(params = {}) {
    const query = new URLSearchParams(params).toString();
    return this.request(`/bank/index?${query}`);
  }

  async createBank(bankData) {
    return this.request('/bank/create', {
      method: 'POST',
      data: bankData
    });
  }

  // Employees
  async getEmployees(params = {}) {
    const query = new URLSearchParams(params).toString();
    return this.request(`/employee/index?${query}`);
  }

  async generatePayroll(payrollData) {
    return this.request('/payroll/generate', {
      method: 'POST',
      data: payrollData
    });
  }
}

// الاستخدام
const api = new HRSystemAPI();

// الحصول على البنوك
api.getBanks({ status: 1 })
  .then(response => {
    console.log('Banks:', response.data);
  })
  .catch(error => {
    console.error('Error:', error.message);
  });

// إنشاء بنك جديد
api.createBank({
  name: 'Test Bank',
  name_ar: 'بنك التجربة',
  code: 'TB'
})
.then(response => {
  console.log('Bank created:', response.data);
});
```

### PHP/Guzzle
```php
<?php
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;

class HRSystemAPI
{
    private $client;
    private $cookieJar;

    public function __construct($baseUrl = 'http://localhost:8080')
    {
        $this->cookieJar = new CookieJar();
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'cookies' => $this->cookieJar,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
    }

    public function login($username, $password)
    {
        $response = $this->client->post('/site/login', [
            'json' => [
                'username' => $username,
                'password' => $password
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getBanks($params = [])
    {
        $response = $this->client->get('/bank/index', [
            'query' => $params
        ]);

        return json_decode($response->getBody(), true);
    }

    public function createEmployee($employeeData)
    {
        $response = $this->client->post('/employee/create', [
            'json' => $employeeData
        ]);

        return json_decode($response->getBody(), true);
    }
}

// الاستخدام
$api = new HRSystemAPI();

// تسجيل الدخول
$loginResult = $api->login('admin', 'admin123');
echo "Login: " . $loginResult['message'] . "\n";

// الحصول على البنوك
$banks = $api->getBanks(['status' => 1]);
foreach ($banks['data'] as $bank) {
    echo "Bank: {$bank['name']} ({$bank['code']})\n";
}

// إنشاء موظف جديد
$newEmployee = $api->createEmployee([
    'employee_id' => 'EMP006',
    'first_name' => 'Ahmed',
    'last_name' => 'Ali',
    'email' => 'ahmed.ali@company.com',
    'department' => 'IT',
    'salary' => 15000
]);
echo "Employee created: " . $newEmployee['message'] . "\n";
```

### Python/Requests
```python
import requests
import json

class HRSystemAPI:
    def __init__(self, base_url='http://localhost:8080'):
        self.base_url = base_url
        self.session = requests.Session()
        self.session.headers.update({
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        })

    def login(self, username, password):
        response = self.session.post(f'{self.base_url}/site/login', 
                                   json={'username': username, 'password': password})
        return response.json()

    def get_banks(self, **params):
        response = self.session.get(f'{self.base_url}/bank/index', params=params)
        return response.json()

    def create_payroll(self, payroll_data):
        response = self.session.post(f'{self.base_url}/payroll/generate', 
                                   json=payroll_data)
        return response.json()

# الاستخدام
api = HRSystemAPI()

# تسجيل الدخول
login_result = api.login('admin', 'admin123')
print(f"Login: {login_result['message']}")

# الحصول على البنوك
banks = api.get_banks(status=1)
for bank in banks['data']:
    print(f"Bank: {bank['name']} ({bank['code']})")

# إنشاء كشف راتب
payroll = api.create_payroll({
    'employee_id': 1,
    'year': 2024,
    'month': 2,
    'basic_salary': 15000.00,
    'allowances': {'transportation': 500.00},
    'deductions': {'insurance': 300.00}
})
print(f"Payroll generated: {payroll['data']['net_salary']}")
```

## 📦 SDK وأدوات التطوير - SDK & Development Tools

### Postman Collection
```json
{
  "info": {
    "name": "HR System API",
    "description": "مجموعة طلبات API لنظام إدارة الموارد البشرية"
  },
  "variable": [
    {
      "key": "base_url",
      "value": "http://localhost:8080"
    }
  ],
  "item": [
    {
      "name": "Authentication",
      "item": [
        {
          "name": "Login",
          "request": {
            "method": "POST",
            "header": [],
            "body": {
              "mode": "raw",
              "raw": "{\n  \"username\": \"admin\",\n  \"password\": \"admin123\"\n}"
            },
            "url": "{{base_url}}/site/login"
          }
        }
      ]
    }
  ]
}
```

### OpenAPI Specification
```yaml
openapi: 3.0.0
info:
  title: HR System API
  description: واجهة البرمجة التطبيقية لنظام إدارة الموارد البشرية
  version: 1.0.0
  contact:
    name: HR System Support
    email: support@hr-system.com

servers:
  - url: http://localhost:8080
    description: Development server

paths:
  /bank/index:
    get:
      summary: الحصول على جميع البنوك
      parameters:
        - name: page
          in: query
          schema:
            type: integer
            default: 1
        - name: per_page
          in: query
          schema:
            type: integer
            default: 20
            maximum: 100
      responses:
        '200':
          description: قائمة البنوك
          content:
            application/json:
              schema:
                type: object
                properties:
                  status:
                    type: string
                    enum: [success]
                  data:
                    type: array
                    items:
                      $ref: '#/components/schemas/Bank'

components:
  schemas:
    Bank:
      type: object
      properties:
        id:
          type: integer
        name:
          type: string
        name_ar:
          type: string
        code:
          type: string
```

---

## 📞 الدعم والمساعدة - Support

للحصول على المساعدة أو الإبلاغ عن المشاكل:
- **GitHub Issues**: [Project Issues](https://github.com/muhaned85/yii2_hr_system/issues)
- **Email**: support@hr-system.com
- **Documentation**: [Developer Guide](./DEVELOPER.md)