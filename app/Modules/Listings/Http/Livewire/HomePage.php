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
                'reference_id' => 'RE-9401',
                'title' => 'فيلا مودرن فاخرة مع مسبح وحديقة خاصة',
                'category' => 'villas',
                'category_name' => 'فيلا سكنية',
                'city' => 'riyadh',
                'location' => 'الرياض، حي النرجس شمال طريق الملك سلمان',
                'purpose' => 'sale',
                'price' => 3850000,
                'currency' => 'ر.س',
                'bedrooms' => 5,
                'bathrooms' => 6,
                'area' => 450,
                'image' => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'reference_id' => 'RE-8820',
                'title' => 'شقة فندقية بإطلالة بانورامية كاملة على المارينا',
                'category' => 'apartments',
                'category_name' => 'شقة فاخرة',
                'city' => 'dubai',
                'location' => 'دبي، دبي مارينا بالقرب من الممشى',
                'purpose' => 'sale',
                'price' => 2200000,
                'currency' => 'AED',
                'bedrooms' => 2,
                'bathrooms' => 3,
                'area' => 135,
                'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 3,
                'reference_id' => 'RE-7215',
                'title' => 'دوبلكس راقٍ بحديقة ومدخل خاص كمبوند ميفيدا',
                'category' => 'duplex',
                'category_name' => 'دوبلكس',
                'city' => 'cairo',
                'location' => 'القاهرة الجديدة، التجمع الخامس',
                'purpose' => 'sale',
                'price' => 12500000,
                'currency' => 'EGP',
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 290,
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
            ],
            [
                'id' => 4,
                'reference_id' => 'RE-6610',
                'title' => 'شاليه صف أول على البحر مباشرة مارينا العلمين',
                'category' => 'chalets',
                'category_name' => 'شاليه ساحلي',
                'city' => 'cairo',
                'location' => 'الساحل الشمالي، مارينا 5',
                'purpose' => 'rent',
                'price' => 85000,
                'currency' => 'EGP',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 160,
                'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 5,
                'reference_id' => 'RE-5402',
                'title' => 'مقر إداري ومكتب تنفيذي مجهز بالكامل طريق الملك فهد',
                'category' => 'commercial',
                'category_name' => 'مكتب تجاري',
                'city' => 'riyadh',
                'location' => 'الرياض، العليا طريق الملك فهد',
                'purpose' => 'rent',
                'price' => 140000,
                'currency' => 'ر.س',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'area' => 210,
                'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
            ],
            [
                'id' => 6,
                'reference_id' => 'RE-4190',
                'title' => 'بنتهاوس فاخر بروف مفتوح وجاكوزي خاص',
                'category' => 'duplex',
                'category_name' => 'بنتهاوس',
                'city' => 'zayed',
                'location' => 'الشيخ زايد، كمبوند بيفرلي هيلز',
                'purpose' => 'sale',
                'price' => 9800000,
                'currency' => 'EGP',
                'bedrooms' => 4,
                'bathrooms' => 4,
                'area' => 340,
                'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=800&q=80',
                'is_featured' => true,
            ],
            [
                'id' => 7,
                'reference_id' => 'RE-3309',
                'title' => 'أرض سكنية موقع مميز بمخطط الشبيلي عالي',
                'category' => 'lands',
                'category_name' => 'أرض سكنية',
                'city' => 'khobar',
                'location' => 'الخبر، حي الشبيلي بالقرب من الكورنيش',
                'purpose' => 'sale',
                'price' => 2900000,
                'currency' => 'ر.س',
                'bedrooms' => null,
                'bathrooms' => null,
                'area' => 625,
                'image' => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
            ],
            [
                'id' => 8,
                'reference_id' => 'RE-2018',
                'title' => 'شقة عائلية مؤثثة بالكامل إطلالة بحرية حي الشاطئ',
                'category' => 'apartments',
                'category_name' => 'شقة للإيجار',
                'city' => 'jeddah',
                'location' => 'جدة، حي الشاطئ الكورنيش الشمالي',
                'purpose' => 'rent',
                'price' => 95000,
                'currency' => 'ر.س',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'area' => 180,
                'image' => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?auto=format&fit=crop&w=800&q=80',
                'is_featured' => false,
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
            'totalCount' => $filtered->count(),
            'selectedCity' => $this->selectedCity,
            'selectedCategory' => $this->selectedCategory,
            'purpose' => $this->purpose,
            'searchQuery' => $this->searchQuery,
        ])->layout('layouts.app');
    }
}
