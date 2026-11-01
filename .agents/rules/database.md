---
trigger: glob
globs: ["app/Models/**/*.php", "database/**/*.php", "app/Actions/**/*.php", "app/Services/**/*.php"]
---

# Database Rules

- افحص schema والعلاقات الحالية قبل إنشاء migration أو تعديل query.
- لا تنفذ DROP أو TRUNCATE أو حذف/إعادة تسمية أعمدة دون موافقة صريحة.
- استخدم decimal للمبالغ المالية وحدد precision/scale وفق متطلبات موثقة.
- أضف foreign keys وunique constraints عند توافقها مع قواعد المجال.
- لا تضف index دون ربطه باستعلام أو قيد متوقع.
- راعِ eager loading وN+1 وpagination.
- استخدم transactions للعمليات متعددة الخطوات.
- لا تخزن الصور/الملفات داخل قاعدة البيانات.
- تجنب JSON للبيانات التي تحتاج filtering أو sorting أو relations.
- migrations يجب أن تكون قابلة للتراجع بقدر الإمكان.
