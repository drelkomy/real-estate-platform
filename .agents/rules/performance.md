---
trigger: glob
globs: ["app/**/*.php", "resources/**/*.blade.php", "routes/**/*.php"]
---

# Performance Rules

- لا تنفذ queries داخل loops أو Blade loops دون تحليل.
- استخدم eager loading للعلاقات المعروضة.
- استخدم pagination للنتائج؛ لا تعرض كل العقارات دفعة واحدة.
- استخدم Redis cache للبيانات المتكررة فقط مع سياسة invalidation واضحة.
- لا تخزن بيانات خاصة في cache بمفتاح لا يتضمن نطاق المستخدم/المستأجر عند الحاجة.
- استخدم queues للمهام البطيئة مثل معالجة الصور والإشعارات والبريد.
- لا تستخدم queue لكل عملية صغيرة دون مبرر.
- راقب حجم payload وعدد الاستعلامات.
- لا تضف caching قبل تحديد مصدر الحقيقة وآلية إبطال cache.
