---
trigger: always_on
---

# Version Policy

المراجع الأساسية: `docs/TECH_STACK.md` وملفات lock.

- لا تستخدم API من إصدار غير الإصدار المثبت.
- تحقق من PHP/Laravel/Livewire/Tailwind compatibility قبل اعتماد الحل.
- افحص composer.lock وpackage-lock.json قبل أي اقتراح package.
- لا تكتب أرقام patch غير متحققة في ملفات الاعتماديات.
- لا تستخدم `latest` أو floating tags في الإنتاج.
- أي ترقية تحتاج تقريراً: السبب، التوافق، breaking changes، خطة rollback، الاختبارات.
- إذا تعذر الوصول إلى التوثيق الرسمي، صرح بذلك ولا تخمن.
