{{--
    =====================================================
    TAILADMIN-EXACT GLOBAL COMPONENT STYLES
    =====================================================
    Included via @include from app.blade.php
    =====================================================
--}}
<style>
/* =====================================================
   DESIGN TOKENS — exact TailAdmin values
===================================================== */
:root {
    --ta-blue:        #465FFF;
    --ta-blue-dark:   #3B4FEE;
    --ta-success:     #17B26A;
    --ta-warning:     #F79009;
    --ta-error:       #F04438;
    --ta-gray-50:     #F9FAFB;
    --ta-gray-100:    #F3F4F6;
    --ta-gray-200:    #E5E7EB;
    --ta-gray-300:    #D1D5DB;
    --ta-gray-400:    #9CA3AF;
    --ta-gray-500:    #6B7280;
    --ta-gray-700:    #374151;
    --ta-gray-800:    #1F2937;
    --ta-gray-900:    #111827;
    --ta-dark-bg:     #111827;
    --ta-dark-border: #1F2937;
    --ta-dark-card:   rgba(255,255,255,0.03);
    --ta-font:        'Outfit','Cairo',sans-serif;
}

/* =====================================================
   BADGE — TailAdmin exact
===================================================== */
.ta-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 3px 10px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1.4;
    white-space: nowrap;
}
.ta-badge-success { background:#DCFCE7; color:#15803D; }
.ta-badge-warning { background:#FEF9C3; color:#A16207; }
.ta-badge-error   { background:#FEE2E2; color:#B91C1C; }
.ta-badge-info    { background:#DBEAFE; color:#1D4ED8; }
.ta-badge-light   { background:#F3F4F6; color:#374151; }

html.dark .ta-badge-success { background:rgba(22,163,74,0.15); color:#4ADE80; }
html.dark .ta-badge-warning { background:rgba(234,179,8,0.15);  color:#FDE047; }
html.dark .ta-badge-error   { background:rgba(220,38,38,0.15);  color:#FCA5A5; }
html.dark .ta-badge-info    { background:rgba(37,99,235,0.15);  color:#93C5FD; }
html.dark .ta-badge-light   { background:rgba(255,255,255,0.06); color:#D1D5DB; }

/* =====================================================
   BUTTON — TailAdmin exact
===================================================== */
.ta-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-family: var(--ta-font);
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: all 150ms;
    line-height: 1;
    text-decoration: none;
    white-space: nowrap;
}
/* Sizes */
.ta-btn-sm  { padding: 8px 14px; font-size: 13px; border-radius: 8px; }
.ta-btn-md  { padding: 11px 20px; font-size: 14px; border-radius: 10px; }
.ta-btn-lg  { padding: 14px 24px; font-size: 15px; border-radius: 12px; }

/* Variants */
/* Unified Primary & Action Buttons (Add, Save, Create) */
.ta-btn-primary, .ta-btn-add, .ta-btn-create, .ta-btn-save {
    background: #064E3B !important;
    color: #FFFFFF !important;
    font-weight: 700;
    box-shadow: 0 2px 6px rgba(6,78,59,0.25);
    border: none;
}
.ta-btn-primary:hover, .ta-btn-add:hover, .ta-btn-create:hover, .ta-btn-save:hover {
    background: #0D9488 !important;
    box-shadow: 0 4px 12px rgba(13,148,136,0.3);
}

.ta-btn-outline {
    background: white;
    color: var(--ta-gray-700);
    border: 1px solid var(--ta-gray-300);
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
}
.ta-btn-outline:hover { background: var(--ta-gray-50); }
html.dark .ta-btn-outline {
    background: var(--ta-gray-800);
    color: #D1D5DB;
    border-color: #374151;
}
html.dark .ta-btn-outline:hover { background: rgba(255,255,255,0.05); }

.ta-btn-success  { background:#17B26A; color:white; }
.ta-btn-success:hover { background:#15A360; }
.ta-btn-error    { background:#F04438; color:white; }
.ta-btn-error:hover { background:#DC3C32; }

.ta-btn-edit {
    background: #EFF6FF;
    color: #2563EB !important;
    border: 1px solid #BFDBFE;
    font-weight: 600;
}
.ta-btn-edit:hover { background: #DBEAFE; border-color: #93C5FD; }
html.dark .ta-btn-edit {
    background: rgba(37,99,235,0.15);
    color: #60A5FA !important;
    border-color: rgba(37,99,235,0.3);
}

.ta-btn-delete {
    background: #FEF2F2;
    color: #DC2626 !important;
    border: 1px solid #FECACA;
    font-weight: 600;
}
.ta-btn-delete:hover { background: #FEE2E2; border-color: #FCA5A5; }
html.dark .ta-btn-delete {
    background: rgba(220,38,38,0.15);
    color: #F87171 !important;
    border-color: rgba(220,38,38,0.3);
}

.ta-btn-view {
    background: #F8FAFC;
    color: #475569 !important;
    border: 1px solid #CBD5E1;
    font-weight: 600;
}
.ta-btn-view:hover { background: #F1F5F9; color: #0F172A !important; }
html.dark .ta-btn-view {
    background: rgba(255,255,255,0.06);
    color: #CBD5E1 !important;
    border-color: rgba(255,255,255,0.12);
}

.ta-btn-cancel, .ta-btn-secondary {
    background: #F1F5F9;
    color: #475569 !important;
    border: 1px solid #CBD5E1;
    font-weight: 600;
}
.ta-btn-cancel:hover, .ta-btn-secondary:hover { background: #E2E8F0; }
html.dark .ta-btn-cancel, html.dark .ta-btn-secondary {
    background: rgba(255,255,255,0.05);
    color: #94A3B8 !important;
    border-color: rgba(255,255,255,0.1);
}

/* =====================================================
   TABLE — TailAdmin exact (unified)
===================================================== */
/* =====================================================
   TABLE — TailAdmin exact (unified with grid borders)
===================================================== */
.ta-table-wrap {
    overflow: hidden;
    border-radius: 14px;
    border: 1.5px solid #CBD5E1;
    background: #ffffff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.06);
}
html.dark .ta-table-wrap {
    border-color: rgba(255,255,255,0.12);
    background: rgba(255,255,255,0.03);
    box-shadow: none;
}

.ta-table-scroll { overflow-x: auto; }

.ta-table {
    width: 100%;
    border-collapse: collapse;
    font-family: var(--ta-font);
}

/* Header */
.ta-table thead tr {
    border-bottom: 2px solid #CBD5E1 !important;
    background-color: #F8FAFC;
}
html.dark .ta-table thead tr {
    border-color: rgba(255,255,255,0.12) !important;
    background-color: rgba(255,255,255,0.02);
}

.ta-table th, table.ta-table th, table th {
    padding: 12px 18px;
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    text-align: center !important;
    vertical-align: middle !important;
    white-space: nowrap;
    border: 1px solid #CBD5E1 !important;
    border-bottom: 2px solid #CBD5E1 !important;
}
html.dark .ta-table th, html.dark table.ta-table th, html.dark table th {
    color: var(--ta-gray-400);
    border-color: rgba(255,255,255,0.1) !important;
}

/* Body */
.ta-table tbody tr {
    border-bottom: 1px solid #CBD5E1 !important;
}
html.dark .ta-table tbody tr {
    border-color: rgba(255,255,255,0.1) !important;
}

.ta-table td, table.ta-table td, table td {
    padding: 14px 18px;
    font-size: 13px;
    color: #0F172A;
    text-align: center !important;
    vertical-align: middle !important;
    border: 1px solid #CBD5E1 !important;
}
html.dark .ta-table td, html.dark table.ta-table td, html.dark table td {
    color: #D1D5DB;
    border-color: rgba(255,255,255,0.1) !important;
}

/* Force inner flex divs in table cells to center */
.ta-table td > div, .ta-table th > div,
table td > div, table th > div {
    justify-content: center !important;
    text-align: center !important;
}

.table-title-bar {
    border-bottom: 1.5px solid #CBD5E1 !important;
    background-color: #FAFAFA;
}
html.dark .table-title-bar {
    border-color: rgba(255,255,255,0.1) !important;
    background-color: transparent;
}

.tbl-border {
    border-bottom: 1px solid #CBD5E1 !important;
}
html.dark .tbl-border {
    border-color: rgba(255,255,255,0.08) !important;
}

.ta-table-name {
    display: block;
    font-size: 14px;
    font-weight: 500;
    color: var(--ta-gray-900);
}
html.dark .ta-table-name { color: rgba(255,255,255,0.9); }

.ta-table-sub {
    display: block;
    font-size: 12px;
    color: var(--ta-gray-500);
}
html.dark .ta-table-sub { color: var(--ta-gray-400); }

/* Avatar in table */
.ta-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}
.ta-avatar img { width: 100%; height: 100%; object-fit: cover; }

/* =====================================================
   PAGINATION — TailAdmin exact
===================================================== */
.ta-pagination {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    border-top: 1.5px solid #CBD5E1;
    font-family: var(--ta-font);
    flex-wrap: wrap;
    gap: 10px;
}
html.dark .ta-pagination { border-color: rgba(255,255,255,0.08); }

.ta-pagination-info {
    font-size: 13px;
    color: var(--ta-gray-500);
}
html.dark .ta-pagination-info { color: var(--ta-gray-400); }

.ta-pagination-btns {
    display: flex;
    align-items: center;
    gap: 4px;
}

.ta-page-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    border: 1px solid #CBD5E1;
    background: white;
    color: var(--ta-gray-700);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 150ms;
    font-family: var(--ta-font);
}
.ta-page-btn:hover { background: var(--ta-gray-50); }
.ta-page-btn.active {
    background: var(--ta-blue);
    color: white;
    border-color: var(--ta-blue);
}
.ta-page-btn:disabled { opacity: 0.45; cursor: not-allowed; }
html.dark .ta-page-btn {
    background: var(--ta-gray-800);
    border-color: #374151;
    color: #D1D5DB;
}
html.dark .ta-page-btn:hover { background: rgba(255,255,255,0.06); }
html.dark .ta-page-btn.active { background: var(--ta-blue); color: white; }

/* =====================================================
   CARD — TailAdmin exact (includes .da-card for dashboard widgets)
===================================================== */
.ta-card, .da-card, .dashboard-card {
    background: #ffffff !important;
    border: 1.5px solid #CBD5E1 !important;
    border-radius: 16px;
    padding: 20px 24px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
html.dark .ta-card, html.dark .da-card, html.dark .dashboard-card {
    background: rgba(255,255,255,0.03) !important;
    border-color: rgba(255,255,255,0.1) !important;
    box-shadow: none;
}

.ta-card-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--ta-gray-900);
    margin: 0;
    font-family: var(--ta-font);
}
html.dark .ta-card-title { color: rgba(255,255,255,0.9); }

/* =====================================================
   FORM INPUTS — TailAdmin exact
===================================================== */
.ta-input {
    width: 100%;
    height: 44px;
    padding: 0 14px;
    font-size: 14px;
    font-family: var(--ta-font);
    font-weight: 400;
    color: var(--ta-gray-900);
    background: white;
    border: 1px solid var(--ta-gray-300);
    border-radius: 10px;
    outline: none;
    transition: border-color 150ms, box-shadow 150ms;
    box-sizing: border-box;
}
.ta-input::placeholder { color: var(--ta-gray-400); }
.ta-input:focus {
    border-color: var(--ta-blue);
    box-shadow: 0 0 0 3px rgba(70,95,255,0.12);
}
html.dark .ta-input {
    background: var(--ta-gray-800);
    border-color: #374151;
    color: rgba(255,255,255,0.9);
}
html.dark .ta-input:focus { border-color: var(--ta-blue); }

.ta-label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: var(--ta-gray-700);
    margin-bottom: 6px;
    font-family: var(--ta-font);
}
html.dark .ta-label { color: #D1D5DB; }

/* =====================================================
   MODAL — TailAdmin exact
===================================================== */
.ta-modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    background: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
}
.ta-modal {
    background: white;
    border-radius: 24px;
    padding: 2rem 2.5rem;
    width: 100%;
    max-width: 680px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 25px 60px rgba(0,0,0,0.2);
    position: relative;
}
html.dark .ta-modal { background: #111827; }

/* =====================================================
   BREADCRUMB — TailAdmin exact
===================================================== */
.ta-breadcrumb {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-family: var(--ta-font);
}
.ta-breadcrumb-link {
    color: var(--ta-gray-500);
    text-decoration: none;
    font-weight: 500;
    transition: color 150ms;
}
.ta-breadcrumb-link:hover { color: var(--ta-gray-900); }
html.dark .ta-breadcrumb-link { color: var(--ta-gray-400); }
html.dark .ta-breadcrumb-link:hover { color: rgba(255,255,255,0.9); }

.ta-breadcrumb-sep { color: var(--ta-gray-300); font-size: 10px; }
html.dark .ta-breadcrumb-sep { color: #374151; }

.ta-breadcrumb-current { color: var(--ta-blue); font-weight: 600; }

/* =====================================================
   PAGE HEADER — TailAdmin exact
===================================================== */
.ta-page-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.5rem;
}
.ta-page-title {
    font-size: 22px;
    font-weight: 700;
    color: var(--ta-gray-900);
    margin: 0;
    font-family: var(--ta-font);
}
html.dark .ta-page-title { color: rgba(255,255,255,0.9); }

.ta-page-subtitle {
    font-size: 13px;
    color: var(--ta-gray-500);
    margin: 4px 0 0;
    font-family: var(--ta-font);
}

/* =====================================================
   DIVIDER
===================================================== */
.ta-divider {
    height: 1px;
    background: var(--ta-gray-200);
    border: none;
    margin: 1.25rem 0;
}
html.dark .ta-divider { background: rgba(255,255,255,0.07); }

/* =====================================================
   SECTION HEADING inside card
===================================================== */
.ta-section-heading {
    font-size: 16px;
    font-weight: 600;
    color: var(--ta-gray-900);
    margin: 0 0 1.25rem;
    font-family: var(--ta-font);
}
html.dark .ta-section-heading { color: rgba(255,255,255,0.9); }

/* =====================================================
   SOCIAL ICON BUTTONS — TailAdmin exact
===================================================== */
.ta-social-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    border: 1px solid var(--ta-gray-300);
    background: white;
    color: var(--ta-gray-700);
    text-decoration: none;
    font-size: 16px;
    transition: all 150ms;
    box-shadow: 0 1px 3px rgba(0,0,0,0.06);
}
.ta-social-btn:hover { background: var(--ta-gray-50); color: var(--ta-gray-900); }
html.dark .ta-social-btn {
    background: var(--ta-gray-800);
    border-color: #374151;
    color: #9CA3AF;
}
html.dark .ta-social-btn:hover { background: rgba(255,255,255,0.06); color: #F9FAFB; }

/* =====================================================
   AVATAR STACKING — tables
===================================================== */
.ta-avatar-stack { display: flex; }
.ta-avatar-stack .ta-avatar-sm {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    overflow: hidden;
    border: 2px solid white;
    margin-inline-end: -8px;
    flex-shrink: 0;
}
html.dark .ta-avatar-stack .ta-avatar-sm { border-color: var(--ta-gray-900); }
.ta-avatar-stack .ta-avatar-sm img { width: 100%; height: 100%; object-fit: cover; }

/* =====================================================
   RESPONSIVE OVERRIDES (MOBILE & TABLET)
===================================================== */
@media (max-width: 640px) {
    /* Modal responsive overlay & container */
    .ta-modal-overlay {
        padding: 0.5rem !important;
    }
    .ta-modal {
        padding: 1.25rem 1rem !important;
        border-radius: 16px !important;
        width: 95vw !important;
        max-width: 95vw !important;
        max-height: 88vh !important;
        margin: 0 auto !important;
    }

    /* Force multi-column form grids inside cards, forms & modals to fold to single column on mobile */
    .ta-modal form [style*="grid-template-columns"],
    .ta-modal [style*="grid-template-columns"],
    .ta-card [style*="grid-template-columns"],
    form [style*="grid-template-columns"] {
        grid-template-columns: 1fr !important;
        gap: 1rem !important;
    }

    .ta-card {
        padding: 1.25rem 1rem !important;
    }

    /* Filter / Action Bars wrapping */
    .table-title-bar {
        padding: 12px 14px !important;
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 10px !important;
    }
    .table-title-bar > div {
        width: 100% !important;
        min-width: 100% !important;
        flex-direction: column !important;
        align-items: stretch !important;
    }
    .table-title-bar input,
    .table-title-bar select,
    .table-title-bar button {
        width: 100% !important;
    }

    /* Page Header */
    .ta-page-header {
        flex-direction: column !important;
        align-items: flex-start !important;
        gap: 0.75rem !important;
    }

    /* Table horizontal scroll wrapper touch optimizations */
    .ta-table-scroll {
        -webkit-overflow-scrolling: touch;
    }
}

/* =====================================================
   MOBILE STACKED CARDS VIEW (< 768px)
===================================================== */
.ta-mobile-cards {
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 12px;
}
.ta-mobile-card {
    background: #FFFFFF;
    border: 1.5px solid #CBD5E1;
    border-radius: 14px;
    padding: 16px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.04);
    display: flex;
    flex-direction: column;
    gap: 10px;
}
html.dark .ta-mobile-card {
    background: rgba(255,255,255,0.03);
    border-color: rgba(255,255,255,0.12);
}
.ta-mobile-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 10px;
    border-bottom: 1px solid #E2E8F0;
    gap: 10px;
}
html.dark .ta-mobile-card-header {
    border-color: rgba(255,255,255,0.08);
}
.ta-mobile-card-body {
    display: flex;
    flex-direction: column;
    gap: 8px;
    font-size: 13px;
}
.ta-mobile-card-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
}
.ta-mobile-card-label {
    font-size: 12px;
    font-weight: 700;
    color: #64748B;
}
html.dark .ta-mobile-card-label {
    color: #94A3B8;
}
.ta-mobile-card-val {
    font-size: 13px;
    font-weight: 600;
    color: #0F172A;
}
html.dark .ta-mobile-card-val {
    color: #F8FAFC;
}
.ta-mobile-card-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    padding-top: 10px;
    border-top: 1px solid #E2E8F0;
    margin-top: 4px;
}
html.dark .ta-mobile-card-actions {
    border-color: rgba(255,255,255,0.08);
}

@media (min-width: 768px) {
    .ta-mobile-cards { display: none !important; }
}
@media (max-width: 767px) {
    .ta-table-scroll { display: none !important; }
    .ta-mobile-cards { display: flex !important; }
}
</style>
