# Skill: Code Review

راجع التغييرات دون تعديلها أولاً.

تحقق من:
- مطابقة المتطلبات والخطة.
- حدود الملفات وعدم وجود تغييرات جانبية.
- Authorization وownership وvalidation.
- SQL injection وXSS وCSRF وIDOR وmass assignment.
- N+1 وpagination وcache invalidation.
- التوافق مع الإصدارات المثبتة.
- الاختبارات وجودة assertions.
- عدم تسريب أسرار أو بيانات شخصية في logs.
- وضوح الكود وقابلية الصيانة.

صنف الملاحظات: Critical / High / Medium / Low.
لا تقل إن الكود آمن تماماً؛ اذكر نطاق المراجعة وحدودها.
