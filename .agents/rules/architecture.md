---
trigger: always_on
---

# Architecture Rules

- اتبع Modular Monolith. لا تنشئ microservice أو خدمة مستقلة دون قرار معماري موثق.
- تنظيم المجال المقترح: Properties, Listings, Locations, Agencies, Leads, ViewingAppointments, Media, Subscriptions, Identity, Content, Notifications.
- افصل الكيانات العقارية عن الإعلانات: Property يصف الأصل؛ Listing يمثل عرض بيع أو إيجار له دورة حياة وسعر وحالة وناشر.
- لا تنشئ abstraction أو repository لكل Model بشكل آلي؛ استخدم أبسط تصميم يحقق فصل المسؤوليات.
- ضع قرارات المعمارية المؤثرة في `docs/DECISIONS.md`.
- لا تنقل مجلدات أو تغير namespaces دون موافقة.
- لا تضف event-driven infrastructure أو microservices قبل وجود حاجة موثقة.
