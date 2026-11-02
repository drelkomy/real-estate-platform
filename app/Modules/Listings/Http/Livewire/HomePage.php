<?php

namespace App\Modules\Listings\Http\Livewire;

use Livewire\Component;

class HomePage extends Component
{
    public string $selectedCategory = 'all';

    public string $selectedCity = '';

    public string $purpose = 'all';

    public string $searchQuery = '';

    public function setCategory(string $cat)
    {
        $this->selectedCategory = $cat;
    }

    public function setPurpose(string $purp)
    {
        $this->purpose = $purp;
    }

    public function applySearch()
    {
        // Reactively triggers filter re-evaluation
    }

    public function getPropertiesList(): array
    {
        return [
            [
                'id' => 1,
                'reference_id' => 'EG-101',
                'title' => 'فيلا مستقلة فاخرة كمبوند قطامية ديونز بحديقة خاصة ومسبح',
                'category' => 'villas',
                'category_name' => 'فيلا فاخرة',
                'city' => 'new_cairo',
                'location' => 'القاهرة الجديدة، التجمع الخامس - قطامية ديونز',
                'purpose' => 'sale',
                'price' => 28500000,
                'price_display' => '28.5 مليون ج.م',
                'currency' => 'ج.م',
                'bedrooms' => 5,
                'bathrooms' => 6,
                'area' => 520,
                'lat' => 30.0150,
                'lng' => 31.4780,
                'image' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'reference_id' => 'EG-102',
                'title' => 'شقة عصرية بحديقة خاصة كمبوند ميفيدا إعمار تشطيب كامل',
                'category' => 'apartments',
                'category_name' => 'شقة راقية',
                'city' => 'new_cairo',
                'location' => 'القاهرة الجديدة، التجمع الخامس - ميفيدا',
                'purpose' => 'sale',
                'price' => 9200000,
                'price_display' => '9.2 مليون ج.م',
                'currency' => 'ج.م',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 195,
                'lat' => 30.0260,
                'lng' => 31.4920,
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 3,
                'reference_id' => 'EG-103',
                'title' => 'تاون هاوس كورنر كمبوند سوديك ويست الجريا إطلالة جولف',
                'category' => 'duplex',
                'category_name' => 'تاون هاوس',
                'city' => 'sheikh_zayed',
                'location' => 'الشيخ زايد، كمبوند الجريا سوديك',
                'purpose' => 'sale',
                'price' => 14800000,
                'price_display' => '14.8 مليون ج.م',
                'currency' => 'ج.م',
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 310,
                'lat' => 30.0540,
                'lng' => 30.9850,
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
            ],
            [
                'id' => 4,
                'reference_id' => 'EG-104',
                'title' => 'بنتهاوس فاخر مع روف مفتوح وجاكوزي كمبوند بالم هيلز',
                'category' => 'duplex',
                'category_name' => 'بنتهاوس',
                'city' => 'october',
                'location' => 'السادس من أكتوبر، كمبوند بالم هيلز',
                'purpose' => 'sale',
                'price' => 11500000,
                'price_display' => '11.5 مليون ج.م',
                'currency' => 'ج.م',
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 280,
                'lat' => 29.9880,
                'lng' => 30.9420,
                'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 5,
                'reference_id' => 'EG-105',
                'title' => 'مقر إداري ومكتب تنفيذي بحي المال والأعمال البرج الأيقوني',
                'category' => 'commercial',
                'category_name' => 'مكتب إداري',
                'city' => 'new_capital',
                'location' => 'العاصمة الإدارية الجديدة، منطقة الأعمال المركزية',
                'purpose' => 'rent',
                'price' => 95000,
                'price_display' => '95 ألف ج.م / شهر',
                'currency' => 'ج.م',
                'bedrooms' => 2,
                'bathrooms' => 2,
                'area' => 175,
                'lat' => 30.0090,
                'lng' => 31.7380,
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
            ],
            [
                'id' => 6,
                'reference_id' => 'EG-106',
                'title' => 'شاليه صف أول على اللاجون مباشرة هاسيندا باي سيدي عبد الرحمن',
                'category' => 'chalets',
                'category_name' => 'شاليه ساحلي',
                'city' => 'north_coast',
                'location' => 'الساحل الشمالي، سيدي عبد الرحمن - هاسيندا باي',
                'purpose' => 'rent',
                'price' => 120000,
                'price_display' => '120 ألف ج.م / شهر',
                'currency' => 'ج.م',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 165,
                'lat' => 30.9520,
                'lng' => 28.7840,
                'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 7,
                'reference_id' => 'EG-107',
                'title' => 'شقة دوبلكس فاخرة بإطلالة مباشرة على النيل كورنيش الزمالك',
                'category' => 'apartments',
                'category_name' => 'شقة نيلية',
                'city' => 'zamalek',
                'location' => 'القاهرة، حي الزمالك - شارع أبو الفدا',
                'purpose' => 'rent',
                'price' => 75000,
                'price_display' => '75 ألف ج.م / شهر',
                'currency' => 'ج.م',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 240,
                'lat' => 30.0610,
                'lng' => 31.2210,
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
            ],
            [
                'id' => 8,
                'reference_id' => 'EG-108',
                'title' => 'فيلا شاطئية استثنائية مع مرسى يخوت خاص الجونة كفر الجونة',
                'category' => 'villas',
                'category_name' => 'فيلا شاطئية',
                'city' => 'gouna',
                'location' => 'الجونة، البحر الأحمر - كفر الجونة واللاجون',
                'purpose' => 'sale',
                'price' => 42000000,
                'price_display' => '42 مليون ج.م',
                'currency' => 'ج.م',
                'bedrooms' => 5,
                'bathrooms' => 6,
                'area' => 490,
                'lat' => 27.3940,
                'lng' => 33.6780,
                'image' => 'https://images.unsplash.com/photo-1580674684081-7617fbf3d745?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
        ];
    }

    public function render()
    {
        $all = collect($this->getPropertiesList());

        // Apply filters
        $filtered = $all->filter(function ($item) {
            if ($this->selectedCategory !== 'all' && $item['category'] !== $this->selectedCategory) {
                return false;
            }
            if (! empty($this->selectedCity) && $item['city'] !== $this->selectedCity) {
                return false;
            }
            if ($this->purpose !== 'all' && $item['purpose'] !== $this->purpose) {
                return false;
            }
            if (! empty($this->searchQuery)) {
                $query = mb_strtolower(trim($this->searchQuery));
                $haystack = mb_strtolower($item['title'].' '.$item['location'].' '.$item['reference_id']);
                if (! str_contains($haystack, $query)) {
                    return false;
                }
            }

            return true;
        });

        return view('livewire.home.home-page', [
            'properties' => $filtered,
            'allProperties' => $all,
            'totalCount' => $filtered->count(),
            'selectedCity' => $this->selectedCity,
            'selectedCategory' => $this->selectedCategory,
            'purpose' => $this->purpose,
            'searchQuery' => $this->searchQuery,
        ])->layout('layouts.app');
    }
}
