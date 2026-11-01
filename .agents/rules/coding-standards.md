---
trigger: glob
globs: ["app/**/*.php", "routes/**/*.php", "database/**/*.php", "resources/**/*.blade.php"]
---

# Coding Standards

- التزم PSR-12 وLaravel conventions وLaravel Pint.
- استخدم strict types في الملفات الجديدة حيث يتوافق ذلك مع أسلوب المشروع.
- أسماء واضحة، methods صغيرة، ومسؤولية واحدة لكل class قدر الإمكان.
- استخدم Form Requests للتحقق من مدخلات HTTP.
- استخدم Enums للقيم الثابتة ذات المعنى عندما تكون مناسبة.
- لا تكرر منطق الأعمال؛ استخرج منطقاً مشتركاً فقط عند وجود تكرار حقيقي.
- لا تستخدم magic strings متكررة أو أرقاماً سحرية.
- لا تضف تعليقات تشرح كوداً واضحاً؛ وثّق السبب والقيود غير البديهية.
- لا تستخدم `dd`, `dump`, `var_dump`, `ray` أو debug code في التسليم.
