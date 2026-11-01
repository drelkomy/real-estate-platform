---
trigger: glob
globs: ["app/**/*.php", "routes/**/*.php", "resources/**/*.blade.php", "database/**/*.php", "docker/**/*"]
---

# Security Rules

- طبق مبدأ deny-by-default للصلاحيات.
- كل عملية قراءة/تعديل/حذف لمورد خاص يجب أن تتحقق من ownership أو policy على الخادم.
- تحقق من صحة المدخلات عبر Form Requests وقواعد validation محددة.
- استخدم Eloquent أو parameter binding؛ ممنوع تركيب SQL من مدخلات المستخدم.
- حافظ على Blade escaping ولا تستخدم `{!! !!}` لبيانات المستخدم غير المنقاة.
- لا تثق في hidden inputs أو IDs المرسلة من العميل.
- تحقق من MIME الحقيقي وحجم وأبعاد الصور عند الرفع، واسمح بقائمة امتدادات محددة.
- خزن الملفات الخاصة خارج public root واستخدم authorized download endpoints.
- لا تعرض مسارات الملفات الداخلية أو stack traces.
- لا تسجل secrets أو passwords أو access tokens أو بيانات حساسة.
- أضف rate limits للنقاط المعرضة للإساءة.
- لا تغير إعدادات الحماية أو middleware دون توثيق وموافقة.
